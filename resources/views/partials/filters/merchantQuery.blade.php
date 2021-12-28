<b-field
    label="@lang('merchants.labels.merchant_query')"
    type="{{ $errors->has('filters.merchant_query') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.merchant_query') }}">
    <b-input
        name="filters[merchantQuery]"
        value="{{ $value  }}"
        placeholder="@lang('merchants.placeholders.merchant_query')"
    ></b-input>
</b-field>
