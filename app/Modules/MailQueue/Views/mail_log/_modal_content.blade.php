<script type="text/javascript">
    ready(function () {
        const modal = bsModal('modal-mail-content')
        modal.show()
    });
</script>

<div class="modal fade" id="modal-mail-content">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ $mail->subject }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                {{-- The stored mail body is full email HTML and usually contains a fixed-width
                     table, so it scrolls inside itself rather than widening the dialog. --}}
                <div class="bt-scroll-x">
                    {!! $mail->body !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('bt.close')</button>
            </div>
        </div>
    </div>
</div>
