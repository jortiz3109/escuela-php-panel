@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable is-fullwidth">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">@lang('merchants.fields.name')</th>
            <th scope="col">@lang('merchants.fields.document')</th>
            <th scope="col">@lang('merchants.fields.url')</th>
            <th scope="col">@lang('merchants.fields.country')</th>
            <th scope="col">@lang('merchants.fields.currency')</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">@lang('merchants.fields.name')</th>
            <th scope="col">@lang('merchants.fields.document')</th>
            <th scope="col">@lang('merchants.fields.url')</th>
            <th scope="col">@lang('merchants.fields.country')</th>
            <th scope="col">@lang('merchants.fields.currency')</th>
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
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $merchants->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
