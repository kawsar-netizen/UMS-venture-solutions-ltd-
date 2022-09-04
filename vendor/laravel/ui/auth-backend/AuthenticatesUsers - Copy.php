<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Exception;
use Illuminate\Support\Facades\Hash;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    private function adLogin($user_id, $password){  
        
        $adServer   = "192.168.180.184";
        $adPort     = "389";
        $usr        = "$user_id";
        $plain_password   = "$password";  // data get from form


        
        $user_count = User::where('user_id', $user_id)->count();
        $user_get = User::where('user_id', $user_id)->first();
        $password = $user_get->password;

        if($user_count > 0 ){

            $user_info = User::select('login_level', 'role')->where('user_id', $user_id)->first();

            if($user_info->login_level == '1' ){
                 return true;
                
                // if(($user_info->role == '11' || $user_info->role == '12')){

                //      if (Hash::check("$plain_password", $password)) {
                //         //echo "successfully";die;
                //         return true;
                //     }

                // }else{
                    
                    
                //}
               
               
            }
            $ldap_con   = ldap_connect($adServer,$adPort);
            $username   = trim($usr);
            $domain     = '@dhakabank.com.bd';
            $attributes = array("displayname", "mail", "samaccountname"); 
            // Talking to AD with Valid user
            ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap_con, LDAP_OPT_REFERRALS, 0);
            $dn        = "DC=dhakabank,DC=com,DC=bd";
            
            
            try{
                $ldap_bind = ldap_bind($ldap_con, $username.$domain, $password);
                $filter  = "(&(samaccountname=$username))";
                $search  = ldap_search($ldap_con,$dn,$filter);
                $entries = ldap_get_entries($ldap_con, $search);

                if($entries['count'] > 0){
                    return true;
                }else{
                    $data = [
                        "status" => 400,
                        "message" => "user-id or password does not match active directory"
                    ];
                    return $data;
                }
                
            }catch(Exception $e){
                $data = [
                    "status" => 400,
                    "message" => "user-id or password does not match active directory"
                ];
                return $data;
            }
            @ldap_close($ldap_con);
        }else{
            $data = [
                "status" => 400,
                "message" => "user id does not exits in UMS"
            ];
            return $data;
        }

        
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {   

        $ldap_response = $this->adLogin($request->input('user_id'), $request->input('ldap_password'));
        if( $ldap_response !== true){
            $data = [
                "ldap_error" => true,
                "ldap_message" =>  $ldap_response['message']
            ];
            return view('auth.login', $data);
        }


        
        
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');
        return array_merge($request->only($this->username(), 'password'), ['status_id' => 1]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        //
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        /*throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
        */
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = \App\User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && $user->status_id != 1) {
            $errors = [$this->username() => 'Your Account Is Pending For Authorization'];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'user_id';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');

        /*
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }


        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/login');
        */
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    
}
