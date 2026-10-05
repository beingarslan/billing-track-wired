@include('invoices._js_edit_from')
<div class="card card-outline card-primary">
    <div class="card-header bt-toolbar">
        <h3 class="card-title me-auto">@lang('bt.from')</h3>

        <div class="card-tools d-flex flex-wrap gap-2">
            <button class="btn btn-secondary btn-sm" id="btn-change-company-profile">
                <i class="fa fa-exchange-alt"></i> @lang('bt.change')
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $invoice->companyProfile->company }}</strong><br>
        {!! $invoice->companyProfile->formatted_address !!}<br>
        @lang('bt.phone'): {{ $invoice->companyProfile->phone }}<br>
        @lang('bt.email'): {{ $invoice->companyProfile->email }}
        @if ($invoice->companyProfile->vat_number)<br>@lang('bt.vat_number'): {{ $invoice->companyProfile->vat_number }}@endif
    </div>
</div>
