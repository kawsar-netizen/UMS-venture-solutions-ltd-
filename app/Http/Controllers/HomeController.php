<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Rules\MatchOldPassword;

class HomeController extends Controller
{   
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }




    public function dashboard()
    {
        
        $role = Auth::user()->role;
        $userId = Auth::user()->id;


        $today_date = date('Y-m-d');
        $this_month = date('m');
       



// ..........role 1 (branch maker) operation start............

// for daily basis total (role 1)

        $dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 1) ends



// for monthly basis total (role 1)

         $monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 1) ends



// for overall basis total (role 1)

        $overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();




      $overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();



      $overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

// for overall basis total (role 1) ends


// ..........role 1 (branch maker) operation ends............





// ..........role 5 (branch checker) operation start............

// for daily basis total (role 5)

        $dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 5) ends



// for monthly basis total (role 5)

        $monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();





      $monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 5) ends



 // for overall basis total (role 5)

        $overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 5) ends  

// ..........role 5 (branch checker) operation ends............





// ..........role 2 (Head Maker) operation start............

// for daily basis total (role 2)

        $dailyHdMakerPendingForAuth = DB::table('request_id')
                
                 ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                 ->where('action_status_br_checker','!=','2')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();





       $dailyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and br_checker_sts_update_date='$today_date' "))[0];

// echo $dailyHdMakerPendingForApprove->sl;
// die;


// for daily basis total (role 2) ends



// for monthly basis total (role 2)

        $MonthlyHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')
                  ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();





      $MonthlyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and  month(br_checker_sts_update_date)='$this_month' "))[0];



// for monthly basis total (role 2) ends




// for overall basis total (role 2)

        $OverallHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')        
                ->count();





      $OverallHdMakerPendingForApprove =  DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL "))[0];



// for overall basis total (role 2) ends

// ..........role 2 (Head Maker) operation ends............





// ..........role 6 (Head Checker) operation start............


// for daily basis total (role 6)

        $dailyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') and br_checker_sts_update_date='$today_date'"))[0];

// echo $dailyHdCheckerWaitingForAuth->sl;
// die;


      $dailyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereDate('ho_chkr_aprove_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereDate('ho_chkr_recheck_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 6)

        $monthlyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='')  and month(br_checker_sts_update_date)='$this_month'"))[0];





      $monthlyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereMonth('ho_chkr_aprove_sts_update_date', '=', date('m'))
                ->count();



      $monthlyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereMonth('ho_chkr_recheck_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 6) ends




   // for overall basis total (role 6)

        $overallHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') "))[0];






      $overallHdCheckerAuthorized = DB::table('request_id')
                  ->where('action_status_ho_checker','=',5)         
                ->count();



      $overallHdCheckerRechecked = DB::table('request_id')
                 ->where('action_status_ho_checker','=',6)
                ->count();


// for overall basis total (role 6) ends             


// ..........role 6 (Head checker) operation ends............







// .............role 8 (Head Auth) start ................. 




// for daily basis total (role 8)


        $dailyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

and br_checker_sts_update_date='$today_date'"))[0];




      $dailyHdAuthAuthorized = DB::table('request_id')
                
                  ->where('ho_authorize_status','=',1)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 8)

        $monthlyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

   and month(br_checker_sts_update_date)='$this_month'"))[0];


  // echo   $monthlyHdAuthWaitingForAuth->sl_count;die;    





      $monthlyHdAuthAuthorized = DB::table('request_id')
                
                   ->where('ho_authorize_status','=',1)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();



      $monthlyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();


// for monthly basis total (role 8) ends




   // for overall basis total (role 8)

        $overallHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8' "))[0];




      $overallHdAuthAuthorized = DB::table('request_id')
                  ->where('ho_authorize_status','=',1)         
                ->count();



       $overallHdAuthDeclined = DB::table('request_id')
                 ->where('ho_authorize_status','=',0)
                ->count();


// for overall basis total (role 8) ends             


// ..........role 8 (Head checker) operation ends............





// ...........role 9 (Head Office Division Maker) Start...........     

    //for daily role 9 (Head Office Division Maker) Start


        $hodm_dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();

   //for daily role 9 (Head Office Division Maker) end  


   //for Monthly role 9 (Head Office Division Maker) Start

            $hodm_monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $hodm_monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodm_monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


   //for Monthly role 9 (Head Office Division Maker) end   



   //for Overall role 9 (Head Office Division Maker) Start

     $hodm_overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();


      $hodm_overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();


      $hodm_overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

   //for Overall role 9 (Head Office Division Maker) end             





// ...........role 9 (Head Office Division Maker) End...........     





// ...............role 10  (Head Office Division Checker Start) Start.............

// for daily basis total (role 10)

        $hodc_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $hodc_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $hodc_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 10) ends



// for monthly basis total (role 10)

        $hodc_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 10) ends



 // for overall basis total (role 10)

        $hodc_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $hodc_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $hodc_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 10) ends  


// ...............role 10  (Head Office Division Start) end.............       





// ...............role 11  (Super Admin Start) Start.............

// for daily basis total (role 11)

        $superadmin_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $superadmin_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $superadmin_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 11) ends



// for monthly basis total (role 11)

        $superadmin_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 11) ends



 // for overall basis total (role 11)

        $superadmin_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $superadmin_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $superadmin_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 11) ends  


// ...............role 11  (Super Admin Start) end.............      








// ...............role 12  (Admin Start) Start.............

// for daily basis total (role 12)

        $admin_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $admin_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $admin_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 12) ends



// for monthly basis total (role 12)

        $admin_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $admin_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $admin_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 12) ends



 // for overall basis total (role 12)

        $admin_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $admin_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $admin_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 12) ends  


// ...............role 12  (Admin) end.............                    


          return view('dashboard',[
                    'dailyTotal' => $dailyTotal,
                    'dailyTotalPending' => $dailyTotalPending,
                    'dailyTotalCancel' => $dailyTotalCancel,

                    'monthlyTotal'    => $monthlyTotal,
                    'monthlyTotalPending'    => $monthlyTotalPending,
                    'monthlyTotalCancel'    => $monthlyTotalCancel,

                    'overallTotal' => $overallTotal,
                    'overallTotalPending' => $overallTotalPending,
                    'overallTotalCancel' => $overallTotalCancel,

                    'dailyBrCheckerPendingForAuth' =>$dailyBrCheckerPendingForAuth,
                    'dailyBrCheckerAuthorized' =>$dailyBrCheckerAuthorized,
                    'dailyBrCheckerDeclined' =>$dailyBrCheckerDeclined,

                    'monthlyBrCheckerPendingForAuth' => $monthlyBrCheckerPendingForAuth,
                    'monthlyBrCheckerAuthorized' => $monthlyBrCheckerAuthorized,
                    'monthlyBrCheckerDeclined' => $monthlyBrCheckerDeclined,

                    'overallBrCheckerPendingForAuth' => $overallBrCheckerPendingForAuth,
                    'overallBrCheckerAuthorized' => $overallBrCheckerAuthorized,
                    'overallBrCheckerDeclined' => $overallBrCheckerDeclined,

                    'dailyHdMakerPendingForAuth' => $dailyHdMakerPendingForAuth,
                    'dailyHdMakerPendingForApprove' => $dailyHdMakerPendingForApprove,

                    'MonthlyHdMakerPendingForAuth' => $MonthlyHdMakerPendingForAuth,
                    'MonthlyHdMakerPendingForApprove' => $MonthlyHdMakerPendingForApprove,

                    'OverallHdMakerPendingForAuth' => $OverallHdMakerPendingForAuth,
                    'OverallHdMakerPendingForApprove'=> $OverallHdMakerPendingForApprove,

                    'dailyHdCheckerWaitingForAuth' => $dailyHdCheckerWaitingForAuth,
                    'dailyHdCheckerAuthorized' => $dailyHdCheckerAuthorized,
                    'dailyHdCheckerRechecked' => $dailyHdCheckerRechecked,

                    'monthlyHdCheckerWaitingForAuth' => $monthlyHdCheckerWaitingForAuth,
                    'monthlyHdCheckerAuthorized' => $monthlyHdCheckerAuthorized,
                    'monthlyHdCheckerRechecked' => $monthlyHdCheckerRechecked,

                    'overallHdCheckerWaitingForAuth' => $overallHdCheckerWaitingForAuth,
                    'overallHdCheckerAuthorized' => $overallHdCheckerAuthorized,
                    'overallHdCheckerRechecked' => $overallHdCheckerRechecked,

                    
                    'dailyHdAuthWaitingForAuth'=>$dailyHdAuthWaitingForAuth,
                    'dailyHdAuthAuthorized'=>$dailyHdAuthAuthorized,
                    'dailyHdAuthDecline'=>$dailyHdAuthDecline,


                    'monthlyHdAuthWaitingForAuth'=>$monthlyHdAuthWaitingForAuth,
                    'monthlyHdAuthAuthorized'=>$monthlyHdAuthAuthorized,
                    'monthlyHdAuthDecline'=>$monthlyHdAuthDecline,


                    'overallHdAuthWaitingForAuth'=>$overallHdAuthWaitingForAuth,
                    'overallHdAuthAuthorized'=>$overallHdAuthAuthorized,
                    'overallHdAuthDeclined'=>$overallHdAuthDeclined,


                   
                   'hodm_dailyTotal' => $hodm_dailyTotal,
                    'hodm_dailyTotalPending' => $hodm_dailyTotalPending,
                    'hodm_dailyTotalCancel' => $hodm_dailyTotalCancel,

                    'hodm_monthlyTotal'    => $hodm_monthlyTotal,
                    'hodm_monthlyTotalPending'    => $hodm_monthlyTotalPending,
                    'hodm_monthlyTotalCancel'    => $hodm_monthlyTotalCancel,

                    'hodm_overallTotal' => $hodm_overallTotal,
                    'hodm_overallTotalPending' => $hodm_overallTotalPending,
                    'hodm_overallTotalCancel' => $hodm_overallTotalCancel,



                     'hodc_dailyBrCheckerPendingForAuth' =>$hodc_dailyBrCheckerPendingForAuth,
                    'hodc_dailyBrCheckerAuthorized' =>$hodc_dailyBrCheckerAuthorized,
                    'hodc_dailyBrCheckerDeclined' =>$hodc_dailyBrCheckerDeclined,

                    'hodc_monthlyBrCheckerPendingForAuth' => $hodc_monthlyBrCheckerPendingForAuth,
                    'hodc_monthlyBrCheckerAuthorized' => $hodc_monthlyBrCheckerAuthorized,
                    'hodc_monthlyBrCheckerDeclined' => $hodc_monthlyBrCheckerDeclined,

                    'hodc_overallBrCheckerPendingForAuth' => $hodc_overallBrCheckerPendingForAuth,
                    'hodc_overallBrCheckerAuthorized' => $hodc_overallBrCheckerAuthorized,
                    'hodc_overallBrCheckerDeclined' => $hodc_overallBrCheckerDeclined,



                      'superadmin_dailyBrCheckerPendingForAuth' =>$superadmin_dailyBrCheckerPendingForAuth,
                    'superadmin_dailyBrCheckerAuthorized' =>$superadmin_dailyBrCheckerAuthorized,
                    'superadmin_dailyBrCheckerDeclined' =>$superadmin_dailyBrCheckerDeclined,

                    'superadmin_monthlyBrCheckerPendingForAuth' => $superadmin_monthlyBrCheckerPendingForAuth,
                    'superadmin_monthlyBrCheckerAuthorized' => $superadmin_monthlyBrCheckerAuthorized,
                    'superadmin_monthlyBrCheckerDeclined' => $superadmin_monthlyBrCheckerDeclined,

                    'superadmin_overallBrCheckerPendingForAuth' => $superadmin_overallBrCheckerPendingForAuth,
                    'superadmin_overallBrCheckerAuthorized' => $superadmin_overallBrCheckerAuthorized,
                    'superadmin_overallBrCheckerDeclined' => $superadmin_overallBrCheckerDeclined,

                    


                      'admin_dailyBrCheckerPendingForAuth' =>$admin_dailyBrCheckerPendingForAuth,
                    'admin_dailyBrCheckerAuthorized' =>$admin_dailyBrCheckerAuthorized,
                    'admin_dailyBrCheckerDeclined' =>$admin_dailyBrCheckerDeclined,

                    'admin_monthlyBrCheckerPendingForAuth' => $admin_monthlyBrCheckerPendingForAuth,
                    'admin_monthlyBrCheckerAuthorized' => $admin_monthlyBrCheckerAuthorized,
                    'admin_monthlyBrCheckerDeclined' => $admin_monthlyBrCheckerDeclined,

                    'admin_overallBrCheckerPendingForAuth' => $admin_overallBrCheckerPendingForAuth,
                    'admin_overallBrCheckerAuthorized' => $admin_overallBrCheckerAuthorized,
                    'admin_overallBrCheckerDeclined' => $admin_overallBrCheckerDeclined,
                    
                ]);  



    } //end dashboard function








    public function dash()  // for dashborad button 
    {
      $role = Auth::user()->role;
        $userId = Auth::user()->id;


        $today_date = date('Y-m-d');
        $this_month = date('m');
       



// ..........role 1 (branch maker) operation start............

// for daily basis total (role 1)

        $dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 1) ends



// for monthly basis total (role 1)

         $monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 1) ends



// for overall basis total (role 1)

        $overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();




      $overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();



      $overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

// for overall basis total (role 1) ends


// ..........role 1 (branch maker) operation ends............





// ..........role 5 (branch checker) operation start............

// for daily basis total (role 5)

        $dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 5) ends



// for monthly basis total (role 5)

        $monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();





      $monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 5) ends



 // for overall basis total (role 5)

        $overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 5) ends  

// ..........role 5 (branch checker) operation ends............





// ..........role 2 (Head Maker) operation start............

// for daily basis total (role 2)

        $dailyHdMakerPendingForAuth = DB::table('request_id')
                
                 ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                 ->where('action_status_br_checker','!=','2')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();





       $dailyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and br_checker_sts_update_date='$today_date' "))[0];

// echo $dailyHdMakerPendingForApprove->sl;
// die;


// for daily basis total (role 2) ends



// for monthly basis total (role 2)

        $MonthlyHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')
                  ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();





      $MonthlyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and  month(br_checker_sts_update_date)='$this_month' "))[0];



// for monthly basis total (role 2) ends




// for overall basis total (role 2)

        $OverallHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')        
                ->count();





      $OverallHdMakerPendingForApprove =  DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL "))[0];



// for overall basis total (role 2) ends

// ..........role 2 (Head Maker) operation ends............





// ..........role 6 (Head Checker) operation start............


// for daily basis total (role 6)

        $dailyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') and br_checker_sts_update_date='$today_date'"))[0];

// echo $dailyHdCheckerWaitingForAuth->sl;
// die;


      $dailyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereDate('ho_chkr_aprove_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereDate('ho_chkr_recheck_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 6)

        $monthlyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='')  and month(br_checker_sts_update_date)='$this_month'"))[0];





      $monthlyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereMonth('ho_chkr_aprove_sts_update_date', '=', date('m'))
                ->count();



      $monthlyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereMonth('ho_chkr_recheck_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 6) ends




   // for overall basis total (role 6)

        $overallHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') "))[0];






      $overallHdCheckerAuthorized = DB::table('request_id')
                  ->where('action_status_ho_checker','=',5)         
                ->count();



      $overallHdCheckerRechecked = DB::table('request_id')
                 ->where('action_status_ho_checker','=',6)
                ->count();


// for overall basis total (role 6) ends             


// ..........role 6 (Head checker) operation ends............







// .............role 8 (Head Auth) start ................. 




// for daily basis total (role 8)


        $dailyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

and br_checker_sts_update_date='$today_date'"))[0];




      $dailyHdAuthAuthorized = DB::table('request_id')
                
                  ->where('ho_authorize_status','=',1)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 8)

        $monthlyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

   and month(br_checker_sts_update_date)='$this_month'"))[0];


  // echo   $monthlyHdAuthWaitingForAuth->sl_count;die;    





      $monthlyHdAuthAuthorized = DB::table('request_id')
                
                   ->where('ho_authorize_status','=',1)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();



      $monthlyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();


// for monthly basis total (role 8) ends




   // for overall basis total (role 8)

        $overallHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8' "))[0];




      $overallHdAuthAuthorized = DB::table('request_id')
                  ->where('ho_authorize_status','=',1)         
                ->count();



       $overallHdAuthDeclined = DB::table('request_id')
                 ->where('ho_authorize_status','=',0)
                ->count();


// for overall basis total (role 8) ends             


// ..........role 8 (Head checker) operation ends............





// ...........role 9 (Head Office Division Maker) Start...........     

    //for daily role 9 (Head Office Division Maker) Start


        $hodm_dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();

   //for daily role 9 (Head Office Division Maker) end  


   //for Monthly role 9 (Head Office Division Maker) Start

            $hodm_monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $hodm_monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodm_monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


   //for Monthly role 9 (Head Office Division Maker) end   



   //for Overall role 9 (Head Office Division Maker) Start

     $hodm_overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();


      $hodm_overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();


      $hodm_overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

   //for Overall role 9 (Head Office Division Maker) end             





// ...........role 9 (Head Office Division Maker) End...........     





// ...............role 10  (Head Office Division Checker Start) Start.............

// for daily basis total (role 10)

        $hodc_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $hodc_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $hodc_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 10) ends



// for monthly basis total (role 10)

        $hodc_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 10) ends



 // for overall basis total (role 10)

        $hodc_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $hodc_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $hodc_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 10) ends  


// ...............role 10  (Head Office Division Start) end.............       





// ...............role 11  (Super Admin Start) Start.............

// for daily basis total (role 11)

        $superadmin_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $superadmin_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $superadmin_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 11) ends



// for monthly basis total (role 11)

        $superadmin_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 11) ends



 // for overall basis total (role 11)

        $superadmin_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $superadmin_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $superadmin_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 11) ends  


// ...............role 11  (Super Admin Start) end.............    









// ...............role 12  ( Admin Start) Start.............

// for daily basis total (role 12)

        $admin_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $admin_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $admin_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 12) ends



// for monthly basis total (role 12)

        $admin_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $admin_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $admin_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 12) ends



 // for overall basis total (role 12)

        $admin_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $admin_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $admin_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 12) ends  


// ...............role 12  ( Admin Start) end.............                     


          return view('dashboard',[
                    'dailyTotal' => $dailyTotal,
                    'dailyTotalPending' => $dailyTotalPending,
                    'dailyTotalCancel' => $dailyTotalCancel,

                    'monthlyTotal'    => $monthlyTotal,
                    'monthlyTotalPending'    => $monthlyTotalPending,
                    'monthlyTotalCancel'    => $monthlyTotalCancel,

                    'overallTotal' => $overallTotal,
                    'overallTotalPending' => $overallTotalPending,
                    'overallTotalCancel' => $overallTotalCancel,

                    'dailyBrCheckerPendingForAuth' =>$dailyBrCheckerPendingForAuth,
                    'dailyBrCheckerAuthorized' =>$dailyBrCheckerAuthorized,
                    'dailyBrCheckerDeclined' =>$dailyBrCheckerDeclined,

                    'monthlyBrCheckerPendingForAuth' => $monthlyBrCheckerPendingForAuth,
                    'monthlyBrCheckerAuthorized' => $monthlyBrCheckerAuthorized,
                    'monthlyBrCheckerDeclined' => $monthlyBrCheckerDeclined,

                    'overallBrCheckerPendingForAuth' => $overallBrCheckerPendingForAuth,
                    'overallBrCheckerAuthorized' => $overallBrCheckerAuthorized,
                    'overallBrCheckerDeclined' => $overallBrCheckerDeclined,

                    'dailyHdMakerPendingForAuth' => $dailyHdMakerPendingForAuth,
                    'dailyHdMakerPendingForApprove' => $dailyHdMakerPendingForApprove,

                    'MonthlyHdMakerPendingForAuth' => $MonthlyHdMakerPendingForAuth,
                    'MonthlyHdMakerPendingForApprove' => $MonthlyHdMakerPendingForApprove,

                    'OverallHdMakerPendingForAuth' => $OverallHdMakerPendingForAuth,
                    'OverallHdMakerPendingForApprove'=> $OverallHdMakerPendingForApprove,

                    'dailyHdCheckerWaitingForAuth' => $dailyHdCheckerWaitingForAuth,
                    'dailyHdCheckerAuthorized' => $dailyHdCheckerAuthorized,
                    'dailyHdCheckerRechecked' => $dailyHdCheckerRechecked,

                    'monthlyHdCheckerWaitingForAuth' => $monthlyHdCheckerWaitingForAuth,
                    'monthlyHdCheckerAuthorized' => $monthlyHdCheckerAuthorized,
                    'monthlyHdCheckerRechecked' => $monthlyHdCheckerRechecked,

                    'overallHdCheckerWaitingForAuth' => $overallHdCheckerWaitingForAuth,
                    'overallHdCheckerAuthorized' => $overallHdCheckerAuthorized,
                    'overallHdCheckerRechecked' => $overallHdCheckerRechecked,

                    
                    'dailyHdAuthWaitingForAuth'=>$dailyHdAuthWaitingForAuth,
                    'dailyHdAuthAuthorized'=>$dailyHdAuthAuthorized,
                    'dailyHdAuthDecline'=>$dailyHdAuthDecline,


                    'monthlyHdAuthWaitingForAuth'=>$monthlyHdAuthWaitingForAuth,
                    'monthlyHdAuthAuthorized'=>$monthlyHdAuthAuthorized,
                    'monthlyHdAuthDecline'=>$monthlyHdAuthDecline,


                    'overallHdAuthWaitingForAuth'=>$overallHdAuthWaitingForAuth,
                    'overallHdAuthAuthorized'=>$overallHdAuthAuthorized,
                    'overallHdAuthDeclined'=>$overallHdAuthDeclined,


                   
                   'hodm_dailyTotal' => $hodm_dailyTotal,
                    'hodm_dailyTotalPending' => $hodm_dailyTotalPending,
                    'hodm_dailyTotalCancel' => $hodm_dailyTotalCancel,

                    'hodm_monthlyTotal'    => $hodm_monthlyTotal,
                    'hodm_monthlyTotalPending'    => $hodm_monthlyTotalPending,
                    'hodm_monthlyTotalCancel'    => $hodm_monthlyTotalCancel,

                    'hodm_overallTotal' => $hodm_overallTotal,
                    'hodm_overallTotalPending' => $hodm_overallTotalPending,
                    'hodm_overallTotalCancel' => $hodm_overallTotalCancel,



                     'hodc_dailyBrCheckerPendingForAuth' =>$hodc_dailyBrCheckerPendingForAuth,
                    'hodc_dailyBrCheckerAuthorized' =>$hodc_dailyBrCheckerAuthorized,
                    'hodc_dailyBrCheckerDeclined' =>$hodc_dailyBrCheckerDeclined,

                    'hodc_monthlyBrCheckerPendingForAuth' => $hodc_monthlyBrCheckerPendingForAuth,
                    'hodc_monthlyBrCheckerAuthorized' => $hodc_monthlyBrCheckerAuthorized,
                    'hodc_monthlyBrCheckerDeclined' => $hodc_monthlyBrCheckerDeclined,

                    'hodc_overallBrCheckerPendingForAuth' => $hodc_overallBrCheckerPendingForAuth,
                    'hodc_overallBrCheckerAuthorized' => $hodc_overallBrCheckerAuthorized,
                    'hodc_overallBrCheckerDeclined' => $hodc_overallBrCheckerDeclined,



                      'superadmin_dailyBrCheckerPendingForAuth' =>$superadmin_dailyBrCheckerPendingForAuth,
                    'superadmin_dailyBrCheckerAuthorized' =>$superadmin_dailyBrCheckerAuthorized,
                    'superadmin_dailyBrCheckerDeclined' =>$superadmin_dailyBrCheckerDeclined,

                    'superadmin_monthlyBrCheckerPendingForAuth' => $superadmin_monthlyBrCheckerPendingForAuth,
                    'superadmin_monthlyBrCheckerAuthorized' => $superadmin_monthlyBrCheckerAuthorized,
                    'superadmin_monthlyBrCheckerDeclined' => $superadmin_monthlyBrCheckerDeclined,

                    'superadmin_overallBrCheckerPendingForAuth' => $superadmin_overallBrCheckerPendingForAuth,
                    'superadmin_overallBrCheckerAuthorized' => $superadmin_overallBrCheckerAuthorized,
                    'superadmin_overallBrCheckerDeclined' => $superadmin_overallBrCheckerDeclined,

                    




                      'admin_dailyBrCheckerPendingForAuth' =>$admin_dailyBrCheckerPendingForAuth,
                    'admin_dailyBrCheckerAuthorized' =>$admin_dailyBrCheckerAuthorized,
                    'admin_dailyBrCheckerDeclined' =>$admin_dailyBrCheckerDeclined,

                    'admin_monthlyBrCheckerPendingForAuth' => $admin_monthlyBrCheckerPendingForAuth,
                    'admin_monthlyBrCheckerAuthorized' => $admin_monthlyBrCheckerAuthorized,
                    'admin_monthlyBrCheckerDeclined' => $admin_monthlyBrCheckerDeclined,

                    'admin_overallBrCheckerPendingForAuth' => $admin_overallBrCheckerPendingForAuth,
                    'admin_overallBrCheckerAuthorized' => $admin_overallBrCheckerAuthorized,
                    'admin_overallBrCheckerDeclined' => $admin_overallBrCheckerDeclined,
                    
                ]);  

 

    } //end dash function






//for 404 handle

    public function checkUser(){

        $userId = Auth::user()->id;
        $role = Auth::user()->role;

        $today_date = date('Y-m-d');
        $this_month = date('m');

        if ($userId) {
           // ..........role 1 (branch maker) operation start............

// ..........role 1 (branch maker) operation start............

// for daily basis total (role 1)

        $dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();



      $dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 1) ends



// for monthly basis total (role 1)

         $monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 1) ends



// for overall basis total (role 1)

        $overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();




      $overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();



      $overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

// for overall basis total (role 1) ends


// ..........role 1 (branch maker) operation ends............





// ..........role 5 (branch checker) operation start............

// for daily basis total (role 5)

        $dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 5) ends



// for monthly basis total (role 5)

        $monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();





      $monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 5) ends



 // for overall basis total (role 5)

        $overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 5) ends  

// ..........role 5 (branch checker) operation ends............





// ..........role 2 (Head Maker) operation start............

// for daily basis total (role 2)

        $dailyHdMakerPendingForAuth = DB::table('request_id')
                
                 ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                 ->where('action_status_br_checker','!=','2')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();





       $dailyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and br_checker_sts_update_date='$today_date' "))[0];

// echo $dailyHdMakerPendingForApprove->sl;
// die;


// for daily basis total (role 2) ends



// for monthly basis total (role 2)

        $MonthlyHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')
                  ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();





      $MonthlyHdMakerPendingForApprove = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL and  month(br_checker_sts_update_date)='$this_month' "))[0];



// for monthly basis total (role 2) ends




// for overall basis total (role 2)

        $OverallHdMakerPendingForAuth = DB::table('request_id')
                  ->where('action_status_ho_maker','=',NULL)
                 ->where('action_status_br_checker','!=',NULL)
                  ->where('action_status_br_checker','!=','2')        
                ->count();





      $OverallHdMakerPendingForApprove =  DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]

  where ([action_status_ho_maker]='4' or [action_status_ho_maker]='3') and [action_status_ho_checker] is NULL "))[0];



// for overall basis total (role 2) ends

// ..........role 2 (Head Maker) operation ends............





// ..........role 6 (Head Checker) operation start............


// for daily basis total (role 6)

        $dailyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') and br_checker_sts_update_date='$today_date'"))[0];

// echo $dailyHdCheckerWaitingForAuth->sl;
// die;


      $dailyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereDate('ho_chkr_aprove_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereDate('ho_chkr_recheck_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 6)

        $monthlyHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='')  and month(br_checker_sts_update_date)='$this_month'"))[0];





      $monthlyHdCheckerAuthorized = DB::table('request_id')
                
                  ->where('action_status_ho_checker','=',5)
                 ->whereMonth('ho_chkr_aprove_sts_update_date', '=', date('m'))
                ->count();



      $monthlyHdCheckerRechecked = DB::table('request_id')
                 
                 ->where('action_status_ho_checker','=',6)
                 ->whereMonth('ho_chkr_recheck_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 6) ends




   // for overall basis total (role 6)

        $overallHdCheckerWaitingForAuth = DB::select(DB::raw("SELECT count(sl) as sl
  FROM [request_id]
  where (action_status_ho_maker='3' or action_status_ho_maker='4') and (action_status_ho_checker is NULL or action_status_ho_checker='') "))[0];






      $overallHdCheckerAuthorized = DB::table('request_id')
                  ->where('action_status_ho_checker','=',5)         
                ->count();



      $overallHdCheckerRechecked = DB::table('request_id')
                 ->where('action_status_ho_checker','=',6)
                ->count();


// for overall basis total (role 6) ends             


// ..........role 6 (Head checker) operation ends............







// .............role 8 (Head Auth) start ................. 




// for daily basis total (role 8)


        $dailyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

and br_checker_sts_update_date='$today_date'"))[0];




      $dailyHdAuthAuthorized = DB::table('request_id')
                
                  ->where('ho_authorize_status','=',1)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();



      $dailyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereDate('ho_authorize_sts_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 6) ends




// for monthly basis total (role 8)

        $monthlyHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8'

   and month(br_checker_sts_update_date)='$this_month'"))[0];


  // echo   $monthlyHdAuthWaitingForAuth->sl_count;die;    





      $monthlyHdAuthAuthorized = DB::table('request_id')
                
                   ->where('ho_authorize_status','=',1)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();



      $monthlyHdAuthDecline = DB::table('request_id')
                 
                 ->where('ho_authorize_status','=',0)
                 ->whereMonth('ho_authorize_sts_date', '=', date('m'))
                ->count();


// for monthly basis total (role 8) ends




   // for overall basis total (role 8)

        $overallHdAuthWaitingForAuth = DB::select(DB::raw("SELECT  count([sl]) as sl_count
      
  FROM [request_id]

 where [action_status_ho_maker]='8' "))[0];




      $overallHdAuthAuthorized = DB::table('request_id')
                  ->where('ho_authorize_status','=',1)         
                ->count();



       $overallHdAuthDeclined = DB::table('request_id')
                 ->where('ho_authorize_status','=',0)
                ->count();


// for overall basis total (role 8) ends             


// ..........role 8 (Head checker) operation ends............





// ...........role 9 (Head Office Division Maker) Start...........     

    //for daily role 9 (Head Office Division Maker) Start


        $hodm_dailyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();


      $hodm_dailyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereDate('update_date', '=', date('Y-m-d'))
                ->count();

   //for daily role 9 (Head Office Division Maker) end  


   //for Monthly role 9 (Head Office Division Maker) Start

            $hodm_monthlyTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->whereMonth('entry_date', '=', date('m'))
                ->count();




      $hodm_monthlyTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodm_monthlyTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();


   //for Monthly role 9 (Head Office Division Maker) end   



   //for Overall role 9 (Head Office Division Maker) Start

     $hodm_overallTotal = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                ->count();


      $hodm_overallTotalPending = DB::table('request_id')
                 ->where('action_status_br_checker','=',NULL)
                ->count();


      $hodm_overallTotalCancel = DB::table('request_id')
                 ->where('br_maker','=',$userId)
                 ->where('action_status','=',7)
                ->count();

   //for Overall role 9 (Head Office Division Maker) end             





// ...........role 9 (Head Office Division Maker) End...........     





// ...............role 10  (Head Office Division Checker Start) Start.............

// for daily basis total (role 10)

        $hodc_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $hodc_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $hodc_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 10) ends



// for monthly basis total (role 10)

        $hodc_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $hodc_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 10) ends



 // for overall basis total (role 10)

        $hodc_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $hodc_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $hodc_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 10) ends  


// ...............role 10  (Head Office Division Start) end.............       





// ...............role 11  (Super Admin Start) Start.............

// for daily basis total (role 11)

        $superadmin_dailyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereDate('entry_date', '=', date('Y-m-d'))
                ->count();





      $superadmin_dailyBrCheckerAuthorized = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();



      $superadmin_dailyBrCheckerDeclined = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                  ->whereDate('br_checker_sts_update_date', '=', date('Y-m-d'))
                ->count();


// for daily basis total (role 10) ends



// for monthly basis total (role 10)

        $superadmin_monthlyBrCheckerPendingForAuth = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)
                 ->whereMonth('update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerAuthorized = DB::table('request_id')
                ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();



      $superadmin_monthlyBrCheckerDeclined = DB::table('request_id')
                 ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))
                ->count();


// for monthly basis total (role 10) ends



 // for overall basis total (role 10)

        $superadmin_overallBrCheckerPendingForAuth = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=',NULL)                
                ->count();





      $superadmin_overallBrCheckerAuthorized = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                  ->where('action_status_br_checker','=','1')              
                ->count();



      $superadmin_overallBrCheckerDeclined = DB::table('request_id')
                  ->where('br_authorizer','=',$userId)
                 ->where('action_status_br_checker','=','2')
                 ->whereMonth('br_checker_sts_update_date', '=', date('m'))      
                ->count();


// for overall basis total (role 10) ends  


// ...............role 10  (Head Office Division Start) end.............                       


          return view('dashboard',[
                    'dailyTotal' => $dailyTotal,
                    'dailyTotalPending' => $dailyTotalPending,
                    'dailyTotalCancel' => $dailyTotalCancel,

                    'monthlyTotal'    => $monthlyTotal,
                    'monthlyTotalPending'    => $monthlyTotalPending,
                    'monthlyTotalCancel'    => $monthlyTotalCancel,

                    'overallTotal' => $overallTotal,
                    'overallTotalPending' => $overallTotalPending,
                    'overallTotalCancel' => $overallTotalCancel,

                    'dailyBrCheckerPendingForAuth' =>$dailyBrCheckerPendingForAuth,
                    'dailyBrCheckerAuthorized' =>$dailyBrCheckerAuthorized,
                    'dailyBrCheckerDeclined' =>$dailyBrCheckerDeclined,

                    'monthlyBrCheckerPendingForAuth' => $monthlyBrCheckerPendingForAuth,
                    'monthlyBrCheckerAuthorized' => $monthlyBrCheckerAuthorized,
                    'monthlyBrCheckerDeclined' => $monthlyBrCheckerDeclined,

                    'overallBrCheckerPendingForAuth' => $overallBrCheckerPendingForAuth,
                    'overallBrCheckerAuthorized' => $overallBrCheckerAuthorized,
                    'overallBrCheckerDeclined' => $overallBrCheckerDeclined,

                    'dailyHdMakerPendingForAuth' => $dailyHdMakerPendingForAuth,
                    'dailyHdMakerPendingForApprove' => $dailyHdMakerPendingForApprove,

                    'MonthlyHdMakerPendingForAuth' => $MonthlyHdMakerPendingForAuth,
                    'MonthlyHdMakerPendingForApprove' => $MonthlyHdMakerPendingForApprove,

                    'OverallHdMakerPendingForAuth' => $OverallHdMakerPendingForAuth,
                    'OverallHdMakerPendingForApprove'=> $OverallHdMakerPendingForApprove,

                    'dailyHdCheckerWaitingForAuth' => $dailyHdCheckerWaitingForAuth,
                    'dailyHdCheckerAuthorized' => $dailyHdCheckerAuthorized,
                    'dailyHdCheckerRechecked' => $dailyHdCheckerRechecked,

                    'monthlyHdCheckerWaitingForAuth' => $monthlyHdCheckerWaitingForAuth,
                    'monthlyHdCheckerAuthorized' => $monthlyHdCheckerAuthorized,
                    'monthlyHdCheckerRechecked' => $monthlyHdCheckerRechecked,

                    'overallHdCheckerWaitingForAuth' => $overallHdCheckerWaitingForAuth,
                    'overallHdCheckerAuthorized' => $overallHdCheckerAuthorized,
                    'overallHdCheckerRechecked' => $overallHdCheckerRechecked,

                    
                    'dailyHdAuthWaitingForAuth'=>$dailyHdAuthWaitingForAuth,
                    'dailyHdAuthAuthorized'=>$dailyHdAuthAuthorized,
                    'dailyHdAuthDecline'=>$dailyHdAuthDecline,


                    'monthlyHdAuthWaitingForAuth'=>$monthlyHdAuthWaitingForAuth,
                    'monthlyHdAuthAuthorized'=>$monthlyHdAuthAuthorized,
                    'monthlyHdAuthDecline'=>$monthlyHdAuthDecline,


                    'overallHdAuthWaitingForAuth'=>$overallHdAuthWaitingForAuth,
                    'overallHdAuthAuthorized'=>$overallHdAuthAuthorized,
                    'overallHdAuthDeclined'=>$overallHdAuthDeclined,


                   
                   'hodm_dailyTotal' => $hodm_dailyTotal,
                    'hodm_dailyTotalPending' => $hodm_dailyTotalPending,
                    'hodm_dailyTotalCancel' => $hodm_dailyTotalCancel,

                    'hodm_monthlyTotal'    => $hodm_monthlyTotal,
                    'hodm_monthlyTotalPending'    => $hodm_monthlyTotalPending,
                    'hodm_monthlyTotalCancel'    => $hodm_monthlyTotalCancel,

                    'hodm_overallTotal' => $hodm_overallTotal,
                    'hodm_overallTotalPending' => $hodm_overallTotalPending,
                    'hodm_overallTotalCancel' => $hodm_overallTotalCancel,



                     'hodc_dailyBrCheckerPendingForAuth' =>$hodc_dailyBrCheckerPendingForAuth,
                    'hodc_dailyBrCheckerAuthorized' =>$hodc_dailyBrCheckerAuthorized,
                    'hodc_dailyBrCheckerDeclined' =>$hodc_dailyBrCheckerDeclined,

                    'hodc_monthlyBrCheckerPendingForAuth' => $hodc_monthlyBrCheckerPendingForAuth,
                    'hodc_monthlyBrCheckerAuthorized' => $hodc_monthlyBrCheckerAuthorized,
                    'hodc_monthlyBrCheckerDeclined' => $hodc_monthlyBrCheckerDeclined,

                    'hodc_overallBrCheckerPendingForAuth' => $hodc_overallBrCheckerPendingForAuth,
                    'hodc_overallBrCheckerAuthorized' => $hodc_overallBrCheckerAuthorized,
                    'hodc_overallBrCheckerDeclined' => $hodc_overallBrCheckerDeclined,



                      'superadmin_dailyBrCheckerPendingForAuth' =>$superadmin_dailyBrCheckerPendingForAuth,
                    'superadmin_dailyBrCheckerAuthorized' =>$superadmin_dailyBrCheckerAuthorized,
                    'superadmin_dailyBrCheckerDeclined' =>$superadmin_dailyBrCheckerDeclined,

                    'superadmin_monthlyBrCheckerPendingForAuth' => $superadmin_monthlyBrCheckerPendingForAuth,
                    'superadmin_monthlyBrCheckerAuthorized' => $superadmin_monthlyBrCheckerAuthorized,
                    'superadmin_monthlyBrCheckerDeclined' => $superadmin_monthlyBrCheckerDeclined,

                    'superadmin_overallBrCheckerPendingForAuth' => $superadmin_overallBrCheckerPendingForAuth,
                    'superadmin_overallBrCheckerAuthorized' => $superadmin_overallBrCheckerAuthorized,
                    'superadmin_overallBrCheckerDeclined' => $superadmin_overallBrCheckerDeclined,

                    
                    
                ]);  

        }

        else
            {
                Auth::logout();
                return redirect('/');
            }


    }











    public function invalidRoute()
    {
        

        $rr = Route::has('/users');

        dd($rr);




        $url = URL::current();

       $k = filter_var($url, FILTER_VALIDATE_URL);

       if ($k === false) 
       {
          Auth::logout();
        return redirect('/');
       }

       else
       {
        return redirect('/users');
       }


        
    }



    public function resetPassword()
        {
            return view('password_reset');
        }
    public function saveResetPassword(Request $request)
        {
            $request->validate([
                    'current_password' => ['required', new MatchOldPassword],
                    'new_password' => ['required'],
                    'confirm_password' => ['same:new_password'],
                ]);
             User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                 Auth::logout();
                 Session::flush();
                return redirect('/');
        }



}
