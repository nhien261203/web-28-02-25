<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function check_login(){
        request()->validate([

            'email'=> 'required|email|exists:users',
            'password' => 'required',
        ]);


        $data = request()->all('email','password');
        // dd($data);

        if(auth()->attempt($data)){
            // return redirect()->route('home');
            $user = Auth::user();
            if (is_null($user->email_verified_at)) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'Email của bạn chưa được xác thực. Vui lòng kiểm tra email để xác thực tài khoản.');
            }
            return redirect()->route('order.index');
        }

        return redirect()->back();

    }
    public function showChangePassword()
    {
        return view('admin.change-password');

    }

    public function ChangePassword(Request $req)
    {
        $auth = Auth::user();

        // if (!$auth) {
        //     return redirect()->route('account.login')->with('no', 'User not authenticated');
        // }

        $req->validate([
            'old_password' => ['required', function ($attr, $value, $fail) use ($auth) {
                if (!Hash::check($value, $auth->password)) {
                    $fail('Your password does not match');
                }
            }],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password'
        ]);

        $data['password'] = bcrypt($req->password);
        $check = $auth->update($data);

        if ($check) {
            // auth('cus')->logout();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password changed successfully');
        }

        return redirect()->back()->with('no', 'Failed to change password');
    }

    public function register(){
        return view('admin.register');
    }

    public function check_register()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',

        ]);

        $data = request()->all('email', 'name');
        $data['password'] = bcrypt(request('password'));
        // User::create($data);
        // return redirect()->route('home.login')->with('success', 'dang ky thanh cong');

        if ($acc = User::create($data)) {
            Mail::to($acc->email)->send(new VerifyEmail($acc));
            // dd('ok');

            return redirect()->route('login')->with('ok', 'dang ki thanh cong, kiem tra email ');
        }

        return redirect()->back()->with('no', 'loi!!!, hay thu lai');
    }
    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)->whereNull('email_verified_at')->firstOrFail();
        $user->update(['email_verified_at' => now()]);

        return redirect()->route('login')->with('success', 'Xác thực email thành công. Bạn có thể đăng nhập.');
    }
    public function logout(Request $request){
        Auth::logout();

        return redirect()->route('login');
    }

    public function contact(){

        $contacts = Contact::all();
        return view('admin.contact', compact('contacts'));
    }

}
