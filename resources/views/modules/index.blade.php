@extends('layouts.admin')
@section('content')
    <table class="table is-hoverable is-fullwidth is-striped">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            @foreach($fields as $settings)
                <th scope="col" class="{{ $settings['class'] ?? '' }}">
                    @lang($settings['translation'] ?? '')
                </th>
            @endforeach
        </tr>
        </thead>
        <tfoot>
        <tr>
            @foreach($fields as $settings)
                <th scope="col">@lang($settings['translation'] ?? '')</th>
            @endforeach
        </tr>
        </tfoot>
        <tbody>
        @foreach($collection->toArray(request()) as $item)
            <tr>
                @foreach($fields as $field => $settings)
                    <td class="{{ $settings['class'] ?? '' }}">{{ $item[$field] ?? null }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $collection->render('partials.pagination.paginator') }}
@endsection
