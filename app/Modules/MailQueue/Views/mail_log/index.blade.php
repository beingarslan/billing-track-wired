@extends('layouts.master')

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="col-sm-12">
                <div class="bt-toolbar">
                    <div class="fs-3">@lang('bt.mail_log')</div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        @include('layouts._alerts')
        <div class="card card-light">
            <div class="card-body">
                <script type="text/javascript">
                    ready(function () {
                        addEvent(document, 'click', ".btn-show-content", (e) => {
                            loadModal('{{ route('mailLog.content') }}', {
                                id: e.target.closest('.btn-show-content').dataset.id
                            })
                        })
                    })
                </script>
                <livewire:data-tables.module-table :module_type="'MailQueue'"/>
            </div>
        </div>
    </section>
@stop
