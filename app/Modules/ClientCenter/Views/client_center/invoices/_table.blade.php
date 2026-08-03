{{-- .table-responsive keeps the 8 columns off the page axis on tablets; .bt-stack restacks
     each row as a labelled card below 768px so a client can read an invoice on a phone
     without any horizontal scrolling. Every <td> therefore needs data-label, except the
     action column, which .bt-stack renders right-aligned with no label. --}}
<div class="table-responsive">
    <table class="table table-hover bt-stack bt-nowrap">
        <thead>
        <tr>
            <th>@lang('bt.status')</th>
            <th>@lang('bt.invoice')</th>
            <th>@lang('bt.date')</th>
            <th>@lang('bt.due')</th>
            <th>@lang('bt.summary')</th>
            <th>@lang('bt.total')</th>
            <th>@lang('bt.balance')</th>
            <th>@lang('bt.options')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invoices as $invoice)
            <tr>
                <td data-label="@lang('bt.status')">
                    <span class="badge badge-{{ $invoiceStatuses[$invoice->invoice_status_id] }}">{{ trans('bt.' . $invoiceStatuses[$invoice->invoice_status_id]) }}</span>
                    @if ($invoice->viewed)
                        <span class="badge bg-success">@lang('bt.viewed')</span>
                    @else
                        <span class="badge bg-secondary">@lang('bt.not_viewed')</span>
                    @endif
                </td>
                <td data-label="@lang('bt.invoice')">{{ $invoice->number }}</td>
                <td data-label="@lang('bt.date')">{{ $invoice->formatted_created_at }}</td>
                <td data-label="@lang('bt.due')">{{ $invoice->formatted_due_at }}</td>
                <td data-label="@lang('bt.summary')" class="text-wrap">{{ $invoice->summary }}</td>
                <td data-label="@lang('bt.total')">{{ $invoice->amount->formatted_total }}</td>
                <td data-label="@lang('bt.balance')">{{ $invoice->amount->formatted_balance }}</td>
                <td>
                    {{-- position-static: the .table-responsive wrapper is overflow:auto at EVERY width, which would clip this menu on desktop too --}}
                    <div class="btn-group position-static">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            @lang('bt.options')
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                            <a class="dropdown-item" href="{{ route('clientCenter.public.invoice.show', [$invoice->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('bt.view')</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
