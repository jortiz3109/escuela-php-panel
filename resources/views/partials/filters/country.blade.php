<b-field
    label="@lang('merchants.fields.country')"
    type="{{ $errors->has('filters.country') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.country') }}">
    <b-input
        name="filters[country]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
