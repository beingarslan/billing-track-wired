<div class="row">
    <div class="col-sm-12 table-responsive" style="overflow-x: visible;">
        <div class="card card-outline card-primary">
            <div class="card-header bg-secondary-subtle">
                {{-- flex toolbar instead of the AdminLTE card-title/card-tools float pair,
                     which collides at phone widths and would also turn this card-header
                     into a flex container around the table --}}
                <div class="bt-toolbar mb-2">
                    <h3 class="card-title fw-bold mb-0 me-auto">@lang('bt.add_item')</h3>
                    <button class="btn btn-primary btn-sm"
                            {{--                                     params 3 thru ...> mount(,,$modulefullname, $module_id = null, $resource_type)--}}
                            onclick="window.livewire.emit('showModal', 'modals.add-resource-modal', '{{  addslashes(get_class($module)) }}', {{$module->id}}, 'Product')">
                        <i class="fa fa-plus"></i> @lang('bt.add_product')</button>
                    @if($module_type != 'Purchaseorder')
                    <button class="btn btn-primary btn-sm"
                            {{--                                     params 3 thru ...> mount(,,$modulefullname, $module_id = null, $resource_type)--}}
                            onclick="window.livewire.emit('showModal', 'modals.add-resource-modal', '{{  addslashes(get_class($module)) }}', {{$module->id}}, 'Employee')">
                        <i class="fa fa-plus"></i> @lang('bt.add_employee')</button>
                    <button class="btn btn-primary btn-sm"
                            {{--                                     params 3 thru ...> mount(,,$modulefullname, $module_id = null, $resource_type)--}}
                            onclick="window.livewire.emit('showModal', 'modals.add-resource-modal', '{{  addslashes(get_class($module)) }}', {{$module->id}}, 'ItemLookup')">
                        <i class="fa fa-plus"></i> @lang('bt.add_lookup')</button>
                        @endif
                </div>
                {{-- bt-stack + data-label on every td: ONE layout that is a table on
                     desktop and a labelled card per row on phones. No duplicated
                     markup, so every wire:model stays bound to exactly one input. --}}
                <table id="new-item-table" class="table table-hover m-0 bt-stack">
                    <thead>
                    <tr>
                        <th style="width: 20%;">@lang('bt.product')</th>
                        <th style="width: 25%;">@lang('bt.description')</th>
                        <th style="width: 10%;">@lang('bt.qty')</th>
                        <th style="width: 10%;">@lang('bt.price')</th>
                        <th style="width: 10%;">@lang('bt.tax_1')</th>
                        <th style="width: 10%;">@lang('bt.tax_2')</th>
                        <th class="text-end pe-4" style="width: 10%;">@lang('bt.action')</th>
                        <th style="width: 4%;"></th>
                    </tr>
                    </thead>
                    <tbody id="new-tbody">
                    <tr class="todo-list new-item" id="tr-new-item">
                        <td data-label="@lang('bt.product')" style="width: 20%;">
                            @if($module_type == 'Purchaseorder')
                            <livewire:product-search
                                    {{--module base name, adds hidden fields with _id and _name--}}
                                    wire:onload="$emit('refreshSearch', ['searchTerm' => null, 'value' => null, 'description' => null, 'optionsValues' => null]);"
                                    name="product"
                                    value=""
                                    description=""
                                    placeholder="{{ __('bt.placeholder_product_select') }}"
                                    searchable="true"
                                    noResultsMessage="{{  __('bt.no_results_product') }}"
                            />
                            @else
                                <livewire:item-lookup-search
                                        {{--module base name, adds hidden fields with _id and _name--}}
                                        wire:onload="$emit('refreshSearch', ['searchTerm' => null, 'value' => null, 'description' => null, 'optionsValues' => null]);"
                                        name="itemLookup"
                                        value=""
                                        description=""
                                        placeholder="{{ __('bt.placeholder_lookup_select') }}"
                                        searchable="true"
                                        noResultsMessage="{{  __('bt.no_results_product') }}"
                                />
                            @endif
                            @error('new_item.name') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                            @if(!$resource_id)
                                <div class="form-check mt-2">
                                    <input wire:model="save_item_as"
                                           class="form-check-input"
                                           type="checkbox"
                                           name="save_item_as"
                                           id="save_item_as"
                                           tabindex="999">
                                    <label class="form-check-label" for="save_item_as">
                                        @if($module_type == 'Purchaseorder')
                                            @lang('bt.save_item_as_product')
                                        @else
                                            @lang('bt.save_item_as_lookup')
                                        @endif
                                    </label>
                                </div>
                            @endif
                        </td>
                        <td data-label="@lang('bt.description')">{!! Form::textarea('new-description', null, ['wire:model.defer' => 'new_item.description', 'class' => 'form-control', 'rows' => 1]) !!}
                            @error('new_item.description') <span
                                    class="text-sm text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td data-label="@lang('bt.qty')">{!! Form::text('new-quantity', null, ['wire:model.defer' => 'new_item.quantity', 'class' => 'form-control']) !!}
                            @error('new_item.quantity') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td data-label="@lang('bt.price')">{!! Form::text('new-price', null, ['wire:model.defer' => 'new_item.price', 'class' => 'form-control']) !!}
                            @error('new_item.price') <span class="text-sm text-danger">{{ $message }}</span> @enderror
                        </td>
                        <td data-label="@lang('bt.tax_1')">{!! Form::select('new-tax_rate_id', $taxRates, null, ['wire:model.defer' => 'new_item.tax_rate_id', 'class' => 'form-select']) !!}</td>
                        <td data-label="@lang('bt.tax_2')">{!! Form::select('new-tax_rate_2_id', $taxRates, null, ['wire:model.defer' => 'new_item.tax_rate_2_id', 'class' => 'form-select']) !!}</td>
                        <td class="text-nowrap text-end">
                            <button class="btn btn-sm btn-warning me-2"
                                    wire:click="clearItem()"
                                    title="@lang('bt.clear')">
                                <i class="fa fa-times"></i>
                            </button>
                            <button class="btn btn-sm btn-success"
                                    wire:click="addItem()"
                                    title="@lang('bt.add')">
                                <i class="fa fa-plus"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body">
                <div class="row">
                <span class="card-title fw-bold border border-5">@lang('bt.items')</span>
                </div>
                <table id="item-table" class="table table-hover bt-stack">
                    <thead>
                    <tr>
                        <th style="width: 1%;"></th>
                        <th style="width: 20%;">@lang('bt.product')</th>
                        <th style="width: 25%;">@lang('bt.description')</th>
                        <th style="width: 10%;">@lang('bt.qty')</th>
                        <th style="width: 10%;">@lang('bt.price')</th>
                        <th style="width: 10%;">@lang('bt.tax_1')</th>
                        <th style="width: 10%;">@lang('bt.tax_2')</th>
                        <th class="text-end pe-4" style="width: 10%;">@lang('bt.total')</th>
                        <th style="width: 4%;"></th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @foreach ($module_items as $index => $item)
                        <tr wire:key="tr-item-{{ $loop->index }}" class="todo-list item" id="tr-item-{{ $item->id }}">
                            {!! Form::hidden($module_id_type, $module->id) !!}
                            {!! Form::hidden('resource_id', $item->resource_id ?? null) !!}
                            {!! Form::hidden('resource_table', $item->resource_table ?? null) !!}
                            {!! Form::hidden('resource_name', $item->resource_name ?? null) !!}
                            <input type="hidden" name="id" value="{{$item->id ?? null}}"/>
                            <td class="text-center"><i class="fas fa-arrows-alt-v handle bt-tap"></i></td>
                            <td data-label="@lang('bt.product')">
                                <input wire:model="module_items.{{$index}}.name" name="name"
                                       class="form-control item-lookup" readonly>
                            </td>
                            <td data-label="@lang('bt.description')"><textarea name="description" rows="1" cols="50" class="form-control"
                                        {{($readonly) ? 'readonly' : ''}}>{{$item->description}}</textarea></td>
                            @if(isset($item->product->numstock) && $item->product->numstock < 0 && $item->resource_table == 'products')
                                <td data-label="@lang('bt.qty')">{!! Form::text('quantity', $item->quantity, ['class' => 'form-control', 'style' => 'background-color:yellow', 'title' => trans('bt.negative_stock')]) !!}</td>
                            @else
                            <td data-label="@lang('bt.qty')">{!! Form::text('quantity', $item->quantity, ['class' => 'form-control']) !!}</td>
                            @endif
                            <td data-label="@lang('bt.price')">{!! Form::text('price', $item->price ?? $item->cost, ['class' => 'form-control']) !!}</td>
                            <td data-label="@lang('bt.tax_1')">{!! Form::select('tax_rate_id', $taxRates, $item->tax_rate_id, ['class' => 'form-select']) !!}</td>
                            <td data-label="@lang('bt.tax_2')">{!! Form::select('tax_rate_2_id', $taxRates, $item->tax_rate_2_id, ['class' => 'form-select']) !!}</td>
                            <td class="text-end pe-4" data-label="@lang('bt.total')">{{ $item->amount->formatted_subtotal ?? null}}</td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-danger"
                                        wire:click="removeItem({{$index}})"
                                        title="@lang('bt.trash')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
