@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable is-fullwidth">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            <th scope="col">{{ trans('currencies.fields.name') }}</th>
            <th scope="col">{{ trans('currencies.fields.alphabetic_code') }}</th>
            <th scope="col" style="min-width: 8em">{{ trans('currencies.fields.symbol') }}</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th scope="col">{{ trans('currencies.fields.name') }}</th>
            <th scope="col">{{ trans('currencies.fields.alphabetic_code') }}</th>
            <th scope="col">{{ trans('currencies.fields.symbol') }}</th>
        </tr>
        </tfoot>
        <tbody>
        @foreach($currencies as $currency)
            <tr>
                <td>{{ $currency->name }}</td>
                <td>{{ $currency->alphabetic_code }}</td>
                <td>{{ $currency->symbol }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $currencies->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
