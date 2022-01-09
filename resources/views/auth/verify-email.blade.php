@extends('layouts.app')

@section('content')
    <div class="card mt-6">
        <div class="card-content">

            <div class="message">
                <div class="message-body">
                    {{ trans('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
            </div>

            @if (session('status') === 'verification-link-sent')
                <div class="notification is-success is-light">
                    {{ trans('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div class="my-3">
                        <button type="submit" class="button is-primary is-fullwidth">
                            {{ trans('Resend Verification Email') }}
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="button is-text">
                        {{ trans('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
