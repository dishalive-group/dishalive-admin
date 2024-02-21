<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use Auth;
use Session;
use Hash;

class UserController extends Controller
{
    public function register(Request $request){
        Session::put('source', $request->source);
        $countries = Countries::orderBy('name', 'asc')->get();
        $data = compact('countries');
        return view('dashboard.register')->with($data);
    }

    public function registerNow(Request $request){
        $request->validate([
            'country' => 'required',
            'mobileNoPrefix' => 'required',
            'mobileNo' => 'required',
            'name' => 'required',
            'email' => 'email|required',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('mobileNo', $request->mobileNo)->orWhere('email', $request->email)->count();
        if($user >0){
            return redirect('login')->with('error', 'You have already registred! Please login.');
        }else{
            $db = new User;            
            $db->country = $request->country;
            $db->mobileNoPrefix = $request->mobileNoPrefix;
            $db->name = $request->name;
            $db->mobileNo = $request->mobileNo;
            $db->email = $request->email;
            $db->source = Session::get('source');
            $db->password = password_hash($request->password, PASSWORD_DEFAULT);

            if($db->save()){
                return redirect('login')->with('message', 'Register successfully!');
            }else{
                return back()->with('error', 'Oops! Someting went wrong.');
            }
        }
    }    

    public function login(){
        if(Auth::check()){
            return redirect('dashboard')->with('message', 'Already Loggedin.');
        }else{            
            return view('dashboard.login');
        }
    }

    public function loginNow(Request $request){
        $request->validate([
            'mobileNo' => 'required',
            'password' => 'required',            
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $credentails = $request->only("mobileNo", "password");
        if(Auth::attempt($credentails)){
            return redirect('dashboard')->with('message', 'Loggedin successfully!');
        }else{
            return back()->with('error', 'Wrong credentails. Try again.');
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect("/");
    }

    public function loginAs($id){
        $user = User::find($id);
        Auth::login($user);
        return redirect('/dashboard')->with('message', 'Loggedin as user!');
    }

    public function users(){
        $users = User::orderBy('id', 'desc')->get();
        $data = compact('users');
        return view('dashboard.users')->with($data);
    }

    public function usersWithoutWebsite(){
        $users = User::orderBy('id', 'desc')->get();
        $data = compact('users');
        return view('dashboard.users')->with($data);
    }

    public function register22(){
        return view('register');
    }

    public function registerNow22(Request $request){
        $request->validate(
            [
                'name' => 'required',
                'mobileNo' => 'required',
                'password' => 'required|confirmed',
                'password_confirmation' => 'required'
            ]
        );
        $user = User::where('mobileNo', '=', $request->mobileNo)->get();
        
        if(count($user)>0){
            return redirect('/login')->with("message", "This number is already registered. Please login in.");
        }else{
            $db = new User;
            // $transliterator = Transliterator::create('Any-Latin; Latin-ASCII');
            // $englishString = $transliterator->transliterate($request->name);
            // $db->name = $englishString;
            $db->name = $request->name;
            $db->username = $this->generateUniqueUsername($request->name);
            $db->mobileNo = $request->mobileNo;

            $db->password = password_hash($request->password, PASSWORD_DEFAULT);

            //dd($db);
            try {
                $db->save();
                return redirect('/login')->with("message", "Registration successfully!");
            }catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if ($errorCode == 1062) {
                    // Duplicate entry for 'mobileNo' column
                    return redirect()->back()->withInput()->withErrors(['mobileNo' => 'This contact number is already registered.']);
                } else {
                    // Other database errors
                    return redirect()->back()->withInput()->withErrors(['unexpected' => 'An unexpected error occurred. Please try again.']);
                }
            }
        }
    }

    private function generateUniqueUsername($name){
        $username = Str::slug($name);
        $count = User::where('username', 'like', "{$username}%")->count();
        return $count ? "{$username}-{$count}" : $username;
    }

    public function changePassword(){
        if(Auth::check()){
            return view('dashboard.change-password');
        }else{
            return redirect('/login')->with('error', 'Please login first');
        }        
    }

    public function changePasswordNow(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => bcrypt($request->password)]);
            return redirect()->back()->with('message', 'Password updated successfully.');
        } else {
            return redirect()->back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
        }
    }

    public function verifyAccount(){       

        if(Session::get('otp')){            
            return view('verify-account');
        }else{
            
            $otp = rand('1111', '9999');
            Session::put('otp', $otp);

            $msg = 'Dear \n '. $otp .' is the OTP for account verification. Please do not share it with anyone else. \n www.dashboard.in \n\n - DishaLive Group';
            $templateid = '1207162037467322695';
            $wappSMS = urlencode($msg);
            $mobile = Auth::user()->mobileNo;
            $instance_id = view()->shared('instance_id');
            $access_token = view()->shared('access_token');

            sms($wappSMS, $templateid, $mobile);
            
            // if(strlen($mobile)==10){
            //     $mobileNo = "91". $mobile;
            // }else{
            //     $mobileNo = $mobile;
            // }
            //whatsapp($wappSMS, $mobile, $instance_id, $access_token);
            return view('verify-account');
        }
        
    }

    public function verifyAccountNow(Request $request){
        if(Session::get('otp') == $request->otp){
            $db = User::find(Auth::user()->id);
            $db->status = "Active";
            $db->save();
            Session::forget('otp');
            return redirect('my-account')->with('message', 'Account verified successfully!');
        }else{
            return redirect('verify-account')->with('message', 'Entered OTP is incorrect. Try agin.');
        }
    }

    public function resendOTP(){
        Session::forget('otp');
        return redirect('/reset-password');
    }

    public function resetPassword(){
        return view('dashboard.reset-password');
    }

    public function resetPasswordNow(Request $request){
        $user = User::where('mobileNo', $request->mobileNo)->first();
        if(is_null($user)){
            return redirect('register')->with('message', 'You have not created an account. Please create a new account first or cross-check your entered mobile number.');
        }else{
            $request->validate(
                [
                    'mobileNo' => 'required',
                    'password' => 'required|confirmed',
                    'password_confirmation' => 'required',
                    'g-recaptcha-response' => 'recaptcha',
                ]
            );
            $otp = rand('1111', '9999');
            Session::put('otp', $otp);
    
            $msg = 'Dear \n '. $otp .' is the OTP for reset the password. Please do not share it with anyone else. \n www.mydl.in \n\n - DishaLive Group';
            $templateid = '1207162037467322695';
            $wappSMS = urlencode($msg);
            $mobileNo = $request->mobileNo;
            Session::put('mobileNo', $mobileNo);
            Session::put('password', $request->password);
    
            sms($wappSMS, $templateid, $mobileNo);
            return view('dashboard.enter-otp');
        }
    }

    public function verifyOTP(Request $request){
        if(Session::get('otp') == $request->otp){
            $db = User::where('mobileNo', '=', Session::get('mobileNo'))->first();
            $db->password = password_hash(Session::get('password'), PASSWORD_DEFAULT);

            if($db->save()){
                return redirect('login')->with('message', 'Password reset successfully! Login Now!');
            }else{
                echo 'Error';
            }
            
        }else{
            return view('dashboard.enter-otp')->with('error', 'Enter correct OTP');
        }
    }

    public function updateUser(Request $request, $id){
        $db = User::find($id);
        $db->name = $request->name;
        $db->email = $request->email;
        $db->mobileNo = $request->mobileNo;
        $db->status = $request->status;
        $db->userType = $request->userType;
        $db->rate = $request->rate;
        $db->save();
        return back()->with('message', 'User updated successfully!');
    }
    

    public function myUsers(){
        $users = User::where('source', Auth::user()->id)->orderBy('id', 'desc')->get();
        $data = compact('users');
        return view('dashboard.my-users')->with($data);
    }

    public function updateMyUser(Request $request, $id){
        $db = User::find($id);
        $db->name = $request->name;
        $db->email = $request->email;
        $db->mobileNo = $request->mobileNo;
        $db->status = $request->status;
        $db->userType = $request->userType;
        $db->rate = $request->rate;
        $db->save();
        return back()->with('message', 'User updated successfully!');
    }
}
