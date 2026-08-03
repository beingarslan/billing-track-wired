<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.subtotal')</strong><span>{{ $purchaseorder->amount->formatted_subtotal }}</span>
        </div>
        @if ($purchaseorder->discount > 0)
            <div class="d-flex justify-content-between gap-2">
                <strong>@lang('bt.discount')</strong><span>{{ $purchaseorder->amount->formatted_discount }}</span>
            </div>
        @endif
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.tax')</strong><span>{{ $purchaseorder->amount->formatted_tax }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.total')</strong><span>{{ $purchaseorder->amount->formatted_total }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.paid')</strong><span>{{ $purchaseorder->amount->formatted_paid }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.balance')</strong><span>{{ $purchaseorder->amount->formatted_balance }}</span>
        </div>
    </div>
</div>
