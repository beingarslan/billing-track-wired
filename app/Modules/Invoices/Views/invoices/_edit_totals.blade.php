<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline gap-2">
            <span><strong>@lang('bt.subtotal')</strong></span>
            <span class="text-end">{{ $invoice->amount->formatted_subtotal }}</span>
        </div>

        @if ($invoice->discount > 0)
            <div class="d-flex justify-content-between align-items-baseline gap-2">
                <span><strong>@lang('bt.discount')</strong></span>
                <span class="text-end">{{ $invoice->amount->formatted_discount }}</span>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-baseline gap-2">
            <span><strong>@lang('bt.tax')</strong></span>
            <span class="text-end">{{ $invoice->amount->formatted_tax }}</span>
        </div>

        <div class="d-flex justify-content-between align-items-baseline gap-2">
            <span><strong>@lang('bt.total')</strong></span>
            <span class="text-end">{{ $invoice->amount->formatted_total }}</span>
        </div>

        <div class="d-flex justify-content-between align-items-baseline gap-2">
            <span><strong>@lang('bt.paid')</strong></span>
            <span class="text-end">{{ $invoice->amount->formatted_paid }}</span>
        </div>

        <div class="d-flex justify-content-between align-items-baseline gap-2">
            <span><strong>@lang('bt.balance')</strong></span>
            <span class="text-end">{{ $invoice->amount->formatted_balance }}</span>
        </div>
    </div>
</div>
