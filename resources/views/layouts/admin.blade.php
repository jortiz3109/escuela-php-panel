@extends('layouts.app')
@push('main')
    @include('navbar')
@endpush
@push('main')
    <main class="section" id="app">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <aside class="menu">
                        <p class="menu-label">@lang('menu.administration')</p>
                        <ul class="menu-list">
                            <a href="#">
                                <em class="mdi mdi-cash"></em>
                                @lang('Transactions')
                            </a>
                            <a href="#">
                                <em class="mdi mdi-piggy-bank-outline"></em>
                                @lang('Merchants')
                            </a>
                            <a href="#">
                                <em class="mdi mdi-map-legend"></em>
                                @lang('Countries')
                            </a>
                            <a href="#">
                                <em class="mdi mdi-currency-usd"></em>
                                @lang('Currencies')
                            </a>
                        </ul>

                        <p class="menu-label">@lang('menu.security')</p>
                        <ul class="menu-list">
                            <a href="{{ route('permissions.index') }}">
                                <em class="mdi mdi-shield-lock"></em>
                                @lang('permissions.navbar.title')
                            </a>
                            <a href="#">
                                <em class="mdi mdi-account-multiple"></em>
                                @lang('Users')
                            </a>
                        </ul>
                    </aside>
                </div>
                <div class="column is-four-fifths">
                    <div class="level">
                        <div class="level-left">
                            <div class="level-item">
                                <h1 class="title">{{ $texts['title'] }}</h1>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="level-item">
                                <div class="buttons">
                                    @foreach($buttons as $template => $button)
                                        @include("partials.buttons.{$template}", $button)
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
@endpush
