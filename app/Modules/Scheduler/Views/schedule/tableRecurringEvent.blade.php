@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="bt-toolbar px-3">
            <h3 class="me-auto mb-0">@lang('bt.recurring_events')</h3>
            <div class="btn-group">
            <a href="{!! route('scheduler.editrecurringevent') !!}" class="btn btn-primary rounded border"><i
                        class="fa fa-fw fa-plus"></i> @lang('bt.create_recurring_event')</a>
            </div>
        </div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="card">
            <div class="col-12 col-lg-12">
                <div class="card card-light">
                    <div class="card-body">
                        <livewire:data-tables.module-table :module_type="'RecurringEvent'"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
