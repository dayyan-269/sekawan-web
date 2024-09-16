<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\LoginRequest;
use App\Models\Account\Admin;
use App\Models\Account\Supervisor;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $admin = Admin::where('email', $credential['email'])->first();

        if ($admin) {
            $check = Hash::check($credential['password'], $admin->password);
            if ($check) {
                return redirect()->route('admin.home')->withCookies([
                    cookie('role', 'admin', 60),
                    cookie('uid', $admin->id, 60)
                ]);
            } else {
                return redirect()->back()->withInput()->with('credential wrong, try again');
            }
        } else {
            $supervisor = Supervisor::where('email', $credential['email'])->first();
            if ($supervisor) {
                $check = Hash::check($credential['password'], $supervisor->password);
                if ($check) {
                    return redirect()->route('supervisor.home')->withCookies([
                        cookie('role', 'supervisor', 60),
                        cookie('uid', $supervisor->id, 60)
                    ]);
                } else {
                    return redirect()->back()->withInput()->with('credential wrong, try again');
                }
            }
        }
    }

    public function logout()
    {
        Cookie::queue(Cookie::forget('role'));
        Cookie::queue(Cookie::forget('uid'));
        return redirect()->route('auth.login_view');
    }
}
