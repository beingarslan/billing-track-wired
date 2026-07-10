Hello,

This is a friendly reminder that invoice #{{ $invoice->number }} is now overdue.

Amount Due: {{ $invoice->amount->formatted_balance }}
Was Due: {{ $invoice->formatted_due_at }}

Please settle this invoice at your earliest convenience.

View and pay online: {{ $invoice->public_url }}

Thank you!