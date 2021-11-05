<b-field
    label="@lang('merchants.fields.brand')"
    type="{{ $errors->has('filters.brand') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.brand') }}">
    <b-input
        name="filters[brand]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
