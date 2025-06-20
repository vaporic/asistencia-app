<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RemoteLoginController extends Controller
{
    /**
     * Show the remote login form.
     */
    public function showLoginForm()
    {
        return view('remote-login');
    }

    /**
     * Handle the remote login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $response = Http::post('https://corpve.mierp.com.mx/api/login', $credentials);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', __('Unable to reach authentication server.'));
        }

        if ($response->successful() && $response->json('token')) {
            $request->session()->put('remote_token', $response->json('token'));
            $request->session()->put('remote_user', $response->json('user'));

            return redirect()->intended('dashboard');
        }

        return back()->withInput()->with('error', __('Invalid credentials.'));
    }
}

