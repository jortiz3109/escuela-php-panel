@extends('layouts.admin')
@section('content')
<table class="table is-narrow is-hoverable">
    <thead>
        <tr>
            <th scope="col">@lang('logins.fields.created_at')</th>
            <th scope="col">@lang('logins.fields.ip_address')</th>
            <th scope="col">@lang('logins.fields.user_agent')</th>
        </tr>
    </thead>
    <tfoot>
    <tr>
        <th scope="col">@lang('logins.fields.created_at')</th>
        <th scope="col">@lang('logins.fields.ip_address')</th>
        <th scope="col">@lang('logins.fields.user_agent')</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($logins as $login)
        <tr>
            <td>{{ $login->created_at }}</td>
            <td>{{ $login->ip_address }}</td>
            <td>{{ $login->user_agent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
