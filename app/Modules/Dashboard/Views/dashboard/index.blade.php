@extends('layouts.master')

@section('content')
    @include('layouts._alerts')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <div class="fs-3">@lang('bt.dashboard')</div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        {{-- bt-widget-grid: the col-md-N value below comes straight from runtime config with
             no clamping, so an admin who set 3 or 4 gets three or four widgets side by side
             between 768 and 991px, each full of nowrap numerics and 50px icons. mobile.css
             forces this grid to a single column below 992px regardless of the config value. --}}
        <div class="row bt-widget-grid">
            @foreach ($widgets as $widget)
                @if (config('bt.widgetEnabled' . $widget))
                    {{-- col-12 base is explicit; col-sm-12 was redundant (a bare col-md-N is
                         already full width below 576px, but only implicitly). --}}
                    <div class="col-12 col-md-{{ config('bt.widgetColumnWidth' . $widget) }}">
                        @include($widget . 'Widget')
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop
