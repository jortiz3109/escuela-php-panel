<b-field
    label="@lang('merchants.fields.currency')"
    type="{{ $errors->has('filters.currency') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.currency') }}">
    <b-input
        name="filters[currency]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
