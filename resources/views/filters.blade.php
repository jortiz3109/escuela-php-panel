<b-collapse class="card" animation="slide" :open="{{ request()->has('filters') ? 'true' : 'false' }}" v-cloak>
    <template #trigger="props">
        <div
            class="card-header"
            role="button">
            <p class="card-header-title">Filters</p>
            <a class="card-header-icon"><b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon></a>
        </div>
    </template>

    <div class="card-content">
        <form action="{{ url()->current() }}" method="GET">

           @php
                $numberOfColumns = 3;
                $arrayChunks = array_chunk($filters, $numberOfColumns,true);
           @endphp

            @foreach($arrayChunks as $row => $content)
              <div class="columns">
                 @foreach($content as $key => $value)
                    @includeIf("partials.filters.{$key}", compact('value'))
                 @endforeach
              </div>
            @endforeach

            <b-button type="is-link" native-type="submit" icon-left="magnify">@lang('filters.find')</b-button>
            <b-button tag="a" type="is-link" href="{{ url()->current() }}" icon-left="eraser">@lang('filters.clear')</b-button>
        </form>
    </div>
</b-collapse>
<hr>
