@php /** @var \App\Inputs\Input[] $fields */ @endphp
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <form id="submit" method="POST" action="{{ $action }}">
                @csrf
                @isset($model)
                    @method('PUT')
                @endisset
                @foreach($fields as $field)
                    {{ $field->render($model) }}
                @endforeach
            </form>
        </section>
    </template>
@endsection
