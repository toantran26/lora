<?php


	namespace App\Services\BackendServices;

    use Illuminate\Auth\Events\Lockout;
    use Illuminate\Cache\RateLimiter;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Str;
    use Illuminate\Validation\ValidationException;
	class AuthServices
	{


        public function attemptLogin(Request $request)
        {
            return Auth::guard()->attempt(
                $request->only('username','password'), $request->boolean('remember')
            );
        }
	}
