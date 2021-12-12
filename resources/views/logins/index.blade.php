@extends('layouts.admin')
@section('content')
<table class="table is-narrow is-hoverable">
    <caption class="is-hidden">{{ $texts['title'] }}</caption>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th scope="col" nowrap>{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tfoot>
    <tr>
        @foreach($headers as $header)
            <th scope="col" nowrap>{{ $header }}</th>
        @endforeach
    </tr>
    </tfoot>
    <tbody>
    @foreach($logins as $login)
        <tr>
            <td>{{ $login->created_at }}</td>
            <td>{{ $login->ip_address }}</td>
            <td>{{ $login->device->user_agent }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
