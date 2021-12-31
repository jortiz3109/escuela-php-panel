@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="container">
                @foreach($fields as $name => $section)
                    <div class="columns">
                        <div class="column is-one-quarter">
                            <h3 class="title is-5">{{ $name }}</h3>
                        </div>
                        <div class="column is-dark table-container">
                            <table class="table is-borderless is-fullwidth">
                                <caption></caption>
                                @foreach($section as $field => $viewComponent)
                                    <tr>
                                        {{ $viewComponent->renderTableHeader() }}
                                        {{ $viewComponent->renderField($model, $field) }}
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </template>
@endsection
