<?php
namespace App\Services;

trait ApiServices{

    public static function responseSuccess($success,$data){
        return response()->json([
                'success' => $success,
                'data' => $data
            ]);
    }

}
