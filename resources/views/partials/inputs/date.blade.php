<b-field
    label="{{ $field->label }}"
    horizontal>
    <b-input
        type="date"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        {{ $field->required ? 'required' : '' }}
        value="{{ old($field->name, $model->{$field->name} ?? '') }}">
    </b-input>
</b-field>
