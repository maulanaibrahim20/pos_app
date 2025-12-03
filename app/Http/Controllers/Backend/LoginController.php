<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Validator};
use App\Http\Controllers\Controller;
use App\Models\User;

class LoginController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {
        return view('pages.login.index');
    }

    public function login(Request $request)
    {
        DB::beginTransaction();

        $request->validate([
            'login'    => 'required|min:3|max:50',
            'password' => 'required|string|min:4',
        ]);

        if ($request->_token != csrf_token()) {
            return redirect(route('login'))->withErrors("Please try again");
        }

        try {
            $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            $user = $this->user->where($loginField, $request->login)->first();

            if (!$user) {
                DB::rollBack();
                return redirect(route('login'))->withErrors("Email atau Password tidak benar!");
            }

            if (!$user->hasAnyRole(['Super admin', 'Admin'])) {
                DB::rollBack();
                return back()->withErrors("Akun anda tidak memiliki izin untuk login.");
            }

            if (Auth::attempt([$loginField => $request->login, 'password' => $request->password])) {
                $request->session()->regenerate();

                DB::commit();
                return redirect()->intended(route('dashboard'));
            } else {
                DB::rollBack();
                return back()->withErrors("Email atau Password tidak benar!");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->withErrors("Terjadi kesalahan, silakan coba lagi. (" . $th->getMessage() . ")");
        }
    }
}
