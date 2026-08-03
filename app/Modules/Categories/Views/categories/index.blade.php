@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.categories')</div>
                <div class="btn-group flex-wrap">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary "><i
                                class="fa fa-plus"></i> @lang('bt.create_category')</a>
                </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card">
            <div class="card-body">
                <livewire:data-tables.module-table :module_type="'Category'"/>
            </div>
        </div>
    </section>
@stop
