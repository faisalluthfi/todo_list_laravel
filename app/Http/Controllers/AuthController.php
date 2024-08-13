<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $title = "Login";
        return view('login', [
            'title' => $title
        ]);
    }


    public function doLogin(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Percobaan login
        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman yang diinginkan setelah login berhasil
            return redirect()->intended('todo');
        }

        // Redirect kembali ke login dengan pesan error jika login gagal
        return redirect('login')->with('status', 'Error, wrong password or email!');
    }

    public function register()
    {
        $title = 'Register';
        return view('register', [
            'title' => $title
        ]);
    }


    public function doRegister(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // $request['password'] = Hash::make($request->password);

        $user = User::create($request->all());
        return redirect('login')->with('status', 'Register success, now you can login!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}