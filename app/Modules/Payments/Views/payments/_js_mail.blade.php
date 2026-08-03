<script type="text/javascript">
    ready(function () {
        let attachPdf = 0;
        var tsconfig = {
            // the modal body scrolls on small screens, which would clip an
            // absolutely positioned dropdown - render it at body level instead
            dropdownParent: 'body',
            plugins: {
                remove_button: {
                    title: 'Remove this item',
                }
            },
        };

        const modal = bsModal('modal-mail-payment')
        modal.show()
        modaleL = document.getElementById('modal-mail-payment')
        modaleL.addEventListener('shown.bs.modal', function () {
            new TomSelect('#to', tsconfig);
            new TomSelect('#cc', tsconfig);
            new TomSelect('#bcc', tsconfig);
        });

        document.getElementById('btn-submit-mail-payment').addEventListener('click', (e) =>{
            const btn = e.target
            btn.innerHTML = 'Sending'

            if (document.getElementById('attach_pdf').checked === true) {
                attachPdf = 1;
            }

            let to = document.getElementById('to')
            let cc = document.getElementById('cc')
            let bcc = document.getElementById('bcc')

            axios.post('{{ route('payments.paymentMail.store') }}', {
                payment_id: {{ $paymentId }},
                to: to.tomselect.getValue(),
                cc: cc.tomselect.getValue(),
                bcc: bcc.tomselect.getValue(),
                subject: document.getElementById('subject').value,
                body: document.getElementById('body').value,
                attach_pdf: attachPdf
            }).then(function (response) {
                const statusEl = document.getElementById('modal-status-placeholder')
                statusEl.innerHTML = '<div class="alert alert-success">' + '@lang('bt.sent')' + '</div>'
                // #modal-status-placeholder sits at the TOP of a .modal-body that
                // scrolls on a phone, while Send lives in the sticky footer - so the
                // confirmation rendered ~500px above the fold and was never seen
                // before the redirect below fired.
                statusEl.scrollIntoView({block: 'nearest'})
                setTimeout("window.location='" + decodeURIComponent('{{ $redirectTo }}') + "'", 1000);
            }).catch(function (error) {
                btn.innerHTML = 'Fail'
                showErrors(error.response.data.errors);
            });
        });
    });
</script>
