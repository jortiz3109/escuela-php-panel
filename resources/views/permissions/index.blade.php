<table>
    <theaders>
        <tr>
            <th>@lang('permissions.fields.name')</th>
            <th>@lang('permissions.fields.description')</th>
        </tr>
    </theaders>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
