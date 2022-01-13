@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <div class="container">
                @foreach($fields as $name => $section)
                    <div class="columns">
                        <div class="column is-one-quarter">
                            <h3 class="title is-5">{{ trans($name) }}</h3>
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

@push('head')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
@endpush()
