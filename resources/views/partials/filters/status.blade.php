<b-field
    label="@lang('transactions.fields.status')"
    type="{{ $errors->has('filters.status') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.status') }}">
    <b-select
        placeholder="@lang('transactions.placeholders.select_status')" expanded
        name="filters[status]"
    >
        @foreach ($statuses as $status)
            <option value="{{ $status }}">
                {{ $status }}
            </option>
        @endforeach
    </b-select>
</b-field>
