<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\CustomEmailNotification;
use App\Notifications\PackageSubscribed;
use Illuminate\Notifications\Notification;
use \DB;
use App\Helper;
use App\Package;
use \Exception;


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
			// Notification::route('mail', 'taylor@example.com')
   //          ->notify( new CustomEmailNotification($validated));
			// // $package = Package::first();
			User::find($validated['id'])->notify(new CustomEmailNotification($validated));
			return Helper::validRequest(["success" => User::find($validated['id'])->username], 'Email sent successfully', 200);
		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}
    }
}
