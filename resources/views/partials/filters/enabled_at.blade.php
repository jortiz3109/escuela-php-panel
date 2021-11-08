<div class="column is-4">
    <b-field
        label="@lang('Enabled_at')"
        type="{{ $errors->has('filters.enabled_at') ? 'is-danger' : '' }}"
        message="{{ $errors->first('filters.enabled_at') }}">
        <b-select
            name="filters[enabled_at]"
            value="{{ $value  }}"
            expanded>
            <option value=true>Habilitado</option>
            <option value=false>Deshabilitado</option>
        </b-select>
    </b-field>
</div>





