<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller//Controllerを継承してLoginControllerを宣言している
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/tasks';//ログインしたら自動でtask一覧画面になる

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');

    }
        /*guest=ログインしてないユーザー。
        *ゲスト専用に設計されたルートにアクセスするユーザーのログインを停止
        *イコール、すでにログインしているユーザーがログインルートにアクセスすることを許可しない設定
        *
        *RegisterController.phpにある
        *public function __construct()
        *{
        *   $this->middleware('guest');｝
        *とセットだと考えて、
        *認証済み（ログイン済み）の状態でログインページにアクセスすると、ログイン後のトップページにリダイレクトする」
        仕組身を作っている。
        *
        *
        */
}
