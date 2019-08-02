<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Helper
{

    /**
     * @param $data
     * @param string $error_message
     * @param int $code
     * @param $data
     * @return \Illuminate\Http\Response
     */

    public static function responseJson($data = [], $error_message, int $code)
    {
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
    public static function array_to_object(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = self::array_to_object($value);
            }
        }
        return (object) $array;
    }

    /**
     * @param object $errors
     * @param $message
     * @param int $code
     */

    public static function invalidRequest($errors, $message, $code = 400)
    {

        return self::responseJson($errors, $message, $code);
    }
    /**
     * @param object $data
     * @param $message
     * @param int $code
     */

    public static function validRequest($data, $message = 'Ok', $code = 200)
    {

        return self::responseJson($data, $message, 200);
    }

    public static function buildData($data, $total = 0)
    {
        $page = request()->query('page', 1);
        // $pageSize = request()->query('pageSize') == 0 ? $total : request()->query('pageSize');

        $data = [
            "item" => $data,
            "page" => (int) $page,
            "total" => $total,
        ];

        return $data;
    }
    public static function checkBooleanParameter($boolean)
    {

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

}
