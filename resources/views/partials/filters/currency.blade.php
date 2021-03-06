<b-field
    label="{{ trans('merchants.fields.currency') }}"
    type="{{ $errors->has('filters.currency') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.currency') }}">
    <b-select
        placeholder="{{ trans('merchants.placeholders.select_currency') }}" expanded
        name="filters[currency]"
        value="{{ $value }}"
    >
        @foreach ($currencies as $currency)
            <option value="{{ $currency->alphabetic_code }}">
                {{ $currency->alphabetic_code }} - {{ $currency->name }}
            </option>
        @endforeach
    </b-select>
</b-field>
