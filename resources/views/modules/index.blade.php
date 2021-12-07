@extends('layouts.admin')
@section('content')
    <table class="table is-narrow is-hoverable is-fullwidth">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
        <tr>
            @foreach($fields as $translation)
                <th scope="col">@lang($translation)</th>
            @endforeach
        </tr>
        </thead>
        <tfoot>
        <tr>
            @foreach($fields as $translation)
                <th scope="col">@lang($translation)</th>
            @endforeach
        </tr>
        </tfoot>
        <tbody>
        @foreach($collection as $item)
            <tr>
                @foreach($fields as $field => $translation)
                    <td>{{ $item[$field] }}</td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $collection->render('partials.pagination.paginator') }}
@endsection
