<?php

namespace App\Helpers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Helper{
    public static function jsonResponse($data = [], $status = 200, $message = 'OK', $errors = []): \Illuminate\Http\JsonResponse
    {
        return response()->json(compact('data', 'status', 'message', 'errors'), $status);
    }
    public static function transactional(\Closure $callback)
    {
        DB::beginTransaction();
        try {
            $result=$callback();
            
            DB::commit();
            return $result;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return self::jsonResponse(message: 'Ocurrio un error', status: 500);
        }
    }

}