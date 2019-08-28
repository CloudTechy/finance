<?php
namespace App;

use App\PackageUser;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Helper {
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

}
