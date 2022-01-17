<b-field
    horizontal
    label="{{ $field->label }}"
    type="@error($field->name) is-danger @enderror"
    message="@error($field->name) {{ $errors->first($field->name) }} @enderror">
    <b-input
        type="password"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        password-reveal
        {{ $field->required ? 'required' : '' }}>
    </b-input>
</b-field>
