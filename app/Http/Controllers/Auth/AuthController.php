<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registration()
    {
        return view('auth.register');
    }

    public function displayLogin()
    {
        return view('auth.login');
    }
    

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
      
    
    public function postRegistration(Request $request)
    {  
        /*
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        */ 
        $data = $request->all();
        $insert_array = [
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "dob" => $request->dob,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "address" => $request->address,
            "state" => $request->state,
            "city" => $request->city,
            "user_name" => $request->user_name,
            "password" =>  Hash::make($request->password),
            "role_id" => 1,
            "pincode" => $request->zip
        ];
       
         $result = User::insert($insert_array);
         print_r($result);
        //die('asdasdsadasdasdsad');
        //return redirect("jobs")->withSuccess('Great! You have Successfully loggedin');
    } 
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("jobs")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'CID' => Config::get('app.Admin_CID'),
        'first_name' => $data['first_name'],
        'last_name' => $data['last_name'],  
        'username' => $data['email'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function forgotPassword()
    {
        return view('auth.forgotpassword');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postForgotPassword(ForgotPasswordRequest $request)
    {  

        $token = Str::random(64);  
        $user = User::where('email', $request->email)
                    ->update(['reset_password_code' => $token]);  
        Mail::send('email.forgot-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect("forgot-password")->withSuccess('We have e-mailed your password reset link!');
    }


    /**
       * Write code on Method
       *
       * @return response()
       */
      public function resetPassword($token) { 
        return view('auth.forgotpassword-link', ['token' => $token]);
     }
    
    /**
       * Write code on Method
       *
       * @return response()
       */
      public function postResetPassword(ResetPasswordRequest $request)
      {
          
        $updatePassword = User::Where([
            'email' => $request->email, 
            'reset_password_code' => $request->token
            ])->first();
  
        if(!$updatePassword){
            return redirect("forgot-password")->withSuccess('Invalid token! Please resend password reset link again.');
        }
       
        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password), 'reset_password_code' => '']);

        return redirect("login")->withSuccess('Your password has been successfully changed!');
      }

    

}
