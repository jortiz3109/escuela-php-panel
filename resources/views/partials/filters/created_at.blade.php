<b-field
    label="@lang('Created at')"
    type="{{ $errors->has('filters.enabled_at') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.enabled_at') }}">
    <b-datepicker
        selected="{{ $value  }}"
        name="filters[created_at]"
        locale="en-ca">
    </b-datepicker>
</b-field>
