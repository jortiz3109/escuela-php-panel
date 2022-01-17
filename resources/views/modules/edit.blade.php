@php /** @var \App\ViewComponents\Inputs\Input[] $fields */ @endphp
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <form id="submit" method="POST" action="{{ $action }}">
                @csrf
                @method('PUT')
                @foreach($fields as $field)
                    {{ $field->render($model) }}
                @endforeach
            </form>
        </section>
    </template>
@endsection
