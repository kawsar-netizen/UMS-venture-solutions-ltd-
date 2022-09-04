<?php
function requestTypeValidationSpecificMessage($system_list, $request_list){
    if(strpos($system_list, ",")){ // more than select system 2 items
        $system_list_array = explode(",", $system_list);
        for($i=0; $i< count($system_list_array); $i++){
            $system_id = $system_list_array[$i];
            $system_request_response = checkRequestSelectedOrNot($system_id, $request_list);
            if($system_request_response['success'] == false){
                echo $system_request_response['message'];
                break;
            }
        }
    }else{
        $system_request_response = checkRequestSelectedOrNot($system_list, $request_list);
        if($system_request_response['success'] == false){
            echo $system_request_response['message'];
        }
    }


    $response = [
        "success" => true,
        "message" => "done"
    ];
    print_r($response);
    
}

function checkRequestSelectedOrNot($system_id, $request_list){
    if(empty($request_list)){
        $system_id_name = getSystemIdName($system_id);
        $response = [
            "success" => false,
            "message" => "$system_id_name request-type not selected :)"
        ];
        return $response;
    }else{
        $new_request_list = [];
        if(strpos($request_list, ",")){ // multiple select more than 2
            $request_list_array = explode(",", $request_list);        
            for($i=0; $i < count($request_list_array); $i++){
                $single_request_list_array = explode("-", $request_list_array[$i]);
                $request_id = $single_request_list_array[0];
                array_push($new_request_list, $request_id);
            }
        }else{ // only 2 system
            $single_request_list_array = explode("-", $request_list);
            $request_id = $single_request_list_array[0];
            array_push($new_request_list, $request_id);
        } 
    }
     


    if(in_array($system_id, $new_request_list)){
        $response = [
            "success" => true,
            "message" => "request selected"
        ];
    }else{
        $system_id_name = getSystemIdName($system_id);
        $response = [
            "success" => false,
            "message" => "$system_id_name request-type not selected :)"
        ];
    }

    return $response;

}

requestTypeValidationSpecificMessage('1', '');


function getSystemIdName($system_id){
    return $system_id;
}
