@include('invoices._js_edit_to')
<div class="card card-outline card-primary">
    <div class="card-header bt-toolbar">
        <h3 class="card-title me-auto">@lang('bt.to')</h3>
        <div class="card-tools d-flex flex-wrap gap-2">
            <button class="btn btn-secondary btn-sm"
                    {{--                                     params 3 thru ...> mount(,,$modulefullname, $module_id = null, $search_type)--}}
                    onclick="window.livewire.emit('showModal', 'modals.search-modal', '{{  addslashes(get_class($invoice)) }}', {{$invoice->id}}, 'client')"
            ><i class="fa fa-exchange-alt"></i>  @lang('bt.change')</button>
            <button class="btn btn-secondary btn-sm" id="btn-edit-client" data-client-id="{{ $invoice->client_id }}"><i
                    class="fa fa-pencil-alt"></i> @lang('bt.edit')</button>
        </div>
    </div>
    <div class="card-body">
        <strong>{{ $invoice->client->name }}</strong><br>
        {!! $invoice->client->formatted_address !!}<br>
        @lang('bt.phone'): {{ $invoice->client->phone }}<br>
        @lang('bt.email'): {{ $invoice->client->email }}
        @if ($invoice->client->vat_number)<br>@lang('bt.vat_number'): {{ $invoice->client->vat_number }}@endif
    </div>
</div>
