<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;

class RecapchaController extends Controller
{
    protected function checkRecaptcha($token, $ip)
    {
        $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => config('recaptcha.secret'),
                'response' => $token,
                'remoteip' => $ip,
            ],
        ]);
        $response = json_decode((string)$response->getBody(), true);
        return $response['success'];
    }

    public function register(Request $request)
    {

        if (config('recaptcha.enabled') && !$this->checkRecaptcha($request->recaptcha_token, $request->ip())) {
            return response()->json([
                'error' => 'Captcha is invalid.',
            ], Response::HTTP_BAD_REQUEST);
        }

        // Капча ОК. Регистрируем пользователя...
    }
}