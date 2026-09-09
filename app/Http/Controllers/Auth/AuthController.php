<?php

namespace App\Http\Controllers\Auth;


use Auth;
use Str;
use Hash;
use File;
use url;
use Session;
use Cookie;
use Socialite;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\User;
use App\Models\SocialIdentity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    
    public function __construct()
    {
    	$this->middleware('authCheck');
    }

    public function admin(Request $r){
        
        if ($r->isMethod('post'))
        {
            
            //Login Post Action

            $check = $r->validate([
            'email' => 'required|max:100',
            'password' => 'required|max:50'
            ]);

            if(!$check){
                Session::flash('error','Need To validation');
                return back();
            }

            $login = $r->email;

            $remember_me  = ( !empty( $r->remember ) )? TRUE : FALSE;
            
            if(is_numeric($login)){
                $field = 'mobile';
            } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            } else {
                $field = 'name';
            }

            $user =User::where('admin',true)->where('customer',true)->where($field,$login)->first();

            if($user){
                if(Hash::check($r->password, $user->password)){
                    Auth::login($user, $remember_me);

                    $redirect =Session::get('url.intended');
                    //Session::forget('url.intended');
                    if($redirect){
                        return Redirect::to($redirect);
                    }

                    return Redirect()->route('admin.dashboard');
                    
                }else{
                    Session::flash('error','Your Acounts Password Are Incorrect');
                    return back();
                }
            }else{
                Session::flash('error','Your No Accounts Have With Us');
                return back();
            }

            //Login Post Action End

        }
        
        return view('auth.adminLogin'); 
    }
    
    public function login(Request $r){

        //session(['url.intended' => url()->current()]); 

        // if(route('login')!=url()->previous()){
        //     session(['url.intended' => url()->previous()]); 
        // }

       // return Session::get('url.intended');

        //return $redirect;

        if ($r->isMethod('post'))
        {
            
            //Login Post Action

            $check = $r->validate([
            'email' => 'required|max:100',
            'password' => 'required|max:50'
            ]);

            if(!$check){
                Session::flash('error','Need To validation');
                return back();
            }

            $login = $r->email;

            $remember_me  = ( !empty( $r->remember ) )? TRUE : FALSE;
            
            if(is_numeric($login)){
                $field = 'mobile';
            } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $field = 'email';
            } else {
                $field = 'name';
            }

            $user =User::where('admin',false)->where('customer',true)->where($field,$login)->first();

            if($user){
                if(Hash::check($r->password, $user->password)){
                    Auth::login($user, $remember_me);

                    $redirect =Session::get('url.intended');
                    //Session::forget('url.intended');
                    if($redirect){
                        return Redirect::to($redirect);
                    }

                    return Redirect()->route('customer.dashboard');
                    
                }else{
                    Session::flash('error','Your Acounts Password Are Incorrect');
                    return back();
                }
            }else{
                Session::flash('error','Your No Accounts Have With Us');
                return back();
            }

            //Login Post Action End

        }
        // if(auth::check()){
        //     Redirect()->route('admin.dashboard');
        // }
        return view('auth.login'); 
    	
    }


    public function register(Request $r){

        if ($r->isMethod('post'))
        {
        
        $check = $r->validate([
            'name' => 'required|max:100',
            'email' => 'required|max:100|unique:users,email',
            'password' => 'required|min:5'
        ]);

        if(!$check){
            return back();
        }
        
        //User Create
        $user =new User();
        $user->name=$r->name;
        $user->email=$r->email;
        $user->password=Hash::make($r->password);
        $user->password_show=$r->password;
        $user->country=1;
        $user->save();

        Auth::login($user);
        
        //Mail Send/SMS Send
        
        //**********Send Mail***************//

        if(general()->mail_status && $user->email){
            //Mail Data
            $datas =array('user'=>$user);
            $template ='mails.registrationMail';
            $toEmail =$user->email;
            $toName =$user->name;
            $subject ='Registration Successfully Completed in '.general()->title;
        
            sendMail($toEmail,$toName,$subject,$datas,$template);
        }
        //**********Send Mail***************//
        

        if(Auth::check()){
            return Redirect()->route('customer.dashboard');
        }else{
            Session::flash('success','Your Registration Successfully Done!');
            return Redirect()->route('login');
        }

    }else{
        return view('auth.register');
    } 


    }


    public function forgotPassword(Request $r){
        
        if ($r->isMethod('post'))
        {

            $check = $r->validate([
                'email' => 'required|email|max:100',
            ]);
            
            $user =User::where('email',$r->email)->first();
            if($user){
                $token =strtolower(Str::random(90));
                $user->verify_code=str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                $user->remember_token=$token;
                $user->auth_activity_at=Carbon::now();
                $user->save();
    
                //Send Mail 
                if(general()->mail_status && $user->email){
                    $toEmail =$user->email;
                    $toName =$user->name;
                    $subject ='Forget Password Mail Form '.general()->title;
                    $datas =array('user'=>$user);
                    $template ='mails.passwordResetVerify';
                    sendMail($toEmail,$toName,$subject,$datas,$template);
                }
                Session::flash('success','We send Reset Link with 6 digit Code Your Email address!');
                return Redirect()->route('resetPassword',$token);
            }
            Session::flash('error','There is no account associated with the email address you provided');
            return Redirect()->back()->withInput();
        }
        
        return view('auth.forget-password');
        
    }

    public function resetPassword(Request $r,$token){
        $user =User::where('remember_token',$token)->first();
        if(!$user){
            Session::flash('error','Your Reset Password Are Expired.');
            return Redirect()->route('forgotPassword');
        }
        if($r->isMethod('post')){
            $check = $r->validate([
                'verify_code' => 'required|numeric|digits:6',
                'password' => 'required|min:5|max:50'
            ]);
            if($user->verify_code ==$r->verify_code){
                
                $user->remember_token=null;
                $user->verify_code=null;
                $user->password=Hash::make($r->password);
                $user->password_show=$r->password;
                $user->save();

                Auth::login($user);
                if(Auth::check()){
                    return Redirect()->route('customer.dashboard');
                }
                Session::flash('success','Your Reset Password Successfully Done!');
                return Redirect()->route('login');
            }

            Session::flash('error','Your Verify Code Are Incorrect!!');
            return Redirect()->back()->withInput();
        }

        return view('auth.confirm-password',compact('user'));

    }

    public function resetPasswordCheck(Request $r){

         $check = $r->validate([
            'token' => 'required',
            'verifycode' => 'required|numeric|digits:6',
            'password' => 'required|min:6',
        ]);


        if(!$check){
            Session::flash('error','Need To validation');
            return back();
        }

        $user =$user =User::where('remember_token',$r->token)->first();

        
        if($user){
           
            if($user->verify_code ==$r->verifycode){
                
                $user->remember_token=null;
                $user->verify_code=null;
                $user->password=Hash::make($r->password);
                $user->password_show=$r->password;
                $user->save();

                Auth::loginUsingId($user->id);
                if(Auth::check()){
                    return Redirect()->route('customer.dashboard');
                }else{
                    Session::flash('success','Your Reset Password Successfully Done!');
                    return Redirect()->route('login');
                }

            }else{
                Session::flash('error','Your Verify Code Are Incorrect!!');
                return Redirect()->back();
            }

        }else{
        Session::flash('error','Your reset link are exprired');
        return Redirect()->route('forgotPassword');
        }
    }

    public function logout(){
    	Auth::logout();
        session()->flush();
    	return Redirect()->route('index');
    }




      
       //Social login/Registration Function
       
      public function redirectToProvider($provider)
       {
           
           return Socialite::driver($provider)->redirect();
       }
       
       
       
       public function handleProviderCallback($provider, Request $request)
       {
           
           
           try {
    
               $user = Socialite::driver($provider)->stateless()->user();
    
           } catch (Exception $e) {
               return redirect('/login');
           }
    
           $authUser = $this->findOrCreateUser($user, $provider);
           
           $request->session()->regenerate();
           Auth::login($authUser, true);
           return Redirect()->route('customer.dashboard');

       }
       
       
        public function findOrCreateUser($providerUser, $provider)
       {
           
           $account = SocialIdentity::whereProviderName($provider)
                      ->whereProviderId($providerUser->getId())
                      ->first();
    
           if ($account) {
               return $account->user;
           } else {
               $user = User::whereEmail($providerUser->getEmail())->where('email', '<>', null)->first();
    
               if (! $user) {
                   
                   $rand =rand(100000,999999);
                   
                   $user = User::create([
                       'email' => $providerUser->getEmail(),
                       'name'  => $providerUser->getName(),
                       'email_verified_at' => Carbon::now(),
                       'password'=> Hash::make($rand),
                       'password_show'=> $rand,
                   ]);
  
                    $user->profile_photo_path = $providerUser->getAvatar();
                    $user->save();
          
               }
               
               $user->identities()->create([
                   'provider_id'   => $providerUser->getId(),
                   'provider_name' => $provider,
                   'provider_token'=> $providerUser->token,
                   'provider_img_url'=> $providerUser->getAvatar(),
               ]);
    
               return $user;
           }
       }





}
