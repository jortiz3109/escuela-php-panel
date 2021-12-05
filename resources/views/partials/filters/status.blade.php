<div class="column is-4">
    <b-field
        label="@lang('users.fields.status')"
        type="{{ $errors->has('filters.enabled_at') ? 'is-danger' : '' }}"
        message="{{ $errors->first('filters.enabled_at') }}">
        <b-select
            name="filters[status]"
            value="{{ $value  }}"
            expanded>
            <option value=enabled>@lang('users.status.enabled')</option>
            <option value=disabled>@lang('users.status.disabled')</option>
        </b-select>
    </b-field>
</div>





