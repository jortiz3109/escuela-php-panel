@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">{{ trans('logins.fields.created_at') }}</th>
            <th scope="col">{{ trans('logins.fields.ip_address') }}</th>
            <th scope="col">{{ trans('logins.fields.user_agent') }}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">{{ trans('logins.fields.ip_address') }}</th>
            <th scope="col">{{ trans('logins.fields.user_agent') }}</th>
            <th scope="col">{{ trans('logins.fields.created_at') }}</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($logins as $login)
            <tr>
                <td>{{ $login->created_at }}</td>
                <td>{{ $login->ip_address }}</td>
                <td>{{ $login->device->user_agent }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
