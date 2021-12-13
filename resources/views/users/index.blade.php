@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable is-fullwidth">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.email')</th>
            <th scope="col">@lang('users.fields.created_at')</th>
            <th scope="col">@lang('users.fields.status')</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.email')</th>
            <th scope="col">@lang('users.fields.created_at')</th>
            <th scope="col">@lang('users.fields.status')</th>
        </tr>
        </tfoot>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->date_formatted }}</td>
{{--                <td>{{ $user->status }}</td>--}}
                <td><status-button user-id="1" user-status="{{ $user->status }}" email-verified="true" /></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
