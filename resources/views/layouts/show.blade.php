@php /** @var \App\PropsViews\PropsViews[] $propsViews */ @endphp
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="table-container">
                <table class="table is-bordered is-fullwidth">
                    <thead>
                    @foreach($propsViews as $propsView)
                        {{ $propsView->render($model) }}
                    @endforeach
                    </thead>
                </table>
            </div>
        </section>
    </template>
@endsection

