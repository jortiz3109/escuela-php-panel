@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable">
        <caption>{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.description')</th>
            <th scope="col">@lang('users.fields.created_at')</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.description')</th>
            <th scope="col">@lang('users.fields.created_at')</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->toDateString() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->render('partials.pagination.paginator') }}
@endsection
