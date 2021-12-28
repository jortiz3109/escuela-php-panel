<b-field
    label="{{ trans('merchants.fields.country') }}"
    type="{{ $errors->has('filters.country') ? 'is-danger' : '' }}"
    message="{{ $errors->first('filters.country') }}">
    <b-select
        placeholder="{{ trans('merchants.placeholders.select_country') }}" expanded
        name="filters[country]"
        value="{{ $value }}"
    >
        @foreach ($countries as $country)
            <option value="{{ $country->alpha_two_code }}">
                {{ $country->name }}
            </option>
        @endforeach
    </b-select>
</b-field>
