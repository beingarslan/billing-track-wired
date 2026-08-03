<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.subtotal')</strong><span>{{ $quote->amount->formatted_subtotal }}</span>
        </div>
        @if ($quote->discount > 0)
            <div class="d-flex justify-content-between gap-2">
                <strong>@lang('bt.discount')</strong><span>{{ $quote->amount->formatted_discount }}</span>
            </div>
        @endif
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.tax')</strong><span>{{ $quote->amount->formatted_tax }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <strong>@lang('bt.total')</strong><span>{{ $quote->amount->formatted_total }}</span>
        </div>
    </div>
</div>
