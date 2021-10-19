<table>
    <caption>{{ $texts['title'] }}</caption>
    <theaders>
        <tr>
            <th scope="col">@lang('permissions.fields.name')</th>
            <th scope="col">@lang('permissions.fields.description')</th>
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
