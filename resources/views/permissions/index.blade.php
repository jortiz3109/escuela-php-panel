<table>
    <tbody>
    @foreach($permissions as $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->description }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
