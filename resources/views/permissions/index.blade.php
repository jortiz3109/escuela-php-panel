@extends('layouts.admin')

@section('content')
<table class="table is-narrow is-hoverable">
    <caption>{{ $texts['title'] }}</caption>
    <thead>
        <tr>
            <th scope="col">@lang('permissions.fields.name')</th>
            <th scope="col">@lang('permissions.fields.description')</th>
            <th scope="col">@lang('permissions.fields.created_at')</th>
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
{{ $permissions->render('partials.pagination.paginator') }}
@endsection
