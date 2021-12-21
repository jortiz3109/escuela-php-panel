<b-field
    label="@lang('Date')"
    type="{{ $errors->has('filters.dates') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.dates') }}">
    <b-datepicker
        name="filters[dates]"
        range
    ></b-datepicker>
</b-field>
