<b-field
    label="@lang('merchants.labels.merchantQuery')"
    type="{{ $errors->has('filters.merchantQuery') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.merchantQuery') }}">
    <b-input
        name="filters[merchantQuery]"
        value="{{ $value  }}"
        placeholder="@lang('merchants.placeholders.merchantQuery')"
    ></b-input>
</b-field>
