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
                <td>{{ \App\Helpers\DateHelper::toDateString($user->created_at) }}</td>
                <td>
                    <p-status-button url="{{ route('users.status.toggle', [$user->id]) }}" is-enabled="{{ $user->isEnabled() }}" button-Enabled="{{ $user->isVerified() }}"></p-status-button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
