<link rel="stylesheet" href="{{ asset('plugins/tom-select/css/tom-select.bootstrap5.min.css') }}">
<script src="{{ asset('plugins/tom-select/js/tom-select.complete.min.js') }}" type="text/javascript"></script>
@include('invoices._js_mail')
<div class="modal fade" id="modal-mail-invoice">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.email_invoice')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="@lang('bt.cancel')"></button>
            </div>
            <div class="modal-body">
                <div id="modal-status-placeholder"></div>
                <form>
                    <div class="row mb-3 align-items-center">
                        <label for="to" class="col-12 col-sm-2 col-form-label fw-bold text-sm-end">@lang('bt.to')</label>
                        <div class="col-12 col-sm-10">
                            {!! $contactDropdownTo !!}
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="cc" class="col-12 col-sm-2 col-form-label fw-bold text-sm-end">@lang('bt.cc')</label>
                        <div class="col-12 col-sm-10">
                            {!! $contactDropdownCc !!}
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="bcc" class="col-12 col-sm-2 col-form-label fw-bold text-sm-end">@lang('bt.bcc')</label>
                        <div class="col-12 col-sm-10">
                            {!! $contactDropdownBcc !!}
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <label for="subject" class="col-12 col-sm-2 col-form-label fw-bold text-sm-end">@lang('bt.subject')</label>
                        <div class="col-12 col-sm-10">
                            {!! Form::text('subject', $subject, ['id' => 'subject', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="body" class="col-12 col-sm-2 col-form-label fw-bold text-sm-end">@lang('bt.body')</label>
                        <div class="col-12 col-sm-10">
                            {!! Form::textarea('body', $body, ['id' => 'body', 'class' => 'form-control', 'rows' => 6]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-10 offset-sm-2">
                            <div class="form-check form-switch form-switch-md">
                                {{ Form::checkbox('attach_pdf', 1, config('bt.attachPdf'), ['id' => 'attach_pdf', 'class' => 'form-check-input']) }}
                                {{ Form::label('attach_pdflabel', trans('bt.attach_pdf'), ['class' => 'form-check-label fw-bold ps-3 pt-1', 'for' => 'attach_pdf']) }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="btn-submit-mail-invoice" class="btn btn-primary"
                        data-loading-text="@lang('bt.sending')...">@lang('bt.send')</button>
            </div>
        </div>
    </div>
</div>
