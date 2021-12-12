<b-field
    label="@lang('transactions.fields.payment_method')"
    type="{{ $errors->has('filters.payment_method') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.payment_method') }}">
    <b-select
        placeholder="@lang('transactions.placeholders.select_payment_method')" expanded
        name="filters[payment_method]"
    >
        @foreach ($payment_methods as $payment_method)
            <option value="{{ $payment_method->name }}">
                {{ $payment_method->name }}
            </option>
        @endforeach
    </b-select>
</b-field>
