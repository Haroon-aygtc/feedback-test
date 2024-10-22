<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService
{
  /**
   * Attempt to log in the user.
   *
   * @param string $loginType
   * @param array $credentials
   * @return bool
   */
  public function attemptLogin(string $loginType, array $credentials): bool
  {
    return Auth::attempt([$loginType => $credentials['email_username'], 'password' => $credentials['password']]);
  }
}
