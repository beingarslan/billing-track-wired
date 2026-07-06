@php
    // Colour the status badge based on the invoice status. Keyed off the
    // status_text string you already expose, so it never depends on a
    // status_id mapping and always falls back to a neutral badge.
    $statusRaw = strtolower(trim((string) ($invoice->status_text ?? '')));
    if (str_contains($statusRaw, 'paid')) {
        $badgeBg = '#E7F4EE'; $badgeFg = '#1F7A5C';          // paid  -> green
    } elseif (str_contains($statusRaw, 'overdue')) {
        $badgeBg = '#FBEAE8'; $badgeFg = '#C0392B';          // overdue -> red
    } elseif (str_contains($statusRaw, 'partial')) {
        $badgeBg = '#FBF1E0'; $badgeFg = '#B4791E';          // partial -> amber
    } elseif (str_contains($statusRaw, 'sent') || str_contains($statusRaw, 'view')) {
        $badgeBg = '#E8EEFB'; $badgeFg = '#3B5BC0';          // sent/viewed -> blue
    } else {
        $badgeBg = '#F0F1F4'; $badgeFg = '#6E7180';          // draft / other -> neutral
    }
@endphp
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="x-apple-disable-message-reformatting">
  <meta name="color-scheme" content="light dark">
  <meta name="supported-color-schemes" content="light dark">
  <meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
  <title>Invoice {!! $invoice->number !!}</title>

  <!--[if mso]>
  <noscript><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml></noscript>
  <![endif]-->

  <style>
    /* ---- Client resets ---- */
    html, body { margin:0 !important; padding:0 !important; height:100% !important; width:100% !important; }
    * { -ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; }
    table, td { mso-table-lspace:0pt; mso-table-rspace:0pt; border-collapse:collapse; }
    img { -ms-interpolation-mode:bicubic; border:0; height:auto; line-height:100%; outline:none; text-decoration:none; }
    a { text-decoration:none; }

    /* ---- Hover (ignored by Outlook, enhancement only) ---- */
    .btn:hover { background:#2A2D40 !important; }
    .txt-link:hover { text-decoration:underline !important; }

    /* ---- Responsive ---- */
    @media only screen and (max-width:620px) {
      .container { width:100% !important; }
      .px { padding-left:24px !important; padding-right:24px !important; }
      .btn-wrap, .btn { width:100% !important; }
      .amount-figure { font-size:38px !important; }
    }

    /* ---- Dark mode (progressive; safe fallbacks) ---- */
    @media (prefers-color-scheme: dark) {
      .bg-canvas { background:#0E0F16 !important; }
      .bg-paper  { background:#181A24 !important; }
      .brd-card  { border-color:#2A2C38 !important; }
      .t-ink     { color:#F3F4F8 !important; }
      .t-soft    { color:#C3C6D4 !important; }
      .t-muted   { color:#9498A8 !important; }
      .brd-line  { border-color:#2A2C38 !important; }
      .panel     { background:#14251F !important; }
    }
    [data-ogsc] .bg-canvas { background:#0E0F16 !important; }
    [data-ogsc] .bg-paper  { background:#181A24 !important; }
    [data-ogsc] .t-ink     { color:#F3F4F8 !important; }
    [data-ogsc] .t-soft    { color:#C3C6D4 !important; }
    [data-ogsc] .t-muted   { color:#9498A8 !important; }
  </style>
</head>

<body class="bg-canvas" style="margin:0; padding:0; background:#EEEFF3; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">

  <!-- Preheader: inbox preview text, hidden in the body -->
  <div style="display:none; max-height:0; overflow:hidden; mso-hide:all; font-size:1px; line-height:1px; color:#EEEFF3; opacity:0;">
    Invoice {!! $invoice->number !!} · Balance due {!! $invoice->amount->formatted_balance !!}

  </div>

  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="bg-canvas" style="background:#EEEFF3;">
    <tr>
      <td align="center" style="padding:32px 12px;">

        <!--[if mso | IE]>
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td>
        <![endif]-->

        <!-- ===== Card ===== -->
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" class="container bg-paper brd-card"
               style="width:600px; max-width:600px; background:#FFFFFF; border:1px solid #E6E7EC; border-radius:14px;">

          <!-- Header / logo -->
          <tr>
            <td class="px" style="padding:26px 40px 22px 40px; border-bottom:1px solid #E6E7EC;" align="center">
              <!-- Logo. Change `width` to taste — height is auto, so the aspect ratio is preserved.
                   The white chip keeps the logo legible in dark mode; delete the wrapping <span> if your
                   logo already reads well on dark. If your model exposes a logo field, swap the hardcoded
                   src for a dynamic one, e.g. {!! $invoice->companyProfile->logo_url !!}. -->
              <span style="display:inline-block; background:#FFFFFF; border-radius:10px; padding:8px 14px; line-height:0;">
                <img src="https://coduko.com/image/FinalCoduko-05.png"
                     alt="{!! $invoice->companyProfile->company !!}"
                     width="150"
                     style="display:block; width:150px; max-width:150px; height:auto; border:0; outline:none; text-decoration:none;">
              </span>
            </td>
          </tr>

          <!-- Hero -->
          <tr>
            <td class="px" style="padding:34px 40px 8px 40px;">
              <div class="t-muted" style="font-size:12px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; color:#8A8D9C;">
                Invoice · {!! $invoice->number !!}
              </div>
              <div class="t-ink" style="margin-top:10px; font-size:27px; line-height:1.25; font-weight:700; letter-spacing:-0.5px; color:#1B1D2A;">
                Your invoice is ready
              </div>
            </td>
          </tr>

          <!-- Greeting + intro -->
          <tr>
            <td class="px t-soft" style="padding:16px 40px 4px 40px; font-size:15px; line-height:1.65; color:#4A4D60;">
              Dear <strong style="color:inherit;">{!! $invoice->client->name !!}</strong>,<br><br>
              Thank you for your continued partnership. The details of your latest invoice are below — you can review the full invoice or make a payment at any time using the button.
            </td>
          </tr>

          <!-- Summary / description (only shows when present) -->
          @if(!empty($invoice->summary))
          <tr>
            <td class="px" style="padding:18px 40px 0 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #EDEEF2; border-radius:8px;">
                <tr>
                  <td style="padding:14px 16px;">
                    <div class="t-muted" style="font-size:11px; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#8A8D9C; padding-bottom:5px;">Summary</div>
                    <div class="t-soft" style="font-size:14px; line-height:1.55; color:#4A4D60;">{!! $invoice->summary !!}</div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          @endif

          <!-- ===== Amount due panel ===== -->
          <tr>
            <td class="px" style="padding:24px 40px 4px 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" class="panel"
                     style="background:#F1F7F4; border-radius:10px;">
                <tr>
                  <td style="padding:20px 22px; border-left:4px solid #1F7A5C; border-radius:10px;">
                    <div style="font-size:11px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; color:#1F7A5C;">
                      Amount due
                    </div>
                    <div class="t-ink amount-figure" style="margin-top:6px; font-size:44px; line-height:1; font-weight:700; letter-spacing:-1px; color:#1B1D2A;">
                      {!! $invoice->amount->formatted_balance !!}
                    </div>
                    <div class="t-muted" style="margin-top:12px; font-size:13px; color:#6E7180;">
                      Due {!! $invoice->formatted_due_at !!}  ·
                      <span style="display:inline-block; padding:3px 9px; border-radius:20px; background:{!! $badgeBg !!}; color:{!! $badgeFg !!}; font-size:11px; font-weight:700; letter-spacing:0.4px; text-transform:uppercase;">{!! $invoice->status_text !!}</span>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ===== CTA button (bulletproof / VML for Outlook) ===== -->
          <tr>
            <td class="px" style="padding:26px 40px 8px 40px;" align="center">
              <table role="presentation" cellpadding="0" cellspacing="0" border="0" class="btn-wrap" style="margin:0 auto;">
                <tr>
                  <td align="center" style="border-radius:8px;">
                    <!--[if mso]>
                    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word"
                                 href="{!! $invoice->public_url !!}"
                                 style="height:52px; v-text-anchor:middle; width:260px;" arcsize="15%" strokecolor="#1B1D2A" fillcolor="#1B1D2A">
                      <w:anchorlock/>
                      <center style="color:#FFFFFF; font-family:'Segoe UI',Arial,sans-serif; font-size:16px; font-weight:700;">View invoice →</center>
                    </v:roundrect>
                    <![endif]-->
                    <!--[if !mso]><!-->
                    <a class="btn" href="{!! $invoice->public_url !!}"
                       style="display:inline-block; background:#1B1D2A; color:#FFFFFF; font-size:16px; font-weight:700; line-height:52px; text-align:center; text-decoration:none; border-radius:8px; padding:0 34px; letter-spacing:0.2px;">
                       View invoice →
                    </a>
                    <!--<![endif]-->
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ===== Ledger / invoice summary ===== -->
          <tr>
            <td class="px" style="padding:28px 40px 6px 40px;">
              <div class="t-muted" style="font-size:11px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase; color:#8A8D9C; padding-bottom:8px;">
                Invoice summary
              </div>

              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:14px;">
                <tr>
                  <td class="t-muted brd-line" style="padding:12px 0; color:#6E7180; border-bottom:1px solid #EDEEF2;">Invoice number</td>
                  <td class="t-ink brd-line" style="padding:12px 0; color:#1B1D2A; font-weight:600; text-align:right; border-bottom:1px solid #EDEEF2;">{!! $invoice->number !!}</td>
                </tr>
                <tr>
                  <td class="t-muted brd-line" style="padding:12px 0; color:#6E7180; border-bottom:1px solid #EDEEF2;">Issue date</td>
                  <td class="t-ink brd-line" style="padding:12px 0; color:#1B1D2A; font-weight:600; text-align:right; border-bottom:1px solid #EDEEF2;">{!! $invoice->formatted_created_at !!}</td>
                </tr>
                <tr>
                  <td class="t-muted brd-line" style="padding:12px 0; color:#6E7180; border-bottom:1px solid #EDEEF2;">Due date</td>
                  <td class="t-ink brd-line" style="padding:12px 0; color:#1B1D2A; font-weight:600; text-align:right; border-bottom:1px solid #EDEEF2;">{!! $invoice->formatted_due_at !!}</td>
                </tr>
                <tr>
                  <td class="t-muted" style="padding:12px 0; color:#6E7180;">Status</td>
                  <td style="padding:12px 0; text-align:right;">
                    <span style="display:inline-block; padding:3px 9px; border-radius:20px; background:{!! $badgeBg !!}; color:{!! $badgeFg !!}; font-size:11px; font-weight:700; letter-spacing:0.4px; text-transform:uppercase;">{!! $invoice->status_text !!}</span>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Totals -->
          <tr>
            <td class="px" style="padding:6px 40px 0 40px;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="font-size:14px;">
                <tr>
                  <td class="t-soft" style="padding:10px 0 6px 0; color:#4A4D60;">Total</td>
                  <td class="t-ink" style="padding:10px 0 6px 0; color:#1B1D2A; font-weight:600; text-align:right;">{!! $invoice->amount->formatted_total !!}</td>
                </tr>
                <tr>
                  <td class="t-soft" style="padding:6px 0 14px 0; color:#4A4D60;">Amount paid</td>
                  <td class="t-ink" style="padding:6px 0 14px 0; color:#1B1D2A; font-weight:600; text-align:right;">{!! $invoice->amount->formatted_paid !!}</td>
                </tr>
                <tr>
                  <td class="t-ink brd-line" style="padding:16px 0 0 0; color:#1B1D2A; font-size:16px; font-weight:700; border-top:2px solid #1B1D2A;">Balance due</td>
                  <td class="t-ink brd-line" style="padding:16px 0 0 0; color:#1B1D2A; font-size:18px; font-weight:700; text-align:right; border-top:2px solid #1B1D2A;">{!! $invoice->amount->formatted_balance !!}</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Help text -->
          <tr>
            <td class="px t-muted" style="padding:30px 40px 20px 40px; font-size:13px; line-height:1.6; color:#8A8D9C; border-top:1px solid #EDEEF2;">
              Questions about this invoice? Just reply to this email and our team will be happy to help.
            </td>
          </tr>

          <!-- Sign-off -->
          <tr>
            <td class="px t-soft" style="padding:0 40px 32px 40px; font-size:14px; line-height:1.6; color:#4A4D60;">
              Best regards,<br>
              <strong class="t-ink" style="color:#1B1D2A;">{!! $invoice->user->name !!}</strong>
            </td>
          </tr>

        </table>
        <!-- ===== /Card ===== -->

        <!-- Footer -->
        <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" class="container" style="width:600px; max-width:600px;">
          <tr>
            <td class="px t-muted" align="center" style="padding:24px 40px 8px 40px; font-size:12px; line-height:1.7; color:#9498A8;">
              <strong style="color:#7E8294;">{!! $invoice->companyProfile->company !!}</strong>
              <!-- Optional (good for deliverability / CAN-SPAM): add a physical address + support email
              <br>[Company address · City · Country] · <a class="txt-link" href="mailto:billing@example.com" style="color:#1F7A5C;">billing@example.com</a> -->
            </td>
          </tr>
          <tr>
            <td class="t-muted" align="center" style="padding:0 40px 8px 40px; font-size:12px; color:#B4B7C4;">
              © {!! date('Y') !!} {!! $invoice->companyProfile->company !!}. All rights reserved.
            </td>
          </tr>
        </table>

        <!--[if mso | IE]>
        </td></tr></table>
        <![endif]-->

      </td>
    </tr>
  </table>
</body>
</html>
