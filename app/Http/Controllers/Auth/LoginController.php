<?php

namespace Main\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Main\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use ReallySimpleJWT\Token;

class LoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest', [ 'except' => 'logout' ]);
    }

    public function getLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($this->userExists($request->get('username')) && $this->passwordMatches($request)) {
            $user = $this->getUserFor($request->get('username'));

            $token = Token::create(
                $user['username'],
                config('app.secret'),
                Carbon::now()->addHours(8)->timestamp,
                url('/')
            );

            session()->put('Authorization', "Bearer {$token}");

            Storage::put("authentication/{$token}", json_encode($user));

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with([
            'errors' => true
        ]);
    }

    private function userExists(?string $username): bool
    {
        if (is_null($username)) {
            return false;
        }

        return Storage::exists("accounts/{$username}.json");
    }

    private function passwordMatches(Request $request): bool
    {
        $user = $this->getUserFor($request->get('username'));

        return password_verify($request->get('password'), $user['password']);
    }

    private function getUserFor(string $username): array
    {
        $user_json = Storage::get("accounts/{$username}.json");

        return json_decode($user_json, true);
    }
}
