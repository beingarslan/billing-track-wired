@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="bt-toolbar px-3">
            <h3 class="me-auto mb-0">@lang('bt.events')</h3>
            <div class="btn-group">
            <button class="btn btn-primary rounded border"
                    type="button"
                    onclick="window.livewire.emit('showModal', 'modals.create-event-modal')"
            ><i class="fa fa-plus"></i> @lang('bt.create_event')
            </button>
            </div>
        </div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="card">
            <div class="col-12 col-lg-12">
                <div class="card card-light">
                    <div class="card-body">
                        <livewire:data-tables.module-table :module_type="'Schedule'"/>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
