@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.item_lookups')</div>
                <div class="btn-group flex-wrap">
                    <a href="{{ route('itemLookups.create') }}" class="btn btn-primary "><i
                                class="fa fa-plus"></i> @lang('bt.create_itemlookup')</a>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <livewire:data-tables.module-table :module_type="'ItemLookup'"/>
            </div>
        </div>
    </section>
@stop
