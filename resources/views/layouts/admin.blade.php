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
                            <li><a href="#"><em class="pr-2 mdi mdi-cash"></em>@lang('Transactions')</a></li>
                            <li>
                                <a href="#">
                                    <em class="is-active pr-2 mdi mdi-piggy-bank-outline"></em>@lang('Merchants')
                                </a>
                                <ul>
                                    <li><a>Payment methods</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><em class="pr-2 mdi mdi-map-legend"></em>@lang('Countries')</a></li>
                            <li><a href="#"><em class="pr-2 mdi mdi-currency-usd"></em>@lang('Currencies')</a></li>
                        </ul>

                        <p class="menu-label">@lang('menu.security')</p>
                        <ul class="menu-list">
                            <li><a href="{{ route('permissions.index') }}"><em class="pr-2 mdi mdi-shield-lock"></em>@lang('permissions.navbar.title')</a></li>
                            <li><a href="#"><em class="pr-2 mdi mdi-account-multiple"></em>@lang('Users')</a></li>
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