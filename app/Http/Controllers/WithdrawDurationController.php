<?php

namespace App\Http\Controllers;

use App\Helper;
use App\User;
use App\Http\Resources\WithdrawDurationResource;
use App\withdraw_duration;
use Illuminate\Http\Request;
use \DB;
use App\Notifications\NewPauseWithdrawalRequest;
use \Exception;
use Carbon\Carbon;

class WithdrawDurationController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        try {
            $page = request()->query('page', 1);
            $pageSize = request()->query('pageSize', 10000000);
            $data = withdraw_duration::filter(request()->all())
                ->latest()
                ->paginate($pageSize);
            $total = $data->total();
            $data = WithdrawDurationResource::collection($data);
            $builtData = Helper::buildData($data, $total);
            return Helper::validRequest($builtData, 'data was fetched successfully', 200);
        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validated = $request->validate([
            "duration" => "required|exists:durations|numeric",
        ]);
        DB::beginTransaction();
        try
        {
            $validated['expiration'] =  Carbon::now()->addDays( $validated['duration']);
            $user_id = auth()->id();
            $validated['user_id'] =  $user_id;
            $user_count = withdraw_duration::where('user_id', $user_id)->count();
            if($user_count > 0){
                $user = withdraw_duration::where('user_id', $user_id)->first();
                $expiration = new Carbon($user->expiration) ;
                $data = $user->update(['duration' =>  $validated['duration'] , 'expiration' =>  $expiration->addDays( $validated['duration']) ]);
                 auth()->user()->update(['withdraw_request' => false]);
                DB::commit();
                $this->notificationRequest($user);
                return Helper::validRequest(["success" => $data], 'Updated successfully', 200);
            }
            else {
                $data = auth()->user()->withdrawDuration()->create($validated);
                auth()->user()->update(['withdraw_request' => false]);
                DB::commit();
                $this->notificationRequest($data);
                return Helper::validRequest($data, 'data was sent successfully', 200);
            }
            
            
        } catch (Exception $bug) {
            DB::rollback();
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\withdraw_duration  $withdraw_duration
     * @return \Illuminate\Http\Response
     */
    public function show(withdraw_duration $withdraw_duration) {
        try {
            $data = new WithdrawDurationResource($withdraw_duration);
            return Helper::validRequest($data, 'specified data was fetched successfully', 200);
        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\withdraw_duration  $withdraw_duration
     * @return \Illuminate\Http\Response
     */
    public function edit(withdraw_duration $withdraw_duration) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\withdraw_duration  $withdraw_duration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, withdraw_duration $withdraw_duration) {
        DB::beginTransaction();
        $validated = $request->validate([
            "duration" => "required|exists:durations|numeric",
            'user_id' => 'required|numeric|exists:users,id',
        ]);
        try {
            $data = $withdraw_duration->update($validated);
            DB::commit();
            return Helper::validRequest(["success" => $data], 'Updated successfully', 200);
        } catch (Exception $bug) {
            DB::rollback();
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\withdraw_duration  $withdraw_duration
     * @return \Illuminate\Http\Response
     */
    public function destroy(withdraw_duration $withdraw_duration) {
        DB::beginTransaction();
        try {
            $data = $withdraw_duration->delete();
            DB::commit();
            return Helper::validRequest(["success" => $data], 'Item deleted successfully', 200);
        } catch (Exception $bug) {
            DB::rollback();
            return $this->exception($bug, 'unknown error', 500);
        }
    }
    public function notificationRequest(withdraw_duration $withdraw_duration) {
        
        try {
            $admins = User::where('user_level_id',1)->get();
                foreach ($admins as $key => $user) {
                    $user->notify(new NewPauseWithdrawalRequest($withdraw_duration));
                }
        
        } catch (Exception $bug) {
            return false;
        }

    }
}
