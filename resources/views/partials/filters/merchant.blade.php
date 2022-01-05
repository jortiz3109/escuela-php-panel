<b-field
    label="{{ trans('Merchant') }}"
    type="{{ $errors->has('filters.merchant') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.merchant') }}">
    <b-input
        name="filters[merchant]"
        value="{{ $value  }}"
    ></b-input>
</b-field>
