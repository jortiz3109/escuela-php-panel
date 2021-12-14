<tr>
    <th scope="row">{{ $label }}</th>
    <td>
        @if($value)
            <b-tag rounded class="is-success"><span><i class="fas fa-check-circle"></i><span>{{ trans('common.fields.enabled') }}</b-tag>
        @else
            <b-tag rounded class="is-danger"><span class="icon"><i class="fas fa-ban"></i></span>{{ trans('common.fields.disabled') }}</b-tag>
        @endif
    </td>
</tr>

