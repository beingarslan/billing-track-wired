<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="d-flex justify-content-between gap-2">
            <span><strong>@lang('bt.unbilled_hours')</strong></span>
            <span>{{ $project->unbilled_hours }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <span><strong>@lang('bt.billed_hours')</strong></span>
            <span>{{ $project->billed_hours }}</span>
        </div>
        <div class="d-flex justify-content-between gap-2">
            <span><strong>@lang('bt.total_hours')</strong></span>
            <span>{{ $project->hours }}</span>
        </div>
    </div>
</div>
