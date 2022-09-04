<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSecurityController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function menu_add(){
    	

    	return view('user_security.menu_add');
    }

    public function menu_add_data_submit(Request $request){

    	//echo "This is submit";

    	$success=0;
		$error=0;

    	$role_name= $request->rolename;

		 $b = $request->bnk;
		$user = Auth::user()->name;


	

		$role_check = DB::table('role_table')->where('role_name','=',$role_name)->count();

		if($role_check >0){

			return back()->with('status_warning', 'This role Already Exist !');

		}else{

			$last_inserted_role_id = DB::table('role_table')->insertGetId([

				'role_name'=>$role_name,
				'created_by'=>$user
			]);

			foreach ($b as $key => $value) {
				// echo $value;
				// echo "<br>";

				// print "SELECT * FROM menu_table  where sl='$value' ";die;
				$my_data = DB::select(DB::raw("SELECT * FROM menu_table  where sl='$value' "))[0];

				$menu_name = $my_data->menu_name;
				$link = $my_data->link;
				$status = $my_data->status;
				 $parent = $my_data->parent;

			
				$my_data_parent = DB::select(DB::raw("SELECT MAX(sl) as max_sl FROM menu_table  where sl='$parent' "))[0];
				 $parent_final = $my_data_parent->max_sl;

				$icon = $my_data->icon;
				$role = $my_data->role;
				
				$menu_id = DB::table('menu_table')->insertGetId([
					"menu_name"=>$menu_name,
					"link"=>$link,
					"status"=>$status,
					"parent"=>$parent_final,
					"icon"=>$icon,
					"role"=>$last_inserted_role_id
				]);

				if($status == '1'){
					$find_parent_id = $menu_id;
				}

				if(str_replace(" ", "", $status) == "2" or str_replace(" ", "", $status) == 2){
					$sql = "UPDATE menu_table SET parent='$find_parent_id' WHERE sl='$menu_id'";
					DB::table('menu_table')->where('sl',$menu_id)->update([
						"parent" => $find_parent_id
					]);
				}

				

				
			}

			return redirect()->back();


		}
	



	}


	public function existing_role_edit(Request $request){

		if ($request->ajax()) {
            try {

                $row_id =  $request->row_id;
               

                 $role_data = DB::table('role_table')
          
            ->where('role_table.sl', $row_id)
            ->first();


                $single_fetch_data = DB::table('menu_table')
          
            ->where('menu_table.sl', $row_id)
            ->get();

           

                $view = view('single_fetch_existing_role_data', compact('single_fetch_data','role_data'))->render();
                return response()->json(['html' => $view]);
                
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }

	}


	public function create_a_new_user(){

		return view('user_security.new_user_create');
	}


	public function new_user_data_submit(Request $request){

		if ($request->ajax()) {
            try {

                $user_name =  $request->user_name;
                $user_role =  $request->user_role;
                $branch_code =  $request->branch_name;
                $phone =  $request->phone;
                $email =  $request->email;
                $designation =  $request->designation;
                $password =  $request->password;
                $user_id =  $request->user_id;
                $status =  $request->status;
                $datepicker =  $request->datepicker;

                 $exp_date = date('Y-m-d', strtotime($datepicker));

                $date=date("Y-m-d H:i:s");
                $update_date=date("Y-m-d");
                
                //$single_blog = Blog::find($row_id);
                $single_blog = DB::table('users')->insert(
                	[
                		'name'=>$user_name,
                        'email'=>$email,
                        'role'=>$user_role,
                        'status_id'=>1,
                        'password'=>Hash::make($password),
                        'created_at'=>$date,
                        'branch'=>$branch_code,
                        'contact'=>$phone,
                        'designation'=>$designation,
                        'expired_date'=>$exp_date,

                	]
                );


            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo 'This request is not ajax !';
        }

	}// end new user data submit function


	function user_edit_data(Request $request){

		if ($request->ajax()) {
            try {

                $user_id =  $request->id;
               

                 $user_data = DB::table('users')
          
            ->where('users.id', $user_id)
            ->first();

             // $user_data->name;
         
                $view = view('user_security.new_user_edit', compact('user_data'))->render();
                return response()->json(['html' => $view]);
                
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
	}


	// function new_user_data_update(Request $request){

	// 	if ($request->ajax()) {
 //            try {

 //                $hidden_id =  $request->hidden_id;
 //                $user_name =  $request->user_name;
 //                $emp_id =  $request->emp_id;
 //                $user_role =  $request->user_role;
 //                $branch_name =  $request->branch_name;
 //                $phone =  $request->phone;
 //                $email =  $request->email;
 //                $designation =  $request->designation;
 //                $user_id =  $request->user_id;
 //                $status =  $request->status;
               

 //                DB::table('users')->where('id',$hidden_id)->update([
                	
 //                	"name"=>$user_name,
 //                	"email"=>$email,
 //                	"role"=>$user_role,
 //                	"status_id"=>$status,
 //                	"branch"=>$branch_name,
 //                	"contact"=>$phone,
 //                	"designation"=>$designation,
 //                	"user_id"=>$user_id,
                	
 //                ]);
                
 //            } catch (\Exception $e) {
 //                echo $e->getMessage();
 //            }


 //        } else {
 //            echo 'This request is not ajax !';
 //        }

	// }


	function edit_profile(){

		return view('user_security.edit_profile');
	}

	function update_profile(Request $request){

       // return json_encode($request->all());

		if ($request->ajax()) {
            try {

                $hidden_id =  $request->hidden_id;
               
                $user_role =  $request->user_role;


                $branch_name =  $request->branch_name; //get branch code

                if ($branch_name=='202' && ($user_role=='1' || $user_role=='5') ) {

                    echo '0';
                   
                  die;
                }
               
                $designation =  $request->designation;
                $user_id =  $request->user_id;
                $division_name =  $request->division_name;

                 if ($request->phone) {

                   $phone =  $request->phone;

                }else{
                    $phone="";
                }

                if ($request->emp_id) {

                   $emp_id =  $request->emp_id;

                }else{
                    $emp_id="";
                }

                if ($request->ip_phone) {

                   $ip_phone =  $request->ip_phone;

                }else{
                    $ip_phone="";
                }
                
                
				$branch_info_flag =  1;
                
				if($request->input('sub_branch_id') != ''){
					
					$branch_info_flag =  2;
                    $sub_branch_id =  $request->sub_branch_id;

				}else{

                    $sub_branch_id="";
                }

              

					
					$status = 1;
					
					if($user_role == 2){ // it Maker
						$status = 0;
					}


                    if($user_role == 6){ // it checker
                        $status = 0;
                    }
					
					if($user_role == 5){ // branch checker
						$status = 0;
					}

                   

					if($user_role == 10){ // division checker
						$status = 0;
					}
                
               

                  // start profile edit log

                $get_old_data = DB::table('users')->where('id', $hidden_id)->first();   

                DB::table('edit_profile_log')->insert([
                    
                    "user_pk_id"=>$hidden_id,
                    "old_branch"=>$get_old_data->branch,
                    "present_branch"=>$branch_name,

                    "old_division"=>$get_old_data->division_name,
                    "present_division"=>$division_name,

                    "old_designation"=>$get_old_data->designation,
                    "present_designation"=>$designation,

                    "old_user_role"=>$get_old_data->role,
                    "present_user_role"=>$user_role,

                     "old_emp_id"=>$get_old_data->emp_id,
                     "present_emp_id"=>$emp_id,


                ]);

                // end profile edit log

                $todays_date = date('Y-m-d h:i:s');

                DB::table('users')->where('id',$hidden_id)->update([                	
                	
                	"role"=>$user_role,                	
                	"branch"=>$branch_name,
                	"emp_id"=>$emp_id,
                    "contact"=>$phone,
                	"designation"=>$designation,
                	"division_name"=>$division_name,                	
                	"status_id"=>$status,   
					"br_info_flag" => $branch_info_flag,
                    "ip_phone" => $ip_phone,
                    "br_pk_id"=>$sub_branch_id,
                    "updated_at"=>$todays_date
                ]);


              
 
				if($user_role == 2){ // it Maker
					$this->getLogout(); // logout and redirect login page
				}


                if($user_role == 6){ // it checker
                    $this->getLogout(); // logout and redirect login page
                }
				
				if($user_role == 5){ // branch checker
					$this->getLogout(); // logout and redirect login page
				}

				

               

                if($user_role == 10){ // division checker
                    $this->getLogout(); // logout and redirect login page
                }				
                    

                
            } catch (\Exception $e) {
                echo $e->getMessage();
            }


        } else {
            echo 'This request is not ajax !';
        }
	}
	
	
	
	public function getLogout(){
		Auth::logout();
		return redirect()->back();
	}
	
	
	
	// find sub branch 
	public function findSubBranch(Request $request){
		if($request->has('branch_id')){
			$branch_id = $request->input('branch_id');
			$data = DB::table('branch_info')->select('agent_br_key','name as branch_name')->where('br_code', $branch_id)->where('brinfo_flag', 2)->get();

			$output="";
			if($data->count() > 0){
				$output = "<option value=''>Select Sub Branch</option>";
				foreach($data as $sb){
					$sub_branch_id = $sb->agent_br_key;
					$sub_branch_name = $sb->branch_name;
					$output .= "<option value='$sub_branch_id'>$sub_branch_name</option>";
				}
			}else{
				echo "0";
			}
			
			return $output;
		}
	}



}
