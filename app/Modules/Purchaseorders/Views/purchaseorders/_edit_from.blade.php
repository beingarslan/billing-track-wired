@include('purchaseorders._js_edit_from')
<div class="row">
    <div class="col-12 col-md-6">
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
                <strong>{{ $purchaseorder->companyProfile->company }}</strong><br>
                {!! $purchaseorder->companyProfile->formatted_address !!}<br>
                @lang('bt.phone'): {{ $purchaseorder->companyProfile->phone }}<br>
                @lang('bt.email'): {{ $purchaseorder->companyProfile->email }}
                @if ($purchaseorder->companyProfile->vat_number)<br>@lang('bt.vat_number'): {{ $purchaseorder->companyProfile->vat_number }}@endif
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">@lang('bt.ship_to')</h3>
            </div>
            <div class="card-body">
                <strong>{{ $purchaseorder->companyProfile->company }}</strong><br>
                @if($purchaseorder->companyProfile->formatted_address2)
                    {!! $purchaseorder->companyProfile->formatted_address2 !!}
                @else
                    {!! $purchaseorder->companyProfile->formatted_address !!}<br>
                @endif<br>
                @lang('bt.phone'): {{ $purchaseorder->companyProfile->phone }}<br>
                {{--            @lang('bt.email'): {{ $purchaseorder->companyProfile->email }}--}}
            </div>
        </div>
    </div>
</div>
