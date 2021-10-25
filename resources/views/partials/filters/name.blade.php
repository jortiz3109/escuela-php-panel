<b-field
    label="@lang('Name')"
    type="{{ $errors->has('name') ? 'is-danger' : '' }}"
    message="{{ $errors->first('name') }}">
    <b-input
        name="filters[name]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
