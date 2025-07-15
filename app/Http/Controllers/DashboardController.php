<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with a list of employees fetched from the remote API.
     */
    public function index(Request $request)
    {
        $employees = [];

        $token = $request->session()->get('remote_token');

        if ($token) {
            try {
                $response = Http::withToken($token)
                    ->get('https://corpve.mierp.com.mx/api/employees');

                if ($response->successful()) {
                    $employees = $response->json();
                }
            } catch (\Exception $e) {
                // silently fail and keep employees empty
            }
        }

        return view('dashboard', [
            'employees' => $employees,
        ]);
    }
}
