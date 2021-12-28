@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="table-container">
                <table class="table is-bordered is-fullwidth">
                    <caption></caption>
                        @foreach($fields as $field => $viewComponent)
                            <tr>
                                {{ $viewComponent->renderTableHeader() }}
                                {{ $viewComponent->renderField($model, $field) }}
                            </tr>
                        @endforeach
                </table>
            </div>
        </section>
    </template>
@endsection
