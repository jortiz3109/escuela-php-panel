<b-field
    label="@lang('merchants.labels.multiple')"
    type="{{ $errors->has('filters.multiple') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.multiple') }}">
    <b-input
        name="filters[multiple]"
        value="{{ $value  }}"
        placeholder="@lang('merchants.placeholders.multiple')"
    ></b-input>
</b-field>
