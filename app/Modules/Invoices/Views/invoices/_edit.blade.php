@include('invoices._js_edit')
<section class="app-content-header">
    <div class="bt-toolbar px-3">
        <h3 class="mb-0">@lang('bt.invoice') #{{ $invoice->number }}</h3>
        @if ($invoice->viewed)
            <span class="badge bg-success">@lang('bt.viewed')</span>
        @else
            <span class="badge bg-secondary">@lang('bt.not_viewed')</span>
        @endif

        @if ($invoice->quote()->count())
            <span class="badge bg-info"><a href="{{ route('quotes.edit', [$invoice->quote->id]) }}"
                                              style="color: inherit;">@lang('bt.converted_from_quote') {{ $invoice->quote->number }}</a></span>
        @endif

        @if ($invoice->workorder()->count())
            <span class="badge bg-info"><a href="{{ route('workorders.edit', [$invoice->workorder->id]) }}"
                                              style="color: inherit;">@lang('bt.converted_from_workorder') {{ $invoice->workorder->number }}</a></span>
        @endif
    </div>
    <div class="px-3 pt-2">
        <div class="bt-action-bar justify-content-md-end">
            <a href="{{ route('invoices.pdf', [$invoice->id]) }}" target="_blank" id="btn-pdf-invoice"
               class="btn btn-secondary" aria-label="@lang('bt.pdf')" title="@lang('bt.pdf')"><i
                        class="fa fa-print"></i> <span class="d-none d-sm-inline">@lang('bt.pdf')</span></a>
            @if (config('bt.mailConfigured'))
                <a href="javascript:void(0)" id="btn-email-invoice" class="btn btn-secondary email-invoice"
                   aria-label="@lang('bt.email')" title="@lang('bt.email')"
                   data-invoice-id="{{ $invoice->id }}" data-redirect-to="{{ route('invoices.edit', [$invoice->id]) }}"><i
                            class="fa fa-envelope" data-invoice-id="{{ $invoice->id }}"
                            data-redirect-to="{{ route('invoices.edit', [$invoice->id]) }}"></i> <span
                            class="d-none d-sm-inline">@lang('bt.email')</span></a>
            @endif
            <div class="btn-group">
                <button type="button" class="btn btn-secondary" data-bs-toggle="dropdown"
                        aria-label="@lang('bt.other')" title="@lang('bt.other')">
                    <i class="fa fa-ellipsis-h"></i> <span class="d-none d-sm-inline">@lang('bt.other')</span>
                </button>
                <div class="dropdown-menu dropdown-menu-end" role="menu">
                    @if ($invoice->isPayable or config('bt.allowPaymentsWithoutBalance'))
                        <button class="dropdown-item"
                                type="button"
                                onclick="window.livewire.emit('showModal', 'modals.create-payment-modal', '{{  addslashes(get_class($invoice)) }}', {{ $invoice->id }}, true )"
                        ><i class="fa fa-credit-card"></i> @lang('bt.enter_payment')
                        </button>
                    @endif
                        <a class="dropdown-item" href="#" id="btn-copy_invoice"
                           {{--                   params 3 thru ... mount(,,$modulefullname, $moduleop, $resource_id = null, $module_id = null, $readonly = null)--}}
                           onclick="window.livewire.emit('showModal', 'modals.create-module-modal', '{{  addslashes(get_class($invoice)) }}', 'copy', {{ $invoice->client->id }}, {{ $invoice->id }})">
                            <i class="fa fa-copy"></i> @lang('bt.copy_invoice')</a>

                        <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.show', [$invoice->url_key]) }}"
                       target="_blank"><i
                                class="fa fa-globe"></i> @lang('bt.public')</a>
                    <div class="dropdown-divider"></div>
                    @if($invoice->quote || $invoice->workorder)
                        <a class="dropdown-item" href="#"
                           onclick="swalConfirm('@lang('bt.trash_record_warning')','@lang('bt.trash_invoice_warning_assoc_msg')', '{{ route('invoices.delete', [$invoice->id]) }}');"><i
                                    class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                    @else
                        <a class="dropdown-item" href="#"
                           onclick="swalConfirm('@lang('bt.trash_record_warning')', '@lang('bt.trash_invoice_warning_msg')', '{{ route('invoices.delete', [$invoice->id]) }}');"><i
                                    class="fa fa-trash-alt"></i> @lang('bt.trash')</a>
                    @endif
                </div>
            </div>
            @if ($returnUrl)
                <a href="{{ $returnUrl }}" class="btn btn-secondary" aria-label="@lang('bt.back')"
                   title="@lang('bt.back')"><i
                            class="fa fa-backward"></i> <span class="d-none d-sm-inline">@lang('bt.back')</span></a>
            @endif
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-save-invoice"
                        aria-label="@lang('bt.save')" title="@lang('bt.save')"><i
                            class="fa fa-save"></i> <span class="d-none d-sm-inline">@lang('bt.save')</span></button>
                <button type="button" class="btn btn-primary" data-bs-toggle="dropdown"
                        aria-label="@lang('bt.options')"><i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" role="menu">
                    <a href="#" class="btn-save-invoice dropdown-item"
                       data-apply-exchange-rate="1">@lang('bt.save_and_apply_exchange_rate')</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="container-fluid">
    <div class="row">
        <div class="col-12">
            @include('layouts._alerts')
            <div id="form-status-placeholder"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-9 col-xl-10 order-2 order-lg-1">
            <div class="row">
                <div class="col-sm-6" id="col-from">
                    @include('invoices._edit_from')
                </div>
                <div class="col-sm-6" id="col-to">
                    @include('invoices._edit_to')
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">@lang('bt.summary')</h3>
                        </div>
                        <div class="card-body">
                            {!! Form::text('summary', $invoice->summary, ['id' => 'summary', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <livewire:items-table :module="$invoice" />
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-primary m-2">
                        <div class="card-header d-flex p-0">
                            <ul class="nav nav-tabs p-2">
                                <li class="nav-item"><a class="nav-link active show" href="#tab-additional"
                                                        data-bs-toggle="tab">@lang('bt.additional')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-notes"
                                                        data-bs-toggle="tab">@lang('bt.notes')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-attachments"
                                                        data-bs-toggle="tab">@lang('bt.attachments')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab-payments"
                                                        data-bs-toggle="tab">@lang('bt.payments')</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-additional">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="terms">@lang('bt.terms_and_conditions')</label>
                                                {!! Form::textarea('terms', $invoice->terms, ['id' => 'terms', 'class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="footer">@lang('bt.footer')</label>
                                                {!! Form::textarea('footer', $invoice->footer, ['id' => 'footer', 'class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if ($customFields->count())
                                        <div class="row">
                                            <div class="col-md-12">
                                                @include('custom_fields._custom_fields_unbound', ['object' => $invoice])
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tab-notes">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('notes._notes', ['object' => $invoice, 'model' => 'BT\Modules\Invoices\Models\Invoice', 'showPrivateCheckbox' => true, 'hideHeader' => true])
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-attachments">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @include('attachments._table', ['object' => $invoice, 'model' => 'BT\Modules\Invoices\Models\Invoice'])
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-payments">
                                    <div class="table-responsive">
                                        <table class="table table-hover bt-stack">
                                            <thead>
                                            <tr>
                                                <th>@lang('bt.payment_date')</th>
                                                <th>@lang('bt.amount')</th>
                                                <th>@lang('bt.payment_method')</th>
                                                <th>@lang('bt.note')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($invoice->payments as $payment)
                                                <tr>
                                                    <td data-label="@lang('bt.payment_date')">{{ $payment->formatted_paid_at }}</td>
                                                    <td data-label="@lang('bt.amount')">{{ $payment->formatted_amount }}</td>
                                                    <td data-label="@lang('bt.payment_method')">@if ($payment->paymentMethod) {{ $payment->paymentMethod->name }} @endif</td>
                                                    <td data-label="@lang('bt.note')">{{ $payment->note }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-2 order-1 order-lg-2">
            <div id="div-totals">
                @include('invoices._edit_totals')
            </div>
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">@lang('bt.options')</h3>
                </div>
                <div class="card-body">
                    {{-- two columns from sm up (the panel is full width below lg), single column
                         again from lg up where it is back in the narrow sidebar --}}
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="number">@lang('bt.invoice') #</label>
                            {!! Form::text('number', $invoice->number, ['id' => 'number', 'class' =>
                            'form-control
                            form-control-sm']) !!}
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="invoice_date">@lang('bt.date')</label>
                            <x-fp_common
                                    id="invoice_date"
                                    class="form-control form-control-sm"
                                    value="{{$invoice->invoice_date}}"></x-fp_common>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="due_at">@lang('bt.due_date')</label>
                            <x-fp_common
                                    id="due_at"
                                    class="form-control form-control-sm"
                                    value="{{$invoice->due_at}}"></x-fp_common>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="discount">@lang('bt.discount')</label>
                            <div class="input-group input-group-sm">
                                {!! Form::text('discount', $invoice->formatted_numeric_discount, ['id' =>
                                'discount', 'class' => 'form-control form-control-sm', 'inputmode' => 'decimal']) !!}
                                    <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="currency_code">@lang('bt.currency')</label>
                            {!! Form::select('currency_code', $currencies, $invoice->currency_code, ['id' =>
                            'currency_code', 'class' => 'form-select form-select-sm']) !!}
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="exchange_rate">@lang('bt.exchange_rate')</label>
                            <div class="input-group">
                                {!! Form::text('exchange_rate', $invoice->exchange_rate, ['id' =>
                                'exchange_rate', 'class' => 'form-control form-control-sm', 'inputmode' => 'decimal']) !!}
                                    <button class="btn btn-sm input-group-text " id="btn-update-exchange-rate" type="button"
                                            data-toggle="tooltip" data-placement="left"
                                            aria-label="@lang('bt.update_exchange_rate')"
                                            title="@lang('bt.update_exchange_rate')"><i class="fa fa-sync"></i>
                                    </button>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="invoice_status_id">@lang('bt.status')</label>
                            {!! Form::select('invoice_status_id', $statuses, $invoice->invoice_status_id,
                            ['id' => 'invoice_status_id', 'class' => 'form-select form-select-sm']) !!}
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12 mb-3">
                            <label class="form-label" for="template">@lang('bt.template')</label>
                            {!! Form::select('template', $templates, $invoice->template,
                            ['id' => 'template', 'class' => 'form-select form-select-sm']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
