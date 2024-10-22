<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class LoginBasic extends Controller
{
  protected $authService;

  // Constructor to apply throttle middleware to limit login attempts
  public function __construct(AuthService $authService)
  {
    $this->authService = $authService;
    $this->middleware('guest')->except('logout');
  }

  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email_username' => 'required|string',
      'password' => 'required|string|min:8',
    ]);

    $loginType = filter_var($credentials['email_username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    if ($this->authService->attemptLogin($loginType, $credentials)) {
      $request->session()->regenerate();
      return redirect()->intended(route('admin.dashboard'))->with('success', 'Login successful!');
    }

    throw ValidationException::withMessages([
      'email_username' => 'The provided credentials do not match our records.',
    ]);
  }

  // Logout function to handle user logout securely
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'You have been logged out successfully!');
  }

}
