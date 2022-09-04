<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SelfRegController extends Controller
{   


    
    
    public function find_user_role(Request $request){

            if ($request->ajax()) {

               $division_name = $request->division_name;

               if ($division_name=='IT Division') {


                 

                                                 

                  $output = "<option value='' >--Select --</option>";
                  $output.= "<option value='2' >IT Maker</option>";
               
                  $output.= "<option value='6'>IT Checker</option>";


                  return $output;

                  
               }else{

                    $output = "<option value='' >--Select --</option>";
                  $output.= "<option value='9' >Head Office Division Maker</option>";
               
                  $output.= "<option value='10'>Head Office Division Checker</option>";


                  return $output;

               }

            }
    }

    

    public function selfreg(){

       return view('self_reg.self_reg');

    }

   public function get_data_from_ad(Request $request){

        if ($request->ajax()) {
            try {

                $adServer   = "192.168.180.184";
                $adPort     = "389";

               $usr = $request->user_id;
               $password = $request->password;

               $ldap_con   = ldap_connect($adServer,$adPort);
                $username   = trim($usr);
                $domain     = '@dhakabank.com.bd';
                $attributes = array("displayname", "mail", "samaccountname"); 


        $domain     = '@dhakabank.com.bd';
        $attributes = array("displayname", "mail", "samaccountname"); 

        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);
        $dn        = "DC=dhakabank,DC=com,DC=bd";
        $ldap_bind = ldap_bind($ldap_con, $username.$domain, $password);

         if($ldap_bind ){
        
        //$filter  = "(&(sAMAccountName=$username))";
        $filter  = "(&(samaccountname=$username))";
        $search  = ldap_search($ldap_con,$dn,$filter);
        $entries = ldap_get_entries($ldap_con, $search);
        //  file_put_contents('tt.txt', 'halim'."\n",FILE_APPEND);
        // file_put_contents('tt.txt', json_encode($entries)."\n",FILE_APPEND);
        // echo "<pre>";
        // print_r($entries);die;

        $department="";
        for ($i=0; $i<$entries["count"]; $i++){
            if($entries['count'] > 1){
                break;
            }
            

             $ad_username = $entries[$i]["samaccountname"][0];
             $mail = $entries[$i]["mail"][0]; 
             $designation = $entries[$i]["title"][0]; 
             $fullname = $entries[$i]["displayname"][0]; 
             $department = $entries[$i]["department"][0];

             $data =['ad_user_name'=>$ad_username,'ad_mail'=>$mail, 'ad_designation'=>$designation,
             'ad_fullname'=>$fullname, 'ad_dept'=>$department];

            echo json_encode($data);          
        }
        
    }else{
        echo "Connection Failed!";
    }

    @ldap_close($ldap_con);
               

            }catch(\Exception $e){
                $e->getMessage();
            }
    }

}

    public function self_reg_submit(Request $request){
        

        if ($request->ajax()) {
            try {

              date_default_timezone_set('Asia/Dhaka');

               $user_id = $request->user_id;
               $check_exist_user = DB::table('users')->where('user_id', $user_id)->count();

               if ($check_exist_user>0) {

                  $response = [
                        "type"=>"warning",
                        "status" => 400,
                        "success" => false,
                        "buttonText"=> "Okay",
                        "message" => "This User Already Exist "
                    ];
                    return response()->json($response);
               }
               
                $department_name =  "";
                $mobile_number =  $request->mobile_number;
                $email_address =  $request->email_address;
                $password =  $request->password;

                $emp_name =  $request->emp_name;

                if ($request->ip_phone) {
                   $ip_phone =  $request->ip_phone;
                }else{
                  $ip_phone ="";
                }
               
                $designation = $request->designation;

                $branch_code =  $request->branch_name;
                $sub_branch_name =  $request->sub_branch_name;

               
               
                if ($branch_code=='202' && $request->division_name) { // Only Head Office

                    $division_name =  $request->division_name;

                }else{

                      $division_name =  "";
                }
                 $division_id =  $request->division_id;

                 $user_role_ho =  $request->user_role_ho_maker;

                // if($user_role_ho) {

                //        $user_role = $user_role_ho;

                //     }else{
                        
                //         
                //     }   
                  $user_role =  $request->user_role;
                if($division_id && $branch_code=='202'){

                    $division_id =  $request->division_id;
                    
                }else{

                     $division_id='';
                }

              

                if ($user_role==1) {
                    $status_id=1;

                }elseif ($user_role==5) {
                    $status_id=0;

                  
                  

                  


                }elseif ($user_role_ho==2) { //ho maker
                    $status_id=0;

                }elseif ($user_role_ho==6) {
                    $status_id=0;

                }elseif ($user_role_ho==9) {    //ho div maker
                    $status_id=1;

                }elseif ($user_role_ho==10) {  //ho div checker
                    $status_id=0;

                }elseif ($user_role_ho==8) {  //ho auth
                    $status_id=1;
                }

// file_put_contents('halim.txt', $sub_branch_name.'\n'.$, FILE_APPEND);

                if ($sub_branch_name!='') {

                    $br_pk_id=$request->sub_branch_name;
                     $br_info_flag='2';

                }else{

                    $br_pk_id="";
                     $br_info_flag='1';
                }

                // file_put_contents('halim.txt', 'halim d434'.$branch_code, FILE_APPEND);die;

                if ($request->emp_id) {
                   $emp_id = $request->emp_id;
                }else{
                    $emp_id ="";
                }


               
                $today_date="";


                //active directory code

                    $adServer   = "192.168.180.184";
                    $adPort     = "389";

                    $usr        =$user_id; // from user input
                   // $usr        = 'ashakul.alam'; // from user input
                    //$usr        = 'userid.uat';
                    $password   =$password; // from user input
                    //$password   = 'Rony@IT007';
                    //$password   = 'Dbl##2021';

                   //  $ldap_con   = ldap_connect($adServer,$adPort);
                   //  $username   = trim($usr);

                   //  $domain     = '@dhakabank.com.bd';
                   //  $attributes = array("displayname", "mail", "samaccountname"); 



                   //                  // Talking to AD with Valid user
                   //  ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
                   //  ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);
                   //  $dn        = "DC=dhakabank,DC=com,DC=bd";
                   //  $ldap_bind = ldap_bind($ldap_con, $username.$domain, $password);
                    $ldap_bind =1;
                    if($ldap_bind){
                       
                        //$filter  = "(&(sAMAccountName=$username))";
                        // $filter  = "(&(samaccountname=$username))";
                        // $search  = ldap_search($ldap_con,$dn,$filter);
                        // $entries = ldap_get_entries($ldap_con, $search);
                        // echo "<pre>";
                        // print_r($entries);die;

                        // for ($i=0; $i<$entries["count"]; $i++){
                        //     if($entries['count'] > 1){
                        //         break;
                        //     }

                        //      $ad_username = $entries[$i]["samaccountname"][0];

                        //      $mail = $entries[$i]["mail"][0]; 
                        //      $designation = $entries[$i]["title"][0]; 
                        //      $fullname = $entries[$i]["displayname"][0]; 
                        //      $department = $entries[$i]["department"][0];          
                        // }

                        $ad_username = $user_id;
                         $mail = $email_address;
                         $designation = $designation;
                         $fullname = $emp_name;
                          $department = '';

                        // check branch selection start 
                        if($request->input('branch_name') != "202"){
                          $division_name = '';
                          $user_role = $request->input('user_role');
                        }

                        
                        
                         DB::table('users')->insert([

                            "name"=>$fullname,
                            "email"=>$mail,
                            "role"=>$user_role,
                            "status_id"=>$status_id,
                            "password"=>Hash::make("123456"),
                           
                            "created_at"=>date('Y-m-d h:i:s a'),
                            "updated_at"=>date('Y-m-d h:i:s a'),
                            "branch"=>$branch_code,
                            "contact"=>$mobile_number,
                            "designation"=>$designation,
                            "user_id"=>$ad_username,
                            "department"=>$department,
                            "division_name"=>$division_name,
                           
                            "login_level"=>'2',
                            "emp_id"=>$emp_id,
                            "br_info_flag"=>$br_info_flag,
                            "ip_phone"=>$ip_phone,
                            "br_pk_id"=>$br_pk_id

                        ]);


                        

                    // if ($user_role=='5') {


                    //         $user_br_checker_data = DB::select(DB::raw("SELECT *, bi.name as branch_name FROM users  left join branch_info bi on users.[branch]=bi.[bnk_br_id] where [role]='5' and [branch]='$branch_code' and [status_id]='1' "));

                    //         // file_put_contents('m_test.txt', "SELECT *, bi.name as branch_name FROM users  left join branch_info bi on users.[branch]=bi.[bnk_br_id] where [role]='5' and [branch]='$branch_code' and [status_id]='1' ");

                    //        foreach($user_br_checker_data as $single_user_br_checker_data){

                    //              $this->mail_send($single_user_br_checker_data->email, "New User Created", "Role : Branch Checker", "Branch Name : $single_user_br_checker_data->branch_name","-");
                    //        }

                    // }
                    


                    auth()->logout();
                    return view('auth.login');

                        
                    }else{

                       echo "";
                    }

                    @ldap_close($ldap_con);


                 
                //end active directory

                    

            } catch (\Exception $e) {
                
                 // DB::table('users')->insert([

                 //            "name"=>$emp_name,
                 //            "email"=>$email_address,
                 //            "role"=>$user_role,
                 //            "status_id"=>$status_id,
                 //            "password"=>Hash::make("123456"),
                           
                 //            "created_at"=>date('Y-m-d h:i:s a'),
                 //            "updated_at"=>date('Y-m-d h:i:s a'),
                 //            "branch"=>$branch_code,
                 //            "contact"=>$mobile_number,
                 //            "designation"=>$designation,
                 //            "user_id"=>$user_id,
                           
                 //            "division_name"=>$division_name,
                 //            "division_id"=>$division_id,
                 //            "login_level"=>'1',
                 //             "emp_id"=>$emp_id,
                 //             "br_info_flag"=>$br_info_flag,
                 //              "ip_phone"=>$ip_phone,
                 //            "br_pk_id"=>$br_pk_id

                 //        ]);

                        auth()->logout();
                        return 0;
            }


        } else {
            echo 'This request is not ajax !';
        }
    }

    

    public function branch_checker_request_list_approved(Request $request){

        if ($request->ajax()) {
            try {

                $id =  $request->id;
                
                $today_date=date('Y-m-d');
                
               $data_count = DB::table('users')->where('id',$id)->where('status_id',1)->count();

               if ($data_count>0) {
                   echo "0";
                   die;
               }else{

                    DB::table('users')->where('id',$id)->update([
                   
                        "status_id"=>1,
                        "updated_at"=>$today_date
                    ]);

               }
                


                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
    }


 public function branch_checker_request_list_decline(Request $request){

        if ($request->ajax()) {

            try {

                $id =  $request->id;
                $branch_code =  $request->branch_code;
                $division_name =  $request->division_name;
                
                $today_date=date('Y-m-d h:i:s');
                

               $data_usr = DB::table('users')->where('id',$id)->first();

               $role = $data_usr->role;

               //check already decline
                $data_count = DB::table('users')->where('id',$id)->where('status_id',1)->count();

               if ($data_count>0) {
                   echo "0";
                   die;
               }

               //end check already decline

               if ($role=='10') {

                 DB::table('users')->where('id',$id)->update(['role'=>'9', 'status_id'=>1]);

               }elseif ($role=='5'){

                  DB::table('users')->where('id',$id)->update(['role'=>'1', 'status_id'=>1]);
               
               }elseif($role=='6'){


               

                   $get_profile_log_data_count = DB::table('edit_profile_log')->where('user_pk_id',$id)->count();

                   if ($get_profile_log_data_count >0) {
                       
                       $get_profile_log_data = DB::table('edit_profile_log')->where('user_pk_id',$id)->first();
                       $old_branch = $get_profile_log_data->old_branch;

                       if ($old_branch=='202' && $division_name=='IT Division') {

                            DB::table('users')->where('id',$id)->update(['role'=>'2', 'status_id'=>1]);

                       }elseif ($old_branch=='202' && $division_name!='IT Division') {

                            DB::table('users')->where('id',$id)->update(['role'=>'9', 'status_id'=>1]);

                       }else{


                             DB::table('users')->where('id',$id)->update(['role'=>'1', 'status_id'=>1,'branch'=>$old_branch]);

                       }


                       //end count
                   }else{

                        $data_count_maker = DB::table('request_id')->where('br_maker', $id)
                    ->orWhere('br_checker',$id)
                    ->orWhere('ho_maker',$id)
                    ->orWhere('ho_checker',$id)
                    ->orWhere('ho_authorizer',$id)->count();


                     if ($data_count_maker=='0') {

                       $get_user_data = DB::table('users')->where('id',$id)->first();

                       $name = $get_user_data->name;
                       $email = $get_user_data->email;
                       $role = $get_user_data->role;
                       $status_id = $get_user_data->status_id;
                       $created_at = $get_user_data->created_at;
                       $updated_at = $get_user_data->updated_at;
                       $branch = $get_user_data->branch;
                       $contact = $get_user_data->contact;
                       $designation = $get_user_data->designation;
                       $user_id = $get_user_data->user_id;
                       $department = $get_user_data->department;
                       $division_id = $get_user_data->division_id;
                       $division_name = $get_user_data->division_name;
                       $login_level = $get_user_data->login_level;
                       $emp_id = $get_user_data->emp_id;
                       $br_info_flag = $get_user_data->br_info_flag;
                       $br_pk_id = $get_user_data->br_pk_id;
                       $ip_phone = $get_user_data->ip_phone;

                      DB::table('users_delete_log')->insert([

                        "d_log_name"=>$name,
                        "d_log_email"=>$email,
                        "d_log_role"=>$role,
                        "d_log_status_id"=>$status_id,
                        "d_log_created_at"=>$created_at,
                        "d_log_updated_at"=>$updated_at,
                        "d_log_branch"=>$branch,
                        "d_log_contact"=>$contact,
                        "d_log_designation"=>$designation,
                        "d_log_user_id"=>$user_id,
                        "d_log_department"=>$department,
                        "d_log_division_name"=>$division_name,
                        "d_log_login_level"=>$login_level,
                        "d_log_emp_id"=>$emp_id,
                        "d_log_br_pk_id"=>$br_pk_id,
                        "d_log_ip_phone"=>$ip_phone

                      ]);


                      DB::table('users')->where('id',$id)->delete();

                    }



                   }

                       

                    

               }elseif($role=='2'){



                 $get_profile_log_data_count = DB::table('edit_profile_log')->where('user_pk_id',$id)->count();

                   if ($get_profile_log_data_count >0) {
                       
                       $get_profile_log_data = DB::table('edit_profile_log')->where('user_pk_id',$id)->first();
                       $old_branch = $get_profile_log_data->old_branch;

                       if ($old_branch=='202' && $division_name=='IT Division') {

                            DB::table('users')->where('id',$id)->update(['role'=>'2', 'status_id'=>1]);

                       }elseif ($old_branch=='202' && $division_name!='IT Division') {

                            DB::table('users')->where('id',$id)->update(['role'=>'9', 'status_id'=>1]);

                       }else{


                             DB::table('users')->where('id',$id)->update(['role'=>'1', 'status_id'=>1,'branch'=>$old_branch]);

                       }


                       //end count
                   }else{

                        $data_count_maker = DB::table('request_id')->where('br_maker', $id)
                    ->orWhere('br_checker',$id)
                    ->orWhere('ho_maker',$id)
                    ->orWhere('ho_checker',$id)
                    ->orWhere('ho_authorizer',$id)->count();


                     if ($data_count_maker=='0') {

                       $get_user_data = DB::table('users')->where('id',$id)->first();

                       $name = $get_user_data->name;
                       $email = $get_user_data->email;
                       $role = $get_user_data->role;
                       $status_id = $get_user_data->status_id;
                       $created_at = $get_user_data->created_at;
                       $updated_at = $get_user_data->updated_at;
                       $branch = $get_user_data->branch;
                       $contact = $get_user_data->contact;
                       $designation = $get_user_data->designation;
                       $user_id = $get_user_data->user_id;
                       $department = $get_user_data->department;
                       $division_id = $get_user_data->division_id;
                       $division_name = $get_user_data->division_name;
                       $login_level = $get_user_data->login_level;
                       $emp_id = $get_user_data->emp_id;
                       $br_info_flag = $get_user_data->br_info_flag;
                       $br_pk_id = $get_user_data->br_pk_id;
                       $ip_phone = $get_user_data->ip_phone;

                      DB::table('users_delete_log')->insert([

                        "d_log_name"=>$name,
                        "d_log_email"=>$email,
                        "d_log_role"=>$role,
                        "d_log_status_id"=>$status_id,
                        "d_log_created_at"=>$created_at,
                        "d_log_updated_at"=>$updated_at,
                        "d_log_branch"=>$branch,
                        "d_log_contact"=>$contact,
                        "d_log_designation"=>$designation,
                        "d_log_user_id"=>$user_id,
                        "d_log_department"=>$department,
                        "d_log_division_name"=>$division_name,
                        "d_log_login_level"=>$login_level,
                        "d_log_emp_id"=>$emp_id,
                        "d_log_br_pk_id"=>$br_pk_id,
                        "d_log_ip_phone"=>$ip_phone

                      ]);


                      DB::table('users')->where('id',$id)->delete();

                    }



                   }



                 

               }

                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    } // branch_checker_request_list_decline

    public function sub_branch_show(Request $request){

         if ($request->ajax()) {
            try {

                $br_code =  $request->branch_code;
                

               // $bank_br_data = DB::table('branch_info')->where('bnk_br_id',"$bank_br_id")->first();
               // echo "<pre>";
               // print_r($bank_br_data);die;
               // echo $br_code = $bank_br_data->br_code;
               // $brinfo_flag = $bank_br_data->brinfo_flag;

               $br_code_data_count = DB::table('branch_info')->where('br_code',$br_code)->where('brinfo_flag',2)->count();

               //  echo"<pre>";
               // print_r($br_code_data);

               if ($br_code_data_count >0) {
                  
               
                $view = view('single_fetch_sub_branch', compact('br_code'))->render();

                return response()->json(['html' => $view]);

            }else{

                return 0;
            }
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }


    }  // end sub branch function




    


    public function rtgs_special_role_approved(Request $request){


            if ($request->ajax()) {


            try {

                $id =  $request->id;
                
                DB::table('users')->where('id', $id)->update(["role"=>8]);
              
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    } // end rtgs_special_role_approved


    public function special_role_decline(Request $request){

         if ($request->ajax()) {


            try {

                $id =  $request->id;
                
                DB::table('users')->where('id', $id)->update(["role"=>'9']);
              
                

            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

    } // end special role function


   
    
}
