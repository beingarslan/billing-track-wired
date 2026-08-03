<div id="recent-payments-widget">
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('bt.recent_payments')</h5>
            </div>
            <div class="card-body">
                {{-- The heading row was a bare <tr> of <th> inside <tbody>, so it had no
                     <thead> for .bt-stack to hide. Moved into a real <thead>; every <td>
                     now carries data-label so the row reads as a labelled card below
                     768px instead of a 5-column horizontal scroller. --}}
                <table class="table table-striped bt-stack">
                    <thead>
                    <tr>
                        <th>@lang('bt.client')</th>
                        <th>@lang('bt.date')</th>
                        <th>@lang('bt.invoice')</th>
                        <th>@lang('bt.payment_method')</th>
                        <th>@lang('bt.amount')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($recentPayments as $payment)
                        <tr>
                            <td data-label="@lang('bt.client')">{{ $payment->client->name }}</td>
                            <td data-label="@lang('bt.date')">{!! $payment->formatted_paid_at !!}</td>
                            <td data-label="@lang('bt.invoice')"><a href="{!! url('/invoices') . '/' .  $payment->invoice->id . '/edit' !!}">
                                    {{ $payment->invoice->number }}</a></td>
                            <td data-label="@lang('bt.payment_method')">{!! $payment->paymentMethod->name !!}</td>
                            <td data-label="@lang('bt.amount')">{!! $payment->formatted_amount !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
