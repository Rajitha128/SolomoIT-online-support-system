<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;
use View;

class SessionController extends Controller
{
    public function create()
    {
        return View::make('pages.admin.sessions.create');
    }

	public function store(Request $request)
	{
        try{
            $credentials = $request->only([
                'email',
                'password',
            ]);

            $validation = Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validation->passes() && Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended('/admin/ticket')->with('flash_message', 'You are now logged in!');
            }

        }catch(\Exception $e){
            \Log::error('SessionController(store) Error - ' . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
        }

		return redirect()->back()->with('error', 'Invalid credentials OR your account is disabled.');
	}
}
