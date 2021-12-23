<b-field
    label="@lang('Date')"
    type="{{ $errors->has('filters.date') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.date') }}">
    <b-datepicker
        name="filters[date]"
        range
    ></b-datepicker>
</b-field>
