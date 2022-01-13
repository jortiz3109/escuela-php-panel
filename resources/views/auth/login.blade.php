@extends('layouts.auth')
@section('auth-content')
    <div class="card">
        <div class="card-content">
            @if (session('status'))
                <div class="notification is-primary is-light">
                    {{ session('status') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <b-field label="{{ trans('Email') }}"
                         type="{{ $errors->has('email') ? 'is-danger' : null }}"
                         message="{{ $errors->first('email') }}">
                    <b-input type="email"
                             name="email"
                             id="email"
                             value="{{ old('email') }}"
                             maxlength="30"
                             icon="account-lock"
                             required>
                    </b-input>
                </b-field>

                <b-field label="{{ trans('Password') }}"
                         type="{{ $errors->has('password') ? 'is-danger' : null }}"
                         message="{{ $errors->first('password') }}">
                    <b-input type="password"
                             name="password"
                             id="password"
                             value="{{ old('password') }}"
                             maxlength="30"
                             icon="lock"
                             required>
                    </b-input>
                </b-field>

                <label class="checkbox mb-5">
                    <input type="checkbox" name="remember" id="remember">
                    {{ trans('Remember me') }}
                </label>

                <button type="submit" class="button is-primary is-fullwidth">
                    {{ trans('Login') }}
                </button>
            </form>
            @if (Route::has('password.request'))
                <div class="control">
                    <a class="button is-text is-fullwidth" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
