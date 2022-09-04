<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
   function index(){

    return view('dynamic_pdf');
   }

  function pdf($id)
    {
     $pdf = \App::make('dompdf.wrapper');
     
     $pdf->loadHTML($this->audit_sheet_pdf($id));
     return $pdf->stream();
    }

   function audit_sheet_pdf($id)
    {

       
   $audit_simple_data = DB::table('audit_id')->where('id', $id)->first();
    $email = $audit_simple_data->email;

    $yes_checked_change_req="";
    $no_checked_change_req="";

    if ($audit_simple_data->change_req=='Yes') {
        
        $yes_checked_change_req = "checked";

    }elseif ($audit_simple_data->change_req=='No') {

       $no_checked_change_req = "checked";

    }

    $yes_checked_change_exe="";
    $no_checked_change_exe="";

    if($audit_simple_data->change_exe=='Yes'){
     
        $yes_checked_change_exe = "checked";

    }elseif($audit_simple_data->change_exe=='No'){

       $no_checked_change_exe = "checked";
    }

    $data_audit_system = DB::select(DB::raw("SELECT 
      distinct aus.system_id

  FROM [dbfive].[dbo].[audit_system] aus where audit_id='$id'"));

    $system_name_info ='';

    $system_audit_table_info='';

  foreach($data_audit_system as $single_data_audit_system){

    $system_id = $single_data_audit_system->system_id;
    
    $system_name_data = DB::table('systems')->where('id', $system_id)->first();
    $system_name = $system_name_data->system_name;

   $system_audit_table_info.= "<tr>
         <td style='border:none; padding:12px;' 
          width='100%'>$system_name</td>
       </tr>";

  $audit_system_info = DB::select(DB::raw("SELECT 
      *
  FROM [audit_system] aus where aus.audit_id='$id' and aus.system_id='$system_id'"));

     foreach($audit_system_info as $single_audit_system_info){

         $system_audit_table_info.="<tr>
         <td style='border: 1px solid; padding:12px;'
          width='20%'>$single_audit_system_info->user_id</td>

         <td style='border: 1px solid; padding:12px;'
          width='30%'>$single_audit_system_info->name</td>

        <td style='border: 1px solid; padding:12px;' 
        width='15%'>$single_audit_system_info->action</td>

         <td style='border: 1px solid; padding:12px;'
          width='15%'>$single_audit_system_info->remarks</td>

       </tr>";

     }

 

  }



  //echo $system_audit_table_info;


     $output = '


     <h3 align="center">User Access Audit Sheet Acknowledgement Form</h3>
        <form>

            <label style="margin-top:40px;">Email To:</label>

           <input style="width:600px; height:25px;margin-top:10px;margin-left:10px;" type="text"  name="email_to" value="'.$email.'"> 


           <p>&nbsp;</p>
            <span style="">Branch Code: '.$audit_simple_data->branch_code.'</span>

            <span style="text-align:right;float:right;">Date : '.$audit_simple_data->date.'</span>

           

             <p style="">Branch Name: '.$audit_simple_data->branch_name.'</p>
             <p style="">Received Date: '.$audit_simple_data->received_date.'</p>

             <p>Dear Sir, <br>
Thank you for providing User Access Audit Sheet for the month of May, 2021.
We have received user access audit sheet from your Branch/Division for following systems:
</p>    
    
     <input type="checkbox" value="1" name="UBS" id="UBS" checked style="margin-top:5px;"> UBS

     &nbsp;
       <input type="checkbox" value="6" name="RTGS" id="RTGS" checked style="margin-top:5px;"> RTGS &nbsp;

      <input type="checkbox" value="4" name="CPS" id="CPS"  style="margin-top:5px;"> CPS &nbsp;
      
      <input type="checkbox" value="5" name="EFTN" id="EFTN"  style="margin-top:5px;"> EFTN &nbsp;

      <input type="checkbox" value="7" name="GEFU" id="GEFU"  style="margin-top:5px;"> GEFU &nbsp;

      <input type="checkbox" value="8" name="Passport" id="Passport"  style="margin-top:5px;"> Passport &nbsp;

      <input type="checkbox" value="9" name="BKash" id="BKash"  style="margin-top:5px;"> BKash &nbsp;

      <input type="checkbox" value="10" name="Utility_Bill" id="Utility_Bill"  style="margin-top:5px;"> Utility Bill &nbsp;

      <input type="checkbox" value="2" name="remitbook" id="remitbook" style="margin-top:5px;"> Remitbook &nbsp;

      <input type="checkbox" value="3" name="dbcube" id="dbcube" style="margin-top:5px;"> New Dbcube &nbsp;

      <p><b>Change Requested :  </b>  <input type="checkbox" value="Yes"  style="margin-top:5px;" id="change_req_yes" name="change_req_yes" '.$yes_checked_change_req.'>&nbsp; Yes

      <input type="checkbox" style="margin-top:5px;" value="No" id="change_req_no" name="change_req_no" '.$no_checked_change_req.'>&nbsp; NO
      </p>


       <p><b>Change Executed :  </b>

         <input type="checkbox"  style="margin-top:5px;" value="Yes" id="change_exe_yes" name="change_exe_yes" style="margin-top:5px;"  '.$yes_checked_change_exe.'>&nbsp; Yes


        <input type="checkbox" style="margin-top:5px;" value="No" id="change_exe_no" name="change_exe_no"  '.$no_checked_change_exe.'>&nbsp; NO

      </p>


        </form>   

       <p>As per your request we have made following changes:</p> 

      '.$system_name_info.'
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>

        <th style="border: 1px solid; padding:12px;" width="20%">USER ID</th>
        <th style="border: 1px solid; padding:12px;" width="30%">NAME</th>
        <th style="border: 1px solid; padding:12px;" width="15%">ACTIONS</th>
        <th style="border: 1px solid; padding:12px;" width="15%">REMARKS</th>
  
   </tr>

   '.$system_audit_table_info.'


   

    <p>Information Technology Division, 71, Purana Paltan Lane, Dhaka-1000, Bangladesh
Tel: 58314424, Fax: 880-2-58314419, Website: www.dhakabankltd.com ,E-mail : info@dhakabank.com.bd
    </p>

    <p>&nbsp;</p>

     <hr>

     <p>&nbsp;</p>

    <div>
        <h4 style="margin-left:30px;">Maker</h4>
        _______________

        <p><b>Md. Nazmul Alam  </b></p>
        <p>Trainee Assistant Officer, IT</p>
        
    </div>

     <div style="float:right;">

        <h4 style="margin-left:30px;">Checker</h4>
          _______________
        <p><b>Md. Nazmul Alam  </b></p>
        <p>Trainee Assistant Officer, IT</p>
        
    </div>




       <span>Remarks: Please note that we did not receive User Access Audit Sheet of Utility Bill. You are requested to send the
    file as early as possible.</span>


    <p>&nbsp;</p>

 
 
     ';  
     
     $output .= '</table';
     return $output;
    }
      
}
