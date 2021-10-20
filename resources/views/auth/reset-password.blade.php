@extends('layouts.auth')
@section('content')
    <div class="card mt-6">
        <div class="card-header">
            <h3 class="card-header-title">@lang('Reset Password')</h3>
        </div>

        <div class="card-content">
            <form role="form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <div class="field">
                    <label for="email" class="label">@lang('E-Mail Address')</label>

                    <div class="control">
                        <input id="email" type="email" name="email" value="{{ old('email', request()->email) }}"
                               class="input{{ $errors->has('email') ? ' is-danger' : '' }}">

                        @if ($errors->has('email'))
                            <div class="help is-danger">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password" class="label">@lang('Password')</label>

                    <div class="control">
                        <input id="password" type="password" name="password"
                               class="input{{ $errors->has('password') ? ' is-danger' : '' }}">

                        @if ($errors->has('password'))
                            <div class="help is-danger">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <label for="password-confirm" class="label">@lang('Confirm Password')</label>

                    <div class="control">
                        <input id="password-confirm" type="password" name="password_confirmation"
                               class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}">

                        @if ($errors->has('password_confirmation'))
                            <div class="help is-danger">
                                {{ $errors->first('password_confirmation') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary">
                            @lang('Reset Password')
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
