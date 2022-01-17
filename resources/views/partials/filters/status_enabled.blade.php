<b-field
    label="{{ trans('transactions.fields.status') }}"
    type="{{ $errors->has('filters.status_enabled') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.status_enabled') }}">
    <b-select
        placeholder="{{ trans('transactions.placeholders.select_status') }}" expanded
        name="filters[status_enabled]"
        value="{{ $value }}"
    >
        <option value="enabled">{{ trans('common.status_enabled.enabled') }}</option>
        <option value="disabled">{{ trans('common.status_enabled.disabled') }}</option>
    </b-select>
</b-field>
