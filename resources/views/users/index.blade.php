@extends('layouts.admin')
@section('content')


    @includeWhen(count($filters), 'filters', compact('filters'))
    <div class="box block">
        @yield('content')
    </div>
    <table class="table is-narrow is-hoverable">
        <caption>{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.email')</th>
            <th scope="col">@lang('users.fields.created_at')</th>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">@lang('users.fields.name')</th>
            <th scope="col">@lang('users.fields.email')</th>
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
    {{ $users->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
