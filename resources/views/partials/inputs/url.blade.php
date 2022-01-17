<b-field
    horizontal
    label="{{ $field->label }}"
    type="@error($field->name) is-danger @enderror"
    message="@error($field->name) {{ $errors->first($field->name) }} @enderror">
    <b-input
        type="url"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        {{ $field->required ? 'required' : '' }}
        value="{{ old($field->name, $model->{$field->name} ?? '') }}">
    </b-input>
</b-field>
