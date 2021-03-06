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
                        <p class="menu-label">{{ trans('menu.administration') }}</p>
                        <ul class="menu-list">
                            @can('viewAny', \App\Models\Merchant::class)
                                <li>
                                    <a href="{{ App\Models\Merchant::urlPresenter()->index() }}">
                                        <em class="is-active pr-2 mdi mdi-piggy-bank-outline"></em>{{ trans('merchants.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Models\Transaction::class)
                                <li>
                                    <a href="{{ route('transactions.index') }}">
                                        <em class="pr-2 mdi mdi-cash"></em>{{ trans('transactions.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Models\PaymentMethod::class)
                                <li>
                                    <a href="{{ route('payment-methods.index') }}">
                                        <em class="pr-2 mdi mdi-card-account-details"></em>{{ trans('common.payment_methods') }}
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Models\Country::class)
                                <li>
                                    <a href="{{ route('countries.index') }}">
                                        <em class="pr-2 mdi mdi-map-legend"></em>{{ trans('countries.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Models\Currency::class)
                                <li>
                                    <a href="{{ route('currencies.index') }}">
                                        <em class="pr-2 mdi mdi-currency-usd"></em>{{ trans('currencies.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>

                        <p class="menu-label">{{ trans('menu.security') }}</p>
                        <ul class="menu-list">
                            @can('viewAny', \App\Models\Permission::class)
                                <li>
                                    <a href="{{ route('permissions.index') }}">
                                        <em class="pr-2 mdi mdi-shield-lock"></em>{{ trans('permissions.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('viewAny', \App\Models\User::class)
                                <li>
                                    <a href="{{ App\Models\User::urlPresenter()->index() }}">
                                        <em class="pr-2 mdi mdi-account-multiple"></em>{{ trans('users.navbar.title') }}
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{ route('logins.index') }}">
                                    <em class="pr-2 mdi mdi-login"></em>{{ trans('Last logins') }}
                                </a>
                            </li>
                        </ul>

                        <p class="menu-label">{{ trans('menu.system') }}</p>
                        <ul class="menu-list">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <em class="pr-2 mdi mdi-logout"></em>{{ trans('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
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
                                        @include("partials.buttons.$template", $button)
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('partials.alert')
                    @includeWhen(isset($filters) && count($filters), 'filters', ['filters' => $filters ?? []])
                    <div class="box block">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
@endpush
