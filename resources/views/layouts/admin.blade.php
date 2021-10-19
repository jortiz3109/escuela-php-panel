@extends('layouts.app')
@push('main')
    <main class="section" id="app">
        <div class="container">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <h1 class="title">{{ $texts['title'] }}</h1>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <div class="buttons">

                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </main>
@endpush
