@extends('layouts.admin')
@section('content')
    <table class="table is-hoverable is-fullwidth is-striped">
        <caption class="is-hidden">{{ $texts['title'] }}</caption>
        <thead>
            <tr>
                @foreach($fields as $viewComponent)
                    {{ $viewComponent->renderTableHeader() }}
                @endforeach
            </tr>
        </thead>
        <tfoot>
            <tr>
                @foreach($fields as $viewComponent)
                    {{ $viewComponent->renderTableHeader() }}
                @endforeach
            </tr>
        </tfoot>
        <tbody>
        @foreach($collection as $item)
            <tr>
                @foreach($fields as $field => $viewComponent)
                    {{ $viewComponent->renderField($item->toArray(), $field) }}
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $collection->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection
