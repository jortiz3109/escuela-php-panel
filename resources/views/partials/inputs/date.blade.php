<b-field
    label="{{ $field->label }}"
    horizontal>
    <b-datepicker
        v-model="selected"
        id="{{ $field->name }}"
        name="{{ $field->name }}"
        icon="calendar-today"
        trap-focus
        {{ $field->required ? 'required' : '' }}>
    </b-datepicker>
</b-field>
<script>
    export default {
        data() {
            return {
                selected: {{ old($field->name, $model->{$field->name} ?? '') }},
            }
        },
    }
</script>
