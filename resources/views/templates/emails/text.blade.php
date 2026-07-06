@if(isset($invoice))
Invoice {{ $invoice->number }}
Balance Due: {{ $invoice->amount->formatted_balance }}
Due Date: {{ $invoice->formatted_due_at }}

{{ $invoice->public_url }}
@elseif(isset($payment))
Payment Receipt - {{ $payment->formatted_paid_at }}
Amount Paid: {{ $payment->formatted_amount }}
Invoice: {{ $payment->invoice->number }}

View Invoice: {{ $payment->invoice->public_url }}
@else
{!! $body !!}
@endif

