<?php

    namespace App\Http\Controllers\backend;

    use App\Services\BackendServices\AuthServices;
    use Illuminate\Http\Request;
    use Illuminate\Validation\ValidationException;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class AuthController extends Controller
    {
        protected $__auth;

        public function __construct(AuthServices $auth)
        {
            $this->__auth = $auth;
        }

        /**
         * @throws ValidationException
         */


        public function login(Request $request)
        {
            $request->validate(['username' => 'required|max:255|min:4', 'password' => 'required|max:255|min:6']);
            if ($this->__auth->attemptLogin($request)) {
                if ($request->hasSession()) {
                    $request->session()->put('auth.password_confirmed_at', time());
                }

                $request->session()->regenerate();

                return redirect()->intended('/');
            }

            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }
        public function logout(Request $request){
            Auth::logout();
            return redirect()->intended('/login');
        }
    }
