@extends('layouts.admin')
@section('content')
<h3 class="title is-5">@lang('Transaction data')</h3>
<section>
    <b-field horizontal label="@lang('Merchant')">
        <b-field>{{ $transaction->merchant->name }}</b-field>
    </b-field>

    <b-field horizontal label="@lang('Reference')">
        <b-field>{{ $transaction->reference }}</b-field>
    </b-field>

    <b-field horizontal label="@lang('Payment method')">
        <b-field>
            <img src="{{ $transaction->paymentMethod->logo }}" alt="@lang('Payment method logo')" width="50">
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('Card number')">
        <b-field>
            {{ $transaction->card_number }}
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('Currency')">
        <b-field>
            {{ $transaction->currency->name }} ({{ $transaction->currency->alphabetic_code }})
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('Total amount')">
        <b-field>
            {{ $transaction->currency->alphabetic_code }} {{ \App\Helpers\AmountHelper::format($transaction->total_amount, $transaction->currency->alphabetic_code) }}
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('Status')">
        <b-field>
            {{ $transaction->status }}
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('IP address')">
        <b-field>
            {{ $transaction->ip_address }}
        </b-field>
    </b-field>

    <b-field horizontal label="@lang('Executed')">
        <b-field>
            {{ $transaction->executed_at }}
        </b-field>
    </b-field>
</section>

<hr>

<h3 class="title is-5 mgt-small">@lang('Payer')</h3>
<section>
    <b-field horizontal label="@lang('Name')">
        <b-field>{{ $transaction->payer->name }}</b-field>
    </b-field>

    <b-field horizontal label="@lang('Email')">
        <b-field>{{ $transaction->payer->email }}</b-field>
    </b-field>
</section>

<hr>

<h3 class="title is-5 mgt-small">@lang('Buyer')</h3>
<section>
    <b-field horizontal label="@lang('Name')">
        <b-field>{{ $transaction->buyer->name }}</b-field>
    </b-field>

    <b-field horizontal label="@lang('Email')">
        <b-field>{{ $transaction->buyer->email }}</b-field>
    </b-field>
</section>
@endsection
