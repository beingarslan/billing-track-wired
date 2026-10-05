@include('quotes._js_edit_to')
<div class="card card-outline card-primary">
    <div class="card-header d-flex flex-wrap align-items-center gap-2">
        <h3 class="card-title float-none mb-0 me-auto">@lang('bt.to')</h3>
        <div class="card-tools float-none d-flex flex-wrap gap-2 m-0">
            <button class="btn btn-secondary btn-sm"
                    {{--                                     params 3 thru ...> mount(,,$modulefullname, $module_id = null, $search_type)--}}
                    onclick="window.livewire.emit('showModal', 'modals.search-modal', '{{  addslashes(get_class($quote)) }}', {{$quote->id}}, 'client')"
            ><i class="fa fa-exchange-alt"></i> @lang('bt.change')</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-client" data-client-id="{{ $quote->client_id }}"><i
                        class="fa fa-pencil-alt"></i> @lang('bt.edit')</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $quote->client->name }}</strong><br>
        {!! $quote->client->formatted_address !!}<br>
        @lang('bt.phone'): {{ $quote->client->phone }}<br>
        @lang('bt.email'): {{ $quote->client->email }}
        @if ($quote->client->vat_number)<br>@lang('bt.vat_number'): {{ $quote->client->vat_number }}@endif
    </div>
</div>
