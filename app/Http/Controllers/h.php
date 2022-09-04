<?php
$data = "_token=ydbEFmP8hz9DXb5z5AFiGr8KeDG2OQmIsKgzbV36&assign_person=9&RTGS=6&new_u_6=&21=&104=&119=&new_u_13=&76=&new_u_19=&90=&radio6=Enhancement&new_u_37=&operation_system_name=rtgs&rtgs_radio=141&rtgs2_radio=143&rtgs_tmp_exp_date=2021-09-04&rtgs_tmp_exp_time=&158=&145=Senior%20Vice%20President&1449=&1479=&1557=&1771=";
$data_array = explode("&", $data);
if(in_array("rtgs2_radio=143", $data_array)){
    for($i=0; $i < count($data_array); $i++){
        $single_value_array = explode("=",$data_array[$i]);
        if( ($single_value_array[0] == "rtgs_tmp_exp_date") && ($single_value_array[1] == '') ){
            return false;
        }
    
        if( ($single_value_array[0] == "rtgs_tmp_exp_time") && ($single_value_array[1] == '') ){
            return false;
        }
    }  
}
return true;


else{
//     echo "|nai";
// }