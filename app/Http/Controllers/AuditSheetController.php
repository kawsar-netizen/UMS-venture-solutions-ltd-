<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use PDF;
use Exception;
use Mail;

class AuditSheetController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function audit_sheet_form(){

    
        return view('audit_sheet.audit_sheet_form');
    }

    public function audit_sheet_form_submit(Request $request){
        $systm_arr=[1=>"UBS",6=>"RTGS", 4=>"CPS",5=>"EFTN",1012=>"GEFU",1001=>"BKash", 1003=>"Utility_Bill", 2=>"RemitBook",1004=>"Docudex",1005=>"CSMS",1013=>"nScreen And nSmart",1018=>"E-landing",1014=>"Call Center System",1011=>"TP & KYC System",1026=>"CPC Plus",1025=>"C Solution",1020=>"Automated Challan System",3=>"New_Dbcube"];

       if($request->UBS){

        $ubs_index =$request->UBS;

        unset($systm_arr[$ubs_index]);

       }

       if ($request->RTGS) {
           $rtgs_index =$request->RTGS;

        unset($systm_arr[$rtgs_index]);
       }

       if ($request->CPS) {
           $cps_index =$request->CPS;

        unset($systm_arr[$cps_index]);
       }

       if ($request->EFTN) {
           $eftn_index =$request->EFTN;

        unset($systm_arr[$eftn_index]);
       }

       if ($request->GEFU) {
           $gefu_index =$request->GEFU;

            unset($systm_arr[$gefu_index]);
       }

       if ($request->Passport) {
           $passport_index =$request->Passport;

        unset($systm_arr[$passport_index]);
       }

       if ($request->BKash) {
           $bkash_index =$request->BKash;

        unset($systm_arr[$bkash_index]);
       }

        if ($request->Utility_Bill) {
           $utility_bill_index =$request->Utility_Bill;

        unset($systm_arr[$utility_bill_index]);
       } 

       if ($request->remitbook) {

           $remitbook_index =$request->remitbook;

        unset($systm_arr[$remitbook_index]);
       }

       if ($request->docudex) {
        $docudex_index =$request->docudex;

     unset($systm_arr[$docudex_index]);
    }

    if ($request->csms) {
        $csms_index =$request->csms;

     unset($systm_arr[$csms_index]);
    }
    if ($request->nsmart) {
        $nsmart_index =$request->nsmart;

     unset($systm_arr[$nsmart_index]);
    }
    if ($request->land) {
        $land_index =$request->land;

     unset($systm_arr[$land_index]);
    }
    if ($request->call_center) {
        $call_center_index =$request->call_center;

     unset($systm_arr[$call_center_index]);
    }
    if ($request->tp_kyc) {
        $tp_kyc_index =$request->tp_kyc;

     unset($systm_arr[$tp_kyc_index]);
    }
    if ($request->cpc) {
        $cpc_index =$request->cpc;

     unset($systm_arr[$cpc_index]);
    }
    if ($request->solution) {
        $solution_index =$request->solution;

     unset($systm_arr[$solution_index]);
    }
    
    if ($request->automated) {
        $automated_index =$request->automated;

     unset($systm_arr[$automated_index]);
    }

       if ($request->dbcube) {
           $dbcube_index =$request->dbcube;

        unset($systm_arr[$dbcube_index]);
       }
        $remarks_text = implode(', ', $systm_arr);
        $email = $request->email_to;
        $branch_code = $request->branch_code;
        $br_code = $request->branch_name;

        if ($request->sub_branch_name) {

            $sub_br_pk = $request->sub_branch_name;

        }else{

             $sub_br_pk="";
        }
       



       $single_branch_data = DB::table('branch_info')->where('bnk_br_id',$br_code)->first();

        $branch_name = $single_branch_data->name;
       $previous_mnth = $request->previous_mnth;
       
        $date = $request->date;
        $received_date = date('Y-m-d', strtotime($request->received_date));
        $change_req_yes = $request->change_req_yes;
        $change_req_no = $request->change_req_no;
        
        if ($change_req_yes) {
            $change_req=$change_req_yes;
        }elseif($change_req_no){
            $change_req=$change_req_no;
        }else{
             $change_req = '';
        }
        

        $change_exe_yes = $request->change_exe_yes;
        $change_exe_no = $request->change_exe_no;

       

        if ($change_exe_yes) {
          $change_exe = $request->change_exe_yes;

        }elseif($change_exe_no){

            $change_exe = $request->change_exe_no;
        }else{
             $change_exe = '';
        }

        $division_name='';

        if ($request->division_name) {
           
           $division_name = $request->division_name;
        }

        // $branch_maker_name = $request->branch_maker_name;
        // $maker_designation = $request->maker_designation;
        // $branch_checker_name = $request->branch_checker_name;
        // $checker_designation = $request->checker_designation;

        $branch_maker_id = Auth::user()->id;

       $last_inserted_id = DB::table('audit_id')->insertGetId([
            'branch_code'=>$branch_code,
            'branch_name'=>$branch_name,
            'date'=>$date,
            'received_date'=>$received_date,
            'change_req'=>$change_req,
            'change_exe'=>$change_exe,
            'maker'=>$branch_maker_id,
            'maker_designation'=>'',
            'checker'=>'',
            'checker_designation'=>'',
            'entry_date'=>date('Y-m-d'),
            'status'=>'0',
            'email'=>$email,
            'previous_month'=>$previous_mnth,
            'remarks_system'=>$remarks_text,
            'division_name'=>$division_name,
            'sub_br_pk'=>$sub_br_pk,

        ]);

       
        // ubs data entry if selected  section start
        if($request->has('UBS')){           
            

            if (empty($request->input('ubs_user_id'))) {
                $ubs_entry_count =1;
            }
            else
            {
                $ubs_entry_count = count($request->input('ubs_user_id'));
                for($i=0; $i<$ubs_entry_count; $i++){
                $ubs_user_id = $request->input('ubs_user_id')[$i];
                $ubs_name = $request->input('ubs_name')[$i];
                $ubs_action = $request->input('ubs_action')[$i];
                $ubs_dbl_period = $request->input('ubs_dbl_period')[$i];
                $ubs_remarks = $request->input('ubs_remarks')[$i];
                try{
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('UBS'),
                        'user_id'=>$ubs_user_id,
                        'name'=>$ubs_name,
                        'action'=>$ubs_action,
                        'disable_period'=>$ubs_dbl_period,
                        'remarks'=>$ubs_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
            }
            
        }
        // ubs data entry if selected  section end
        
        // rtgs data entry if selected  section start
        if($request->has('RTGS')){          
            $rtgs_entry_count = count($request->input('rtgs_user_id'));
            for($i=0; $i<$rtgs_entry_count; $i++){
                $rtgs_user_id = $request->input('rtgs_user_id')[$i];
                $rtgs_name = $request->input('rtgs_name')[$i];
                $rtgs_action = $request->input('rtgs_action')[$i];
                $rtgs_dbl_period = $request->input('rtgs_dbl_period')[$i];
                $rtgs_remarks = $request->input('rtgs_remarks')[$i];
                try{
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('RTGS'),
                        'user_id'=>$rtgs_user_id,
                        'name'=>$rtgs_name,
                        'action'=>$rtgs_action,
                        'disable_period'=>$rtgs_dbl_period,
                        'remarks'=>$rtgs_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // rtgs data entry if selected  section end


        // CPS data entry if selected  section start
        if($request->has('CPS')){          
            $cps_entry_count = count($request->input('cps_user_id'));

            for($i=0; $i<$cps_entry_count; $i++){
                $cps_user_id = $request->input('cps_user_id')[$i];
                $cps_name = $request->input('cps_name')[$i];
                $cps_action = $request->input('cps_action')[$i];
                $cps_dbl_period = $request->input('cps_dbl_period')[$i];
                $cps_remarks = $request->input('cps_remarks')[$i];
                try{
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('CPS'),
                        'user_id'=>$cps_user_id,
                        'name'=>$cps_name,
                        'action'=>$cps_action,
                        'disable_period'=>$cps_dbl_period,
                        'remarks'=>$cps_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // CPS data entry if selected  section end


         // EFTN data entry if selected  section start
        if($request->has('EFTN')){          
            $eftn_entry_count = count($request->input('eftn_user_id'));

            for($i=0; $i<$eftn_entry_count; $i++){
                $eftn_user_id = $request->input('eftn_user_id')[$i];
                $eftn_name = $request->input('eftn_name')[$i];
                $eftn_action = $request->input('eftn_action')[$i];
                $eftn_dbl_period = $request->input('eftn_dbl_period')[$i];
                $eftn_remarks = $request->input('eftn_remarks')[$i];
                try{
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('EFTN'),
                        'user_id'=>$eftn_user_id,
                        'name'=>$eftn_name,
                        'action'=>$eftn_action,
                        'disable_period'=>$eftn_dbl_period,
                        'remarks'=>$eftn_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // EFTN data entry if selected  section end


         // GEFU data entry if selected  section start
        if($request->has('GEFU')){          
            $eftn_entry_count = count($request->input('gefu_user_id'));

            for($i=0; $i<$eftn_entry_count; $i++){
                $gefu_user_id = $request->input('gefu_user_id')[$i];
                $gefu_name = $request->input('gefu_name')[$i];
                $gefu_action = $request->input('gefu_action')[$i];
                $gefu_dbl_period = $request->input('gefu_dbl_period')[$i];
                $gefu_remarks = $request->input('gefu_remarks')[$i];
                try{

                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('GEFU'),
                        'user_id'=>$gefu_user_id,
                        'name'=>$gefu_name,
                        'action'=>$gefu_action,
                        'disable_period'=>$gefu_dbl_period,
                        'remarks'=>$gefu_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // GEFU data entry if selected  section end


         // remitbook data entry if selected  section start
        if($request->has('remitbook')){          
            $remitbook_entry_count = count($request->input('remitbook_user_id'));

            for($i=0; $i<$remitbook_entry_count; $i++){

                $remitbook_user_id = $request->input('remitbook_user_id')[$i];
                $remitbook_name = $request->input('remitbook_name')[$i];
                $remitbook_action = $request->input('remitbook_action')[$i];
                $remitbook_dbl_period = $request->input('remitbook_dbl_period')[$i];
                $remitbook_remarks = $request->input('remitbook_remarks')[$i];
                try{
                    
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('remitbook'),
                        'user_id'=>$remitbook_user_id,
                        'name'=>$remitbook_name,
                        'action'=>$remitbook_action,
                        'disable_period'=>$remitbook_dbl_period,
                        'remarks'=>$remitbook_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // remitbook data entry if selected  section end

                // docudex data entry if selected  section start
                if($request->has('docudex')){          
                    $docudex_entry_count = count($request->input('docudex_user_id'));
        
                    for($i=0; $i<$docudex_entry_count; $i++){
                        
                        $docudex_user_id = $request->input('docudex_user_id')[$i];
                        $docudex_name = $request->input('docudex_name')[$i];
                        $docudex_action = $request->input('docudex_action')[$i];
                        $docudex_dbl_period = $request->input('docudex_dbl_period')[$i];
                        $docudex_remarks = $request->input('docudex_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('docudex'),
                                'user_id'=>$docudex_user_id,
                                'name'=>$docudex_name,
                                'action'=>$docudex_action,
                                'disable_period'=>$docudex_dbl_period,
                                'remarks'=>$docudex_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // docudex data entry if selected  section end
        
                // csms data entry if selected  section start
                if($request->has('csms')){          
                    $csms_entry_count = count($request->input('csms_user_id'));
        
                    for($i=0; $i<$csms_entry_count; $i++){
                        
                        $csms_user_id = $request->input('csms_user_id')[$i];
                        $csms_name = $request->input('csms_name')[$i];
                        $csms_action = $request->input('csms_action')[$i];
                        $csms_dbl_period = $request->input('csms_dbl_period')[$i];
                        $csms_remarks = $request->input('csms_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('csms'),
                                'user_id'=>$csms_user_id,
                                'name'=>$csms_name,
                                'action'=>$csms_action,
                                'disable_period'=>$csms_dbl_period,
                                'remarks'=>$csms_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // csms data entry if selected  section end
                // nsmart data entry if selected  section start
                if($request->has('nsmart')){          
                    $nsmart_entry_count = count($request->input('nsmart_user_id'));
        
                    for($i=0; $i<$nsmart_entry_count; $i++){
                        
                        $nsmart_user_id = $request->input('nsmart_user_id')[$i];
                        $nsmart_name = $request->input('nsmart_name')[$i];
                        $nsmart_action = $request->input('nsmart_action')[$i];
                        $nsmart_dbl_period = $request->input('nsmart_dbl_period')[$i];
                        $nsmart_remarks = $request->input('nsmart_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('nsmart'),
                                'user_id'=>$nsmart_user_id,
                                'name'=>$nsmart_name,
                                'action'=>$nsmart_action,
                                'disable_period'=>$nsmart_dbl_period,
                                'remarks'=>$nsmart_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // nsmart data entry if selected  section end
                // land data entry if selected  section start
                if($request->has('land')){          
                    $land_entry_count = count($request->input('land_user_id'));
        
                    for($i=0; $i<$land_entry_count; $i++){
                        
                        $land_user_id = $request->input('land_user_id')[$i];
                        $land_name = $request->input('land_name')[$i];
                        $land_action = $request->input('land_action')[$i];
                        $land_dbl_period = $request->input('land_dbl_period')[$i];
                        $land_remarks = $request->input('land_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('land'),
                                'user_id'=>$land_user_id,
                                'name'=>$land_name,
                                'action'=>$land_action,
                                'disable_period'=>$land_dbl_period,
                                'remarks'=>$land_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // land data entry if selected  section end
                // call_center data entry if selected  section start
                if($request->has('call_center')){          
                    $call_center_entry_count = count($request->input('call_center_user_id'));
        
                    for($i=0; $i<$call_center_entry_count; $i++){
                        
                        $call_center_user_id = $request->input('call_center_user_id')[$i];
                        $call_center_name = $request->input('call_center_name')[$i];
                        $call_center_action = $request->input('call_center_action')[$i];
                        $call_center_dbl_period = $request->input('call_center_dbl_period')[$i];
                        $call_center_remarks = $request->input('call_center_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('call_center'),
                                'user_id'=>$call_center_user_id,
                                'name'=>$call_center_name,
                                'action'=>$call_center_action,
                                'disable_period'=>$call_center_dbl_period,
                                'remarks'=>$call_center_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // call_center data entry if selected  section end
                // tp_kyc data entry if selected  section start
                if($request->has('tp_kyc')){          
                    $tp_kyc_entry_count = count($request->input('tp_kyc_user_id'));
        
                    for($i=0; $i<$tp_kyc_entry_count; $i++){
                        
                        $tp_kyc_user_id = $request->input('tp_kyc_user_id')[$i];
                        $tp_kyc_name = $request->input('tp_kyc_name')[$i];
                        $tp_kyc_action = $request->input('tp_kyc_action')[$i];
                        $tp_kyc_dbl_period = $request->input('tp_kyc_dbl_period')[$i];
                        $tp_kyc_remarks = $request->input('tp_kyc_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('tp_kyc'),
                                'user_id'=>$tp_kyc_user_id,
                                'name'=>$tp_kyc_name,
                                'action'=>$tp_kyc_action,
                                'disable_period'=>$tp_kyc_dbl_period,
                                'remarks'=>$tp_kyc_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // tp_kyc data entry if selected  section end
                // cpc data entry if selected  section start
                if($request->has('cpc')){          
                    $cpc_entry_count = count($request->input('cpc_user_id'));
        
                    for($i=0; $i<$cpc_entry_count; $i++){
                        
                        $cpc_user_id = $request->input('cpc_user_id')[$i];
                        $cpc_name = $request->input('cpc_name')[$i];
                        $cpc_action = $request->input('cpc_action')[$i];
                        $cpc_dbl_period = $request->input('cpc_dbl_period')[$i];
                        $cpc_remarks = $request->input('cpc_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('cpc'),
                                'user_id'=>$cpc_user_id,
                                'name'=>$cpc_name,
                                'action'=>$cpc_action,
                                'disable_period'=>$cpc_dbl_period,
                                'remarks'=>$cpc_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // cpc data entry if selected  section end
                // solution data entry if selected  section start
                if($request->has('solution')){          
                    $solution_entry_count = count($request->input('solution_user_id'));
        
                    for($i=0; $i<$solution_entry_count; $i++){
                        
                        $solution_user_id = $request->input('solution_user_id')[$i];
                        $solution_name = $request->input('solution_name')[$i];
                        $solution_action = $request->input('solution_action')[$i];
                        $solution_dbl_period = $request->input('solution_dbl_period')[$i];
                        $solution_remarks = $request->input('solution_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('solution'),
                                'user_id'=>$solution_user_id,
                                'name'=>$solution_name,
                                'action'=>$solution_action,
                                'disable_period'=>$solution_dbl_period,
                                'remarks'=>$solution_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // solution data entry if selected  section end
                // automated data entry if selected  section start
                if($request->has('automated')){          
                    $automated_entry_count = count($request->input('automated_user_id'));
        
                    for($i=0; $i<$automated_entry_count; $i++){
                        
                        $automated_user_id = $request->input('automated_user_id')[$i];
                        $automated_name = $request->input('automated_name')[$i];
                        $automated_action = $request->input('automated_action')[$i];
                        $automated_dbl_period = $request->input('automated_dbl_period')[$i];
                        $automated_remarks = $request->input('automated_remarks')[$i];
                        try{
                            
                            DB::table('audit_system')->insert([
                                'audit_id'=>$last_inserted_id,
                                'system_id'=>$request->input('automated'),
                                'user_id'=>$automated_user_id,
                                'name'=>$automated_name,
                                'action'=>$automated_action,
                                'disable_period'=>$automated_dbl_period,
                                'remarks'=>$automated_remarks
                            ]);
                        }catch(Exception $e){
                            return $e->getMessage();
                        }
                        
                    }
                }
                // automated data entry if selected  section end
        

        // dbcube data entry if selected  section start
        if($request->has('dbcube')){          
            $dbcube_entry_count = count($request->input('dbcube_user_id'));

            for($i=0; $i<$dbcube_entry_count; $i++){
                
                $dbcube_user_id = $request->input('dbcube_user_id')[$i];
                $dbcube_name = $request->input('dbcube_name')[$i];
                $dbcube_action = $request->input('dbcube_action')[$i];
                $dbcube_dbl_period = $request->input('dbcube_dbl_period')[$i];
                $dbcube_remarks = $request->input('dbcube_remarks')[$i];
                try{
                    
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('dbcube'),
                        'user_id'=>$dbcube_user_id,
                        'name'=>$dbcube_name,
                        'action'=>$dbcube_action,
                        'disable_period'=>$dbcube_dbl_period,
                        'remarks'=>$dbcube_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // dbcube data entry if selected  section end


        // Passport data entry if selected  section start
        if($request->has('Passport')){          
            $Passport_entry_count = count($request->input('passport_user_id'));

            for($i=0; $i<$Passport_entry_count; $i++){
                
                $Passport_user_id = $request->input('passport_user_id')[$i];
                $Passport_name = $request->input('passport_name')[$i];
                $Passport_action = $request->input('passport_action')[$i];
                $passport_dbl_period = $request->input('passport_dbl_period')[$i];
                $Passport_remarks = $request->input('passport_remarks')[$i];
                try{
                    
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('Passport'),
                        'user_id'=>$Passport_user_id,
                        'name'=>$Passport_name,
                        'action'=>$Passport_action,
                        'disable_period'=>$passport_dbl_period,
                        'remarks'=>$Passport_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // Passport data entry if selected  section end


        // BKash data entry if selected  section start
        if($request->has('BKash')){          
            $bkash_entry_count = count($request->input('bkash_user_id'));

            for($i=0; $i<$bkash_entry_count; $i++){
                
                $bkash_user_id = $request->input('bkash_user_id')[$i];
                $bkash_name = $request->input('bkash_name')[$i];
                $bkash_action = $request->input('bkash_action')[$i];
                $bkash_dbl_period = $request->input('bkash_dbl_period')[$i];
                $bkash_remarks = $request->input('bkash_remarks')[$i];
                try{
                    
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('BKash'),
                        'user_id'=>$bkash_user_id,
                        'name'=>$bkash_name,
                        'action'=>$bkash_action,
                        'disable_period'=>$bkash_dbl_period,
                        'remarks'=>$bkash_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // BKash data entry if selected  section end


        // Utility_Bill data entry if selected  section start
        if($request->has('Utility_Bill')){          
            $utility_entry_count = count($request->input('utility_user_id'));

            for($i=0; $i<$utility_entry_count; $i++){
                
                $utility_user_id = $request->input('utility_user_id')[$i];
                $utility_name = $request->input('utility_name')[$i];
                $utility_action = $request->input('utility_action')[$i];
                $utility_dbl_period = $request->input('utility_dbl_period')[$i];
                $utility_remarks = $request->input('utility_remarks')[$i];
                try{
                    
                    DB::table('audit_system')->insert([
                        'audit_id'=>$last_inserted_id,
                        'system_id'=>$request->input('Utility_Bill'),
                        'user_id'=>$utility_user_id,
                        'name'=>$utility_name,
                        'action'=>$utility_action,
                        'disable_period'=>$utility_dbl_period,
                        'remarks'=>$utility_remarks
                    ]);
                }catch(Exception $e){
                    return $e->getMessage();
                }
                
            }
        }
        // Utility_Bill data entry if selected  section end

       return redirect()->back()->with('response', 'IT WORKS!');

    } // end audit_sheet_form_submit function


    function audit_sheet(){


        return view('audit_sheet.audit_sheet_table');

    }

    function authorize_audit_sheet(Request $request){

        if ($request->ajax()) {
            try {
                

                 $id =  $request->id;

                 $audit_data = DB::table('audit_id')->where('id', $id)->first();

                  $email = $audit_data->email;
                 $mail_exp = explode(',', $email);




                 $checker_id = Auth::user()->id;
               
                $single_blog = DB::table('audit_id')->where('id',$id)->update(
                  [
                   
                   'status'=>'1',
                   'checker'=>$checker_id,
                    
                  ]

                );


                // Audit Sheet Mail Part

                  $subject = "Audit Sheet";
                  
                  $request_sent_date=date('Y-m-d');
                  $branch_code=Auth::user()->branch;

                 $branch_info = DB::table('branch_info')->where('bnk_br_id',$branch_code)->first();
                 $branch_name = $branch_info->name;
                 $mailled_by=Auth::user()->name;
                 $user_id=Auth::user()->user_id;
                 $role_id =Auth::user()->role;

                 $role_data = DB::table('role_table')->where('sl',$role_id)->first();
                $role_name = $role_data->role_name;


                 foreach ($mail_exp as  $mail_value) {
                    
                   
                    $mail_to = $mail_value;

                     $this->audit_sheet_mail_send($mail_to, $subject,  $request_sent_date,$branch_name,$mailled_by,$user_id,$role_name,$id);

                 }

                 // Audit Sheet Mail Part end

               

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        } else {
            echo 'This request is not ajax !';
        }

    } // end authorize audit sheet function



    public function delete_audit_sheet(Request $request){

         if ($request->ajax()) {
            try {
                

                 $id =  $request->id;

                  DB::table('audit_id')->where('id', $id)->delete();
                  
                  DB::table('audit_system')->where('audit_id', $id)->delete();

               

                 // Audit Sheet Mail Part end

               

            } catch (\Exception $e) {
                echo $e->getMessage();
            }

        } else {
            echo 'This request is not ajax !';
        }

    }

//find out branch code 

public function getBranchCode(Request $request)
{
    
    $branch_id  = $request->branch_id;

   $branch_result  =DB::table('branch_info')->select('bnk_br_id')->where('bnk_br_id', $branch_id)->first();

    echo json_encode($branch_result);
}
    
    public function get_sub_branch(Request $request){

      $branch_code = $request->branch_code;
       $sub_br_data_count = DB::table('branch_info')->where('bnk_br_id', $branch_code)->where('brinfo_flag',2)->count();

       if ($sub_br_data_count>0) {

         

                $view = view('audit_sheet_sub_branch_show', compact('branch_code'))->render();
                return response()->json(['html' => $view]);
       
       }

    }   // get  branch function



}
