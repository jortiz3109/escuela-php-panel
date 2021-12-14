@php /** @var \App\PropsViews\PropsViews[] $propsViews */ @endphp
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="table-container">
                <table class="table is-bordered is-fullwidth">
                    <thead>
                    @foreach($fields as $field)
                        {{ $field->render() }}
                    @endforeach
                    </thead>
                </table>
            </div>
        </section>
    </template>
@endsection

