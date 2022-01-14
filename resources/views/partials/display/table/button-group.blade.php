<td class="{{ $valueClass ?? '' }}">
    <div class="level">
        @foreach($buttons as $button)
            {{ $button->renderField($model) }}
        @endforeach
    </div>
</td>
