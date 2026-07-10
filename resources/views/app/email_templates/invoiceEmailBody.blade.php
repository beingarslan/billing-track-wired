Hello,

Please see the attached invoice for {{ $invoice->amount->formatted_total }}.

Invoice #{{ $invoice->number }}
Due: {{ $invoice->formatted_due_at }}

View online: {{ $invoice->public_url }}

Thank you!