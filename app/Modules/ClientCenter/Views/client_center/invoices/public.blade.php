@extends('client_center.layouts.public')

@section('javaScript')

    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js"></script>
    {{--    below to use paypal javascript sdk--}}
    {{--    would need to setup controller for onapprove to set the payment in BillingTrack--}}
    {{--    <script src="https://www.paypal.com/sdk/js?client-id={{config('bt.merchant_PayPal_clientId')}}&currency=USD&disable-funding=paylater"></script>--}}
    {{--    <script>--}}
    {{--        paypal.Buttons({--}}
    {{--            style: {--}}
    {{--                layout:  'horizontal',--}}
    {{--                color:   'gold',--}}
    {{--                shape:   'rect',--}}
    {{--                label:   'pay',--}}
    {{--                tagline: false,--}}
    {{--                height: 37--}}
    {{--            },--}}
    {{--            // Sets up the transaction when a payment button is clicked--}}
    {{--            createOrder: function(data, actions) {--}}
    {{--                return actions.order.create({--}}
    {{--                    purchase_units: [{--}}
    {{--                        amount: {--}}
    {{--                            currency_code: '{{$invoice->currency_code}}',--}}
    {{--                            value: {{$invoice->amount->balance + 0}} // Can reference variables or functions. Example: `value: document.getElementById('...').value`--}}
    {{--                        },--}}
    {{--                    }]--}}
    {{--                });--}}
    {{--            },--}}

    {{--            // Finalize the transaction after payer approval--}}
    {{--            onApprove: function(data, actions) {--}}
    {{--                return actions.order.capture().then(function(orderData) {--}}
    {{--                    // Successful capture! For dev/demo purposes:--}}
    {{--                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));--}}
    {{--                    var transaction = orderData.purchase_units[0].payments.captures[0];--}}
    {{--                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');--}}

    {{--                    // When ready to go live, remove the alert and show a success message within this page. For example:--}}
    {{--                    // var element = document.getElementById('paypal-button-container');--}}
    {{--                    // element.innerHTML = '';--}}
    {{--                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';--}}
    {{--                    // Or go to another URL:  actions.redirect('thank_you.html');--}}
    {{--                });--}}
    {{--            }--}}
    {{--        }).render('#paypal-button-container');--}}

    {{--    </script>--}}

    <script type="text/javascript">
        ready(function () {
            document.getElementById('view-notes').style.display = 'none'
            // e.target is the <i> glyph whenever the icon itself is tapped (very common on a
            // phone), and an <i> has no dataset.buttonToggle - the toggle silently died and
            // the wrong element got display:none. Resolve the button with closest().
            addEvent(document, 'click', ".btn-notes", (e) => {
                const btn = e.target.closest('.btn-notes')
                document.getElementById('view-doc').toggleid()
                document.getElementById('view-notes').toggleid()
                document.querySelectorAll('.btn-pay').forEach((item) => {
                    if (item.style.display === 'none') {
                        item.style.display = 'block'
                    }else{
                        item.style.display = 'none'
                    }
                });
                document.getElementById(btn.dataset.buttonToggle).style.display = 'block'
                btn.style.display = 'none'
            });

            document.querySelectorAll('.btn-pay').forEach((payBtn) => {
                payBtn.addEventListener('click', (e) => {
                    const btn = e.target.closest('.btn-pay')
                    btn.innerHTML = 'loading'

                    axios.post("{{ route('merchant.pay') }}", {
                        driver: btn.dataset.driver,
                        urlKey: '{{ $invoice->url_key }}'
                    }).then(function (response) {
                        if (response.data.redirect === 1) {
                            window.location = response.data.url;
                        } else {
                            setInnerHTML(document.getElementById('modal-placeholder'), response.data.modalContent)
                        }
                    });
                });
            })
        })
    </script>
@stop

@section('content')
    <section class="content">
        <div class="public-wrapper">
            @include('layouts._alerts')
            {{-- flex-wrap + gap: without it the PDF/Notes/Attachments/Pay buttons were squeezed
                 onto one line at 375px and the Pay button - the point of this page - became a
                 sliver. Each direct .btn/.btn-group also goes full width below 576px. --}}
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-evenly gap-2 mb-3">
                <a href="{{ route('clientCenter.public.invoice.pdf', [$invoice->url_key]) }}" target="_blank"
                   class="btn btn-primary"><i class="fa fa-print"></i> <span>@lang('bt.pdf')</span>
                </a>
                @if (auth()->check())
                    <div class="btn-group">
                        <button id="btn-notes" data-button-toggle="btn-notes-back" class="btn btn-primary btn-notes">
                            <i class="fa fa-comments"></i> @lang('bt.notes')
                        </button>
                        <button id="btn-notes-back" data-button-toggle="btn-notes" class="btn btn-primary btn-notes"
                                style="display: none;">
                            <i class="fa fa-backward"></i> @lang('bt.back_to_invoice')
                        </button>
                    </div>
                @endif
                @if (count($attachments))
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-bs-toggle="dropdown">
                            <i class="fa fa-files-o"></i> @lang('bt.attachments')
                        </button>
                        <ul class="dropdown-menu">
                            @foreach ($attachments as $attachment)
                                <li><a href="{{ $attachment->download_url }}">{{ $attachment->filename }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($invoice->isPayable)
                    @foreach ($merchantDrivers as $driver)
                        {{-- bt-fluid-sm: the <form> is the flex item, so without it the
                             full-width Pay button inside would shrink-to-fit the form. --}}
                        <form action="{{ route('clientCenter.public.invoice.pay', ['invoiceKey' => $urlKey])}}" method="POST"
                              class="bt-fluid-sm">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-pay"
                                data-driver="{{ $driver->getName() }}" data-loading-text="@lang('bt.please_wait')">
                                <i class="fa fa-credit-card"></i> {{ $driver->getSetting('paymentButtonText') }}
                            </button>
                        </form>
                    @endforeach
                @endif
            </div>
            <div class="public-doc-wrapper">
                <div id="view-doc">
                    <iframe src="{{ route('clientCenter.public.invoice.html', [$urlKey]) }}"
                            title="@lang('bt.invoice')"
                            style="width: 100%;" onload="resizeIframe(this, 800);"></iframe>
                </div>
                @if (auth()->check())
                    <div id="view-notes">
                        @include('notes._notes', ['object' => $invoice, 'model' => 'BT\Modules\Invoices\Models\Invoice'])
                    </div>
                @endif
            </div>
        </div>
    </section>
@stop
