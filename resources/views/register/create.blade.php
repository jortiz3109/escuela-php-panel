@extends('layouts.admin')
@section('content')

    <caption>{{ $texts['title'] }}</caption>
    <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <b-field label="{{ __('Name') }}" type="{{ $errors->has('name') ? 'is-danger' : null }}" message="{{ $errors->first('name') }}">
                    <b-input type="text" name="email" id="name" value="{{ old('name') }}" maxlength="30"  required></b-input>
                </b-field>

                <b-field label="{{ __('Email') }}" type="{{ $errors->has('email') ? 'is-danger' : null }}" message="{{ $errors->first('email') }}">
                    <b-input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="30" icon="account-lock"  required></b-input>
                </b-field>

                <b-field label="{{ __('Password') }}"  type="{{ $errors->has('password') ? 'is-danger' : null }}" message="{{ $errors->first('password') }}">
                    <b-input type="password" name="password" id="password" value="{{ old('password') }}" maxlength="30" icon="lock" required></b-input>
                </b-field>

                <b-field label="{{ __('Password Confirmation') }}"  type="{{ $errors->has('password_confirmation') ? 'is-danger' : null }}" message="{{ $errors->first('password_confirmation') }}">
                    <b-input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" maxlength="30" icon="lock" required></b-input>
                </b-field>

                <button type="submit" class="button is-primary is-fullwidth"> <b-icon pack="fas" icon="save"></b-icon>&nbsp;
                    @lang('Register')
                </button>
            </form>


@endsection