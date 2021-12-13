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
                    <th scope="col" class="{{ $settings['class'] ?? '' }}">
                        @lang($settings['translation'] ?? '')
                    </th>
                @endforeach
            </tr>
        </tfoot>
        <tbody>
        @foreach($collection->toArray(request()) as $item)
            <tr>
                @foreach($fields as $field => $settings)
                    @if(isset($settings['route']))
                        <td class="{{ $settings['class'] ?? '' }}">
                            <a href="{{route($settings['route'][0], $item[$settings['route'][1]] )}}">{{ $item[$field] ?? null }}</a>
                        </td>
                    @else
                        <td class="{{ $settings['class'] ?? '' }}">{{ $item[$field] ?? null }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $collection->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
