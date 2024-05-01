<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
 public static function Out($msg,$data,$code):JsonResponse{
   return  response()->json(['msg' => $msg, 'data' =>  $data],$code);
 }
}