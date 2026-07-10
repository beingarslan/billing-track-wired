Hello,

Thank you for your payment of {{ $payment->formatted_amount }}.

Invoice #{{ $payment->invoice->number }}
Paid: {{ $payment->formatted_paid_at }}

View invoice: {{ $payment->invoice->public_url }}

Thank you for your business!