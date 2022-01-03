<div class="column is-4">
    <b-field
        label="{{ trans('transactions.fields.status') }}"
        type="{{ $errors->has('filters.status') ? 'is-danger' : '' }}"
        message="{{ $errors->first('filters.status') }}">
        <b-select
            placeholder="{{ trans('transactions.placeholders.select_status') }}" expanded
            name="filters[status]"
            value="{{ $value }}"
        >
            @foreach ($statuses as $status)
                <option value="{{ $status }}">
                    {{ $status }}
                </option>
            @endforeach
        </b-select>
    </b-field>
</div>
