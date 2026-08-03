<div id="todays-workorders-widget">
    <section class="content">
        <div class="card ">
            <div class="card-header">
                <h5 class="text-bold mb-0">@lang('bt.todays_workorders')</h5>
            </div>
            <div class="card-body">
                {{-- A stray <tbody> opened before <thead> left an empty phantom tbody in the
                     parsed DOM; removed. bt-stack + data-label restacks the 5 columns into a
                     labelled card per row below 768px instead of a horizontal scroller. --}}
                <table class="table table-striped bt-stack">
                    <thead>
                    <tr>
                        <th>@lang('bt.client')</th>
                        <th>@lang('bt.start_time')</th>
                        <th>@lang('bt.end_time')</th>
                        <th>@lang('bt.will_call')</th>
                        <th>@lang('bt.workorder_link')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($todaysWorkorders as $workorder)
                        <tr id="{!! $workorder->id !!}">
                            <td data-label="@lang('bt.client')">{!! $workorder->client->name !!}</td>
                            <td data-label="@lang('bt.start_time')">{!! $workorder->formatted_start_time !!}</td>
                            <td data-label="@lang('bt.end_time')">{!! $workorder->formatted_end_time !!}</td>
                            <td data-label="@lang('bt.will_call')">{!! ($workorder->will_call == 1 )?'Yes':'No' !!}</td>
                            <td data-label="@lang('bt.workorder_link')"><a href="{!! url('/workorders') . '/' . $workorder->id . '/edit' !!}">
                                    <span class="badge text-bg-success">@lang('bt.link_to_workorder')</span></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
