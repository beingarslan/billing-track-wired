<table class="table table-hover" style="height: 100%;">
    <thead>
    <tr>
        <th>@lang('bt.status')</th>
        <th>@lang('bt.workorder')</th>
        <th>@lang('bt.date')</th>
        <th>@lang('bt.job_date')</th>
        <th>@lang('bt.summary')</th>
        <th style="text-align: right; padding-end: 25px;">@lang('bt.total')</th>
        <th>@lang('bt.invoiced')</th>
        <th>@lang('bt.options')</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($workorders as $workorder)
        <tr id="{!! $workorder->id !!}">
            <td>
                <span class="badge badge-{{ $statuses[$workorder->workorder_status_id] }}">{{ trans('bt.' . $statuses[$workorder->workorder_status_id]) }}</span>
                @if ($workorder->viewed)
                    <span class="badge bg-success">@lang('bt.viewed')</span>
                @else
                    <span class="badge bg-secondary">@lang('bt.not_viewed')</span>
                @endif
            </td>
            <td><a href="{{ route('workorders.edit', [$workorder->id]) }}"
                   title="@lang('bt.edit')">{{ $workorder->number }}</a></td>
            <td>{{ $workorder->formatted_workorder_date }}</td>
            <td>{{ $workorder->formatted_job_date }}</td>
            <td>{{ mb_strimwidth($workorder->summary,0,100,'...') }}</td>
            <td style="text-align: right; padding-end: 25px;">{{ $workorder->amount->formatted_total }}</td>
            <td>
                @if ($workorder->invoice)
                    <a href="{{ route('invoices.edit', [$workorder->invoice_id]) }}">@lang('bt.yes')</a>
                @else
                    @lang('bt.no')
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="dropdown">
                        @lang('bt.options')
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" role="menu">
                        <a class="dropdown-item" href="{{ route('workorders.edit', [$workorder->id]) }}"><i
                                    class="fa fa-edit"></i> @lang('bt.edit')</a>
                        <a class="dropdown-item" href="{{ route('workorders.pdf', [$workorder->id]) }}" target="_blank"
                           id="btn-pdf-workorder"><i
                                    class="fa fa-print"></i> @lang('bt.pdf')</a>
                        <a class="dropdown-item" href="#"
                           onclick="swalConfirm('@lang('bt.trash_record_warning')', '','{{ route('workorders.delete', [$workorder->id]) }}');"><i
                                    class="fa fa-trash-alt text-danger"></i> @lang('bt.trash')</a>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
