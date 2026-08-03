@include('quotes._js_edit_from')
<div class="card card-outline card-primary">
    <div class="card-header d-flex flex-wrap align-items-center gap-2">
        <h3 class="card-title float-none mb-0 me-auto">@lang('bt.from')</h3>
        <div class="card-tools float-none d-flex flex-wrap gap-2 m-0">
            <button class="btn btn-secondary btn-sm" id="btn-change-company-profile">
                <i class="fa fa-exchange-alt"></i> @lang('bt.change')
            </button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $quote->companyProfile->company }}</strong><br>
        {!! $quote->companyProfile->formatted_address !!}<br>
        @lang('bt.phone'): {{ $quote->companyProfile->phone }}<br>
        @lang('bt.email'): {{ $quote->companyProfile->email }}
    </div>
</div>
