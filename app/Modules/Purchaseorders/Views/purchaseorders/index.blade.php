@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12 bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.purchaseorders')</div>
                {!! Form::open(['method' => 'GET', 'id' => 'filter', 'class' => 'bt-fluid-sm']) !!}
                <div class="input-group flex-wrap">
                    {!! Form::select('company_profile', $companyProfiles, request('company_profile'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                    {!! Form::select('status', $statuses, request('status'), ['class' => 'filter_options form-select w-auto me-1 bt-fluid-sm']) !!}
                    {!! Form::hidden('vendor', request('vendor')) !!}
                </div>
                {!! Form::close() !!}
                <button class="btn btn-primary rounded border"
                        type="button"
                        {{--                   params 3 thru ... mount(,,$modulefullname, $moduleop, $resource_id = null, $module_id = null, $readonly = null)--}}
                        onclick="window.livewire.emit('showModal', 'modals.create-module-modal',  'BT\\Modules\\Purchaseorders\\Models\\Purchaseorder', 'create' )"
                ><i class="fa fa-plus"></i> @lang('bt.create_purchaseorder')
                </button>
            </div>
        </div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="card ">
            <div class="card-body">
                <livewire:data-tables.module-table :module_type="'Purchaseorder'" :keyedStatuses="$keyedStatuses"/>
            </div>
        </div>
    </section>
@stop
