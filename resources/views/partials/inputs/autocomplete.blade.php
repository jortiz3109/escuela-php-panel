<b-field
    horizontal
    label="{{ $field->label }}"
    type="@error($field->name) is-danger @enderror"
    message="@error($field->name) {{ $errors->first($field->name) }} @enderror">
    <i-autocomplete
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        placeholder="{{ $field->placeholder }}"
        initial_value="{{ old($field->name, $model->{$field->name} ?? '') }}"
        :data='{{ $field->data }}'>
    </i-autocomplete>
</b-field>
