<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    
    //フォームに入力してsignupボタンを押すと実行される
    // public function register(Request $request)
    // {
    //$request->all()はカラム全ての意味
    //     $this->validator($request->all())->validate();
    //     event(new Registered($user = $this->create($request->all())));
    //     $this->guard()->login($user);
    //     return $this->registered($request, $user)
    //                     ?: redirect($this->redirectPath());
    // }
    //タイトルからsign up nowボタンを押すと実行される
    // public function showRegistrationForm()
    // {
    //     return view('auth.register');
    // }
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //  ユーザ登録が完了すると、ログイン状態になった上で、指定のリダイレクト先へ飛
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//guestであることが条件
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)//ユーザ登録の際のフォームデータのバリデーション
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)//ユーザ新規作成のためのメソッド
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
