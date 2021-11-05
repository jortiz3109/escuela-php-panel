<b-field
    label="@lang('merchants.fields.document')"
    type="{{ $errors->has('filters.document') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.document') }}">
    <b-input
        name="filters[document]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
