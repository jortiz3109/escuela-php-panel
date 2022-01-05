<b-field
    label="{{ trans('Name') }}"
    type="{{ $errors->has('filters.name') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.name') }}">
    <b-input
        name="filters[name]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
