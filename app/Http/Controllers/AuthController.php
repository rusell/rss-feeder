<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{
	//
	public function index(Request $request)
	{
		return redirect('/login');
	}

	public function showLoginForm(Request $request)
	{
		if (Auth::user()) {
			return redirect('/feeds');
		}

		return view('auth.login');
	}

	public function login(Request $request)
	{
		Validator::make($request->all(), [
			'email'    => 'required|email',
			'password' => 'required|min:4',
		])->validate();

		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials)) {
			$user = User::where('email', '=', $request->input('email'))->first();
			Auth::login($user);
			return redirect('/feeds');
		} else {
			//failed to authenticate
			$validator = Validator::make([], []); // Empty sets
			$validator->errors()->add('password', 'Password does not match!');

			return redirect('/login')->withErrors($validator->errors())->withInput();
		}
	}

	public function showRegistrationForm(Request $request)
	{
		if (Auth::user()) {
			return redirect('/feeds');
		}

		return view('auth.register');
	}

	public function register(Request $request)
	{
		Validator::make($request->all(), [
			'name' => 'required|string',
			'email'    => 'required|email|unique:App\User,email',
			'password' => 'required|min:4',
		])->validate();

		$credentials = $request->only('email', 'password', 'name');
		User::create($credentials);

		return view('auth.register', ['registered' => 'User has been successfully registered!']);
	}

	public function logout() {
		Auth::logout();
		return redirect()->route('home');
	}

	public function lookupEmailAddress(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'email'    => 'required|email|unique:App\User,email',
		]);
		if ($validator->fails()) {
			return response()->json([
				'validation' => 'fail',
				'errors' => $validator->errors()->messages()['email'],
			]);
		}

		return response()->json([
			'validation' => 'success'
		]);
	}
}
