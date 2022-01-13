<b-field
    label="{{ $field->label }}"
    horizontal>
    <b-input
        type="text"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        {{ $field->required ? 'required' : '' }}
        {{ $field->disabled ? 'disabled' : '' }}
        value="{{ old($field->name, $model->{$field->name}) }}">
    </b-input>
</b-field>
