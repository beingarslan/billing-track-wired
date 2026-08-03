{{-- See client_center/invoices/_table for the rationale: .table-responsive for tablets,
     .bt-stack + data-label to restack rows as cards below 768px. --}}
<div class="table-responsive">
    <table class="table table-hover bt-stack bt-nowrap">
        <thead>
        <tr>
            <th>@lang('bt.status')</th>
            <th>@lang('bt.workorder')</th>
            <th>@lang('bt.date')</th>
            <th>@lang('bt.expires')</th>
            <th>@lang('bt.summary')</th>
            <th>@lang('bt.total')</th>
            <th>@lang('bt.options')</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($workorders as $workorder)
            <tr>
                <td data-label="@lang('bt.status')">
                    <span class="badge badge-{{ $workorderStatuses[$workorder->workorder_status_id] }}">{{ trans('bt.' . $workorderStatuses[$workorder->workorder_status_id]) }}</span>
                    @if ($workorder->viewed)
                        <span class="badge bg-success">@lang('bt.viewed')</span>
                    @else
                        <span class="badge bg-secondary">@lang('bt.not_viewed')</span>
                    @endif
                </td>
                <td data-label="@lang('bt.workorder')">{{ $workorder->number }}</td>
                <td data-label="@lang('bt.date')">{{ $workorder->formatted_created_at }}</td>
                <td data-label="@lang('bt.expires')">{{ $workorder->formatted_expires_at }}</td>
                <td data-label="@lang('bt.summary')" class="text-wrap">{{ $workorder->summary }}</td>
                <td data-label="@lang('bt.total')">{{ $workorder->amount->formatted_total }}</td>
                <td>
                    {{-- position-static: the .table-responsive wrapper is overflow:auto at EVERY width, which would clip this menu on desktop too --}}
                    <div class="btn-group position-static">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown"
                                aria-expanded="false">
                            @lang('bt.options')
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('clientCenter.public.workorder.pdf', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-print"></i> @lang('bt.pdf')</a>
                            <a class="dropdown-item" href="{{ route('clientCenter.public.workorder.show', [$workorder->url_key]) }}" target="_blank"><i class="fa fa-search"></i> @lang('bt.view')</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
