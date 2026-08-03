{{-- See client_center/invoices/_table for the rationale: .table-responsive for tablets,
     .bt-stack + data-label to restack rows as cards below 768px. --}}
<div class="table-responsive">
    <table class="table table-hover bt-stack bt-nowrap">
        <thead>
        <tr>
            <th>@lang('bt.date')</th>
            <th>@lang('bt.invoice')</th>
            <th>@lang('bt.summary')</th>
            <th>@lang('bt.amount')</th>
            <th>@lang('bt.payment_method')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($payments as $payment)
            <tr>
                <td data-label="@lang('bt.date')">{{ $payment->formatted_paid_at }}</td>
                <td data-label="@lang('bt.invoice')">{{ $payment->invoice->number }}</td>
                <td data-label="@lang('bt.summary')" class="text-wrap">{{ $payment->invoice->summary }}</td>
                <td data-label="@lang('bt.amount')">{{ $payment->formatted_amount }}</td>
                <td data-label="@lang('bt.payment_method')">{{ $payment->paymentMethod->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
