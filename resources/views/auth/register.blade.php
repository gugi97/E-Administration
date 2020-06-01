@extends('layouts.app')

@section('content')
<main class="hold-transition register-page" style="height: 91vh !important;">
    <div class="register-box">
    
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>
        
            <div class="card-body register-card-body" style="border-radius: 0 0 .25rem .25rem !important;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{-- Name --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" placeholder="Full name" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    {{-- End Name --}}

                    {{-- NIP --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                value="{{ old('nip') }}" placeholder="NIP" required autocomplete="nip" maxlength="9">
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
                    {{-- End NIP --}}

                    {{-- EMail --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
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
                    {{-- End Email --}}

                    {{-- Password --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" placeholder="Password" required autocomplete="new-password">
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
                    {{-- End Password --}}

                    {{-- Password Confirm --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                                placeholder="Retype password" autocomplete="new-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Password Confirm --}}

                    {{-- Status --}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <select id="status" type="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                <option value="">--------</option>
                                <option value="Admin">Admin</option>
                                <option value="Karyawan">Karyawan</option>
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-user-cog"></span>
                                </div>
                            </div>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    {{-- End NIP --}}
                    
                    {{-- Button Register --}}
                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </div>
                    {{-- End Button Register --}}
                </form>
            </div>
        </div>

    </div>
</main>
@endsection
