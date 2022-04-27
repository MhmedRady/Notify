<?php

 function apiResponse($status = 200, $data = [], $msg = null){
    return response()->json(['status'=>$status, 'data' => $data, 'msg' => $msg]);
 }
