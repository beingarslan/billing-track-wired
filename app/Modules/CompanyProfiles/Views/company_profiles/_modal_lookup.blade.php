@include('company_profiles._js_subchange')

<div class="modal fade" id="modal-lookup-company-profile">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang('bt.change_company_profile')</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="modal-status-placeholder"></div>
                <form>
                    <div class="mb-3 bt-stack-row">
                        <label class="form-label col-sm-4 col-form-label" for="change_company_profile_id">@lang('bt.company_profile')</label>
                        <div class="col-sm-8">
                            {!! Form::select('change_company_profile_id', $companyProfiles, null, ['id' => 'change_company_profile_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('bt.cancel')</button>
                <button type="button" id="btn-submit-change-company-profile" class="btn btn-primary">@lang('bt.save')
                </button>
            </div>
        </div>
    </div>
</div>
