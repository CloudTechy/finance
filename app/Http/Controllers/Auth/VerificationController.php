<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use App\Notifications\UserRegistered;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Email Verification Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller is responsible for handling email verification for any
		    | user that recently registered with the application. Emails may also
		    | be re-sent if the user didn't receive the original email message.
		    |
	*/

	use VerifiesEmails;
	/**
	 * Where to redirect users after verification.
	 *
	 * @var string
	 */
	//protected $redirectTo = '/dashboard';
	public function show(Request $request) {
		if ($request->user()->hasVerifiedEmail()) {

			return response()->json('Email Verified');
		} else {
			return response()->json('Email not verified');
		}
	}
	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function verify(Request $request) {
		// ->route('id') gets route user id and getKey() gets current user id()
		// do not forget that you must send Authorization header to get the user from the request
		if ($request->route('id') == $request->user()->getKey() &&
			$request->user()->markEmailAsVerified()) {
			$request->user()->notify(new UserRegistered());
			//event(new Verified($request->user()));
		}
		return response()->json('Email verified!');
//        return redirect($this->redirectPath());
	}
	/**
	 * Resend the email verification notification.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function resend(Request $request) {
		if ($request->user()->hasVerifiedEmail()) {
			return response()->json('User already have verified email!', 422);
//            return redirect($this->redirectPath());
		}
		$request->user()->sendEmailVerificationNotification();
		return response()->json('The notification has been resubmitted');
//        return back()->with('resent', true);
	}
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->middleware('signed');
		$this->middleware('throttle:6,1')->only( 'resend');
		// $this->middleware('signed')->only('verify');
		// $this->middleware('throttle:6,1')->only('verify', 'resend');
	}
}