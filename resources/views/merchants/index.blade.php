@extends('layouts.admin')
@section('content')
<table class="table is-narrow is-hoverable is-fullwidth">
    <caption class="is-hidden">{{ $texts['title'] }}</caption>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tfoot>
    <tr>
        @foreach($headers as $header)
            <th scope="col">{{ $header }}</th>
        @endforeach
    </tr>
    </tfoot>
    <tbody>
    @foreach($merchants as $merchant)
        <tr>
            <td>
                {{ $merchant->name }}<br>
                <small class="has-text-grey is-capitalized">{{ $merchant->brand }}</small>
            </td>
            <td>{{ $merchant->document }}</td>
            <td>{{ $merchant->url }}</td>
            <td>{{ $merchant->country }}</td>
            <td>{{ $merchant->currency }}</td>
            <td class="has-text-centered">
                <a href="{{ route('merchants.edit', ['merchant' => $merchant]) }}">
                    <b-icon size="is-small" type="is-info" icon="pencil"/>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $merchants->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
