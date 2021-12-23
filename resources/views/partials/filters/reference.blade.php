<b-field
    label="@lang('Reference')"
    type="{{ $errors->has('filters.reference') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.reference') }}">
    <b-input
        name="filters[reference]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
