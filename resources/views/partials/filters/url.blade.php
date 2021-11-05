<b-field
    label="@lang('merchants.fields.url')"
    type="{{ $errors->has('filters.url') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.url') }}">
    <b-input
        name="filters[url]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
