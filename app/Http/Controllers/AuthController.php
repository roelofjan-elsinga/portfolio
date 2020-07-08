<?php

namespace Main\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Main\Classes\LinkedIn\LinkedIn;

class AuthController
{
    private LinkedIn $linkedIn;

    public function __construct(LinkedIn $linkedIn)
    {
        $this->linkedIn = $linkedIn;
    }

    public function logInRedirect(): RedirectResponse
    {
        return redirect($this->linkedIn->authentication()->redirectUrl());
    }

    public function oAuthCallback()
    {
        if (!request()->has('code')) {
            return redirect()->route('home', ['success' => false]);
        }

        $access_token = $this->linkedIn
            ->accessToken()
            ->retrieve(request()->get('code'));

        Storage::put('linkedin.json', json_encode($access_token));

        return redirect()->route('home', ['success' => true]);
    }
}