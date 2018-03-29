<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\OAuthClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{


    public function login(Request $request) {

        //check


        $this->validateLogin($request);

        if($this->attemptLogin($request)) {

            $user = Auth::user();

            $token = $this->requestToken($user,$request);

            return json_encode($token);
        }
        else {
            return $this->sendFailedLoginResponse($request);
        }

    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only('email', 'password');
    }

    protected function attemptLogin(Request $request) {

        return Auth::attempt($this->credentials($request));
    }

    protected function requestToken($user,$request) {

        if($user->tokens()->count() > 0) {
            $user->tokens()->delete();
        }

        $http = new Client();

        $response = $http->post('http://localhost:8082/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'HWCrIZst4zCLwAy4kbXoMjyg34DybsMXHGOb1ucD',
                'username' => $user->email,
                'password' => $request->input('password'),
                'scope' => '*',
            ],
        ]);

        return json_decode((string) $response->getBody(), true);

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
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}
