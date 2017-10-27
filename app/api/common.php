<?php
function show($status,$data,$message=''){
    return [
        'status' =>intval($status),
        'message'=> $message,
        'data' =>$data
    ];
}
