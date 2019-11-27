<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\CustomEmailNotification;


class EmailController extends Controller
{
 	public function sendEmail(Request $request)
    {
       DB::beginTransaction();
		$validated = $request->validate([
			'message' => 'string|required',
			'subject' => 'string|required',
			'id' => 'numeric|required',
		]);
		try {
			User::find($validated['id'])->notify(new CustomEmailNotification($validated));
			return Helper::validRequest(["success" => $data], 'Email sent successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
    }
}
