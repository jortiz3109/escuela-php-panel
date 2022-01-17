<div class="column is-4">
    <b-field
        label="@lang('Email')"
        type="{{ $errors->has('filters.email') ? 'is-danger' : '' }}"
        message="{{ $errors->first('filters.email') }}">
        <b-input
            name="filters[email]"
            value="{{ $value  }}"
        ></b-input>
    </b-field>
</div>


