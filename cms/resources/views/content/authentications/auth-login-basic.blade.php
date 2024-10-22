@extends('layouts/blankLayout')

@section('title', 'Login')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="{{url('/')}}" class="app-brand-link gap-2">

         <span class="app-brand-logo demo"><img  class="mb-10" src="{{ asset('assets/img/favicon/logo-removebg-preview.png') }}"></span>
          </a>
        </div>
        <!-- /Logo -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="card-body mt-2">
          <div class="login-container">
            <form id="loginForm" class="mb-3" action="{{ route('login') }}" method="POST">
              @csrf
              <div class="form-floating form-floating-outline mb-3">
                <input type="text" class="form-control" id="email_username" name="email_username" placeholder="Enter your email or username" value="{{ old('email_username') }}" autofocus>
                <label for="email_username">Email or Username</label>
                @error('email_username')
                <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input type="password" id="password" class="form-control" name="password" placeholder="*********" aria-describedby="password" />
                      <label for="password">Password</label>
                      @error('password')
                      <div class="text-danger">{{ $message }}</div>
                      @enderror
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>
          </div>        </div>
      </div>

    </div>
  </div>
</div>
@endsection
