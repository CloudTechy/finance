<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Resources\UserResource;
use App\User;
use Auth;
use Exception;
use Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{
    use SendsPasswordResetEmails, ResetsPasswords {
        SendsPasswordResetEmails::broker insteadof ResetsPasswords;
        ResetsPasswords::credentials insteadof SendsPasswordResetEmails;
    }
    /**
     * Register a new user
     */
    function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:3|confirmed',
        ]);
        try
        {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return Helper::validRequest(new UserResource($user), 'Unit was sent successfully', 200);
        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Login user and return a token
     */
    function login(Request $request)
    {
        try
        {
            $credentials = $request->only('email', 'password');
            if ($token = $this->guard()->attempt($credentials)) {
                return Helper::validRequest($token, 'Login successful', 200);
            } else {
                return Helper::invalidRequest(['error' => 'login_error'], 'Authentication error', 401);
            }

        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }

    }

    /**
     * Logout User
     */
    function logout()
    {
        try
        {
            $logout = $this->guard()->logout();
            return Helper::validRequest(["success" => $logout], 'Logged out Successfully', 200);

        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Get authenticated user
     */
    function user(Request $request)
    {
        try
        {
            $user = User::find(Auth::user()->id);
            return Helper::validRequest(new UserResource($user), 'user fetched Successfully', 200);

        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }

    }

    /**
     * Refresh JWT token
     */
    function refresh()
    {
        try
        {
            if ($token = $this->guard()->refresh()) {
                return Helper::validRequest($token, 'Login successful', 200);
            } else {
                return Helper::inValidRequest(['error' => 'refresh_token_error'], 'Authentication error', 401);
            }

        } catch (Exception $bug) {
            return $this->exception($bug, 'unknown error', 500);
        }
    }

    /**
     * Return auth guard
     */
    function guard()
    {
        return Auth::guard();
    }

    function sendPasswordResetLink(Request $request)
    {
        return $this->sendResetLinkEmail($request);
    }
    function sendResetLinkResponse(Request $request, $response)
    {
        try
        {
            return Helper::validRequest($response, 'Password reset email sent.', 200);

        } catch (Exception $bug) {
            return $this->exception($bug, 'Unknown error', 500);
        }

    }
    function sendResetLinkFailedResponse(Request $request, $response)
    {
        return Helper::inValidRequest(['error' => 'Email failed to send'], 'Email could not be sent to this email address.', 401);
    }
    function callResetPassword(Request $request)
    {
        return $this->reset($request);
    }
    function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();

        event(new PasswordReset($user));
    }
    function sendResetResponse(Request $request, $response)
    {
        return Helper::validRequest(['success' => 'password reset success'], 'Password reset successfully.', 200);
    }
    function sendResetFailedResponse(Request $request, $response)
    {
        return Helper::inValidRequest(['error' => 'Token is Invalid'], 'Failed, Invalid Token.', 401);
    }
}
