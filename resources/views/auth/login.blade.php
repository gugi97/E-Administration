@extends('layouts.app')

@section('content')
<main class="hold-transition login-page" style="height: 91vh !important;">
    <div class="login-box">
                {{-- Card --}}
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
                    <div class="card-body login-card-body" style="border-radius: 0 0 .25rem .25rem !important;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            {{-- NIP --}}
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" placeholder="NIP" autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-id-badge"></span>
                                        </div>
                                    </div>
                                    @error('nip')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- END NIP --}}

                            {{-- PASSWORD --}}
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- END PASSWORD --}}


                            {{-- <div class="form-group row">
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            {{-- BUTTON LOGIN --}}
                            <div class="form-group mb-0">
                                <div class="text-center mb-2">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="padding: 0px !important;">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                            </div>
                            {{-- END BUTTON LOGIN --}}
                        </form>  
                    </div>
                </div>
                {{-- End Card --}}
    </div>
</main>
@endsection