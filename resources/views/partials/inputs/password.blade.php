<b-field
    label="{{ $field->label }}"
    horizontal>
    <b-input
        type="password"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        password-reveal
        {{ $field->required ? 'required' : '' }}>
    </b-input>
</b-field>
