@extends('layouts.app')

@section('content')
<main class="hold-transition login-page" style="height: 91vh !important;">
    <div class="login-box">
                <div class="card">
                    <div class="card-header" style="background-color: #095593; text-align: center; color: white; font-weight: bold; font-size: larger;">
                        {{ __('Reset Password') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <label for="email" class="">{{ __('E-Mail Address :') }}</label>
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-0">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</main>
@endsection
