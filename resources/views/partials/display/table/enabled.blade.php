<td class="{{ $valueClass ?? '' }}">
    @if($value)
        <b-tag rounded class="is-success"><span><em class="fas fa-check-circle"></em><span>{{ trans('common.fields.enabled') }}</b-tag>
    @else
        <b-tag rounded class="is-danger"><span class="icon"><em class="fas fa-ban"></em></span>{{ trans('common.fields.disabled') }}</b-tag>
    @endif
</td>
