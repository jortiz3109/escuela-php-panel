@extends('layouts.admin')
@section('content')
<table class="table is-narrow is-hoverable is-fullwidth">
    <caption class="is-hidden">{{ $texts['title'] }}</caption>
    <thead>
        <tr>
            <th scope="col">@lang('permissions.fields.name')</th>
            <th scope="col">@lang('permissions.fields.description')</th>
            <th scope="col" style="min-width: 8em">@lang('permissions.fields.created_at')</th>
        </tr>
    </thead>
    <tfoot>
    <tr>
        <th scope="col">@lang('permissions.fields.name')</th>
        <th scope="col">@lang('permissions.fields.description')</th>
        <th scope="col">@lang('permissions.fields.created_at')</th>
    </tr>
    </tfoot>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ $permission->created_at->toDateString() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $permissions->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
