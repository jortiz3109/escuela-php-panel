@php /** @var \App\FieldViews\FieldView[] $fields */ @endphp
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="table-container">
                <table class="table is-bordered is-fullwidth">
                    <caption></caption>
                    @foreach($fields as $field)
                        {{ $field->render() }}
                    @endforeach
                </table>
            </div>
        </section>
    </template>
@endsection

