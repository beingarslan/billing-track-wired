<div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-sm-down">
    <div class="modal-content">
        <div class="modal-header">
            {{-- float-right is a Bootstrap 4 class and is dead in BS5; a wrapping
                 flex toolbar keeps the title and both actions usable at 320px --}}
            <div class="bt-toolbar w-100">
                <h4 class="modal-title me-auto mb-0">@lang('bt.add_items_from', ['resource_type' => $resource_type . 's'])</h4>
                <button type="button" class="btn btn-secondary" wire:click.prevent="doCancel()"
                        data-bs-dismiss="modal">
                    @lang('bt.cancel')
                </button>
                <button type="button" class="btn btn-primary"
                        wire:click.prevent="addItems()">@lang('bt.submit')</button>
            </div>
        </div>
        @if(class_basename($module) == 'Purchaseorder')
            <div class="modal-header pt-2 pb-1">
                <div class="form-check">
                    <input wire:model="pref_vendor" class="form-check-input" type="checkbox" checked name="pref_vendor"
                           id="pref_vendor">
                    <label class="form-check-label" for="pref_vendor">
                        @lang('bt.vendor_preferred_only', ['vname' => $module->vendor->name])
                    </label>
                </div>
            </div>
        @endif
        <div class="modal-body">
            <div id="modal-status-placeholder"></div>
            <table class="table table-bordered table-striped bt-stack" id="resource-table">
                <thead>
                <tr class="prodheader">
                    <th></th>
                    <th>@lang('bt.name')</th>
                    <th>@lang('bt.description')</th>
                    @if($resource_type == 'Product')
                        <th>@lang('bt.product_numstock')</th>
                    @endif
                    <th>@lang('bt.price')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($resources as $resource)
                    @if(class_basename($resource) == 'Employee')
                        <tr class="prodlist">
                            <td><input wire:model.defer="selected_resources" class="form-check-input" type="checkbox" name="resource_ids[]"
                                       value="{!! $resource->id!!}"></td>
                            @if($resource->driver)
                                <td data-label="@lang('bt.name')" style="color: blue">{!!  $resource->name ?? $resource->short_name !!}</td>
                            @else
                                <td data-label="@lang('bt.name')">{!!  $resource->name ?? $resource->short_name !!}</td>
                            @endif
                            <td data-label="@lang('bt.description')">{!!  $resource->description ?? $resource->title !!}</td>
                            <td data-label="@lang('bt.price')">{!!  $resource->formatted_cost ?? $resource->formatted_price ?? $resource->formatted_billing_rate !!}</td>
                        </tr>
                    @else
                        <tr class="prodlist">
                            <td><input wire:model.defer="selected_resources" class="form-check-input" type="checkbox" name="resource_ids[]"
                                       value="{!! $resource->id!!}"></td>
                            <td data-label="@lang('bt.name')">{!!  $resource->name ?? $resource->short_name !!}</td>
                            <td data-label="@lang('bt.description')">{!!  $resource->description ?? $resource->title !!}</td>
                            @if($resource_type == 'Product')
                                <td data-label="@lang('bt.product_numstock')" @if($resource->is_trackable) class="bg-secondary"
                                    title="@lang('bt.trackable')" @endif>{!!  \BT\Support\NumberFormatter::format($resource->numstock,null,2) ?? 0 !!}</td>
                            @endif
                            @if(class_basename($module) == 'Purchaseorder')
                                <td data-label="@lang('bt.price')">{!!  $resource->formatted_cost  !!}</td>
                            @else
                                <td data-label="@lang('bt.price')">{!!  $resource->formatted_price ?? $resource->formatted_billing_rate !!}</td>
                            @endif
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

