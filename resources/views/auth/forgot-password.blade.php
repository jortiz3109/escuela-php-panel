@extends('layouts.auth')
@section('content')
    <main class="container" id="app">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="card mt-6">
                    <div class="card-content">
                        <form role="form" method="POST"
                              action="{{ route('password.email') }}">
                            @csrf

                            <div class="field">
                                {{ trans('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                                <div class="notification is-danger is-light">
                                    {{ session('status', '') }}
                                </div>
                            @endif

                            <div class="field">
                                <label for="email" class="label">{{ trans('E-Mail Address') }}</label>

                                <div class="control">
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                           class="input{{ $errors->has('email') ? ' is-danger' : '' }}">

                                    @if ($errors->has('email'))
                                        <div class="help is-danger">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-primary">
                                        {{ trans('Email Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
