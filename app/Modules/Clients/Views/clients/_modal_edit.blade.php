@include('clients._js_subedit')
{!! Form::model($client, ['route' => ['clients.ajax.modalUpdate', $client->id], 'id' => 'form-edit-client']) !!}
<div class="modal fade" id="modal-edit-client">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title me-auto">@lang('bt.edit_client')</h4>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('bt.cancel')</button>
                    <input type="submit" id="btn-edit-client-submit" class="btn btn-primary" value="@lang('bt.save')">
                </div>
            </div>
            <div class="modal-body">
                <div id="modal-status-placeholder"></div>
                @include('clients._form')
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
