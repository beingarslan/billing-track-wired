@extends('layouts.master')

@section('javaScript')
    <script type="text/javascript">
        ready(function () {
            addEvent(document, 'click', ".email-payment-receipt", (e) => {
                // e.target is the <i> icon when the icon itself is tapped, which
                // is most of the hit area on a phone - read from the trigger
                const trigger = e.target.closest('.email-payment-receipt')
                loadModal('{{ route('payments.paymentMail.create') }}', {
                    payment_id: trigger.dataset.paymentId,
                    redirectTo: trigger.dataset.redirectTo
                })
            })
        })
    </script>
@stop

@section('content')
    <section class="app-content-header">
        <div class="container-fluid">
            <div class="bt-toolbar">
                <div class="fs-3 me-auto">@lang('bt.payments')</div>
                <button class="btn btn-primary rounded border"
                        type="button"
                        onclick="window.livewire.emit('showModal', 'modals.create-payment-modal')"
                ><i class="fa fa-credit-card"></i> @lang('bt.enter_payment')
                </button>
            </div>
        </div>
    </section>
    <section class="content">
        @include('layouts._alerts')
        <div class="card ">
            <div class="card-body">
                <livewire:data-tables.module-table :module_type="'Payment'"  :clientid="request('client')"/>
            </div>
        </div>
    </section>
@stop
