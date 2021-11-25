@extends('layouts.admin')
@section('content')

    <caption>{{ $texts['title'] }}</caption>
    <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <b-field label=@lang('users.fields.name') type="{{ $errors->has('name') ? 'is-danger' : null }}" message="{{ $errors->first('name') }}">
                    <b-input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="30"  required></b-input>
                </b-field>

                <b-field label=@lang('users.fields.email') type="{{ $errors->has('email') ? 'is-danger' : null }}" message="{{ $errors->first('email') }}">
                    <b-input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="30" icon="account-lock"  required></b-input>
                </b-field>

                <b-field label=@lang('users.fields.password') type="{{ $errors->has('password') ? 'is-danger' : null }}" message="{{ $errors->first('password') }}">
                    <b-input type="password" name="password" id="password" value="{{ old('password') }}" maxlength="30" icon="lock" required></b-input>
                </b-field>

                <b-field label=@lang('users.fields.password_confirmation')  type="{{ $errors->has('password_confirmation') ? 'is-danger' : null }}" message="{{ $errors->first('password_confirmation') }}">
                    <b-input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" maxlength="30" icon="lock" required></b-input>
                </b-field>

                <button type="submit" class="button is-primary is-fullwidth"> <b-icon pack="fas" icon="save"></b-icon>&nbsp;
                    @lang('users.buttons.create')
                </button>
            </form>

@endsection