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
            @foreach($filters as $filter => $value)
                @includeIf("partials.filters.{$filter}", compact('value'))
            @endforeach
            <b-button type="is-link" native-type="submit" icon-left="magnify">{{ trans('filters.find') }}</b-button>
            <b-button tag="a" type="is-link" href="{{ url()->current() }}" icon-left="eraser">{{ trans('filters.clear') }}</b-button>
        </form>
    </div>
</b-collapse>
<hr>
