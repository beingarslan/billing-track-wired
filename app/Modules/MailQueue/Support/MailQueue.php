<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\MailQueue\Support;

use BT\Support\PDF\PDFFactory;
use Illuminate\Support\Facades\Mail;

class MailQueue
{
    protected $error;
    protected $templateData = [];
    protected $templateView = null;

    public function create($object, $input)
    {
        return $object->mailQueue()->create([
            'from'       => json_encode(['email' => $object->user->email, 'name' => $object->user->name]),
            'to'         => json_encode($input['to']),
            'cc'         => (isset($input['cc'])) ? json_encode($input['cc']) : json_encode(['']),
            'bcc'        => (isset($input['bcc'])) ? json_encode($input['bcc']) :json_encode(['']),
            'subject'    => $input['subject'],
            'body'       => $input['body'],
            'attach_pdf' => $input['attach_pdf'],
        ]);

    }

    public function setTemplate($view, $data = [])
    {
        $this->templateView = $view;
        $this->templateData = $data;
        return $this;
    }

    public function send($id)
    {
        $mail = \BT\Modules\MailQueue\Models\MailQueue::find($id);

        if ($this->sendMail(
            $mail->from,
            $mail->to,
            $mail->cc,
            $mail->bcc,
            $mail->subject,
            $mail->body,
            $this->getAttachmentPath($mail)
        )
        )
        {
            $mail->sent = 1;
            $mail->save();

            return true;
        }

        return false;
    }

    public function sendWithTemplate($id, $view, $data = [])
    {
        $mail = \BT\Modules\MailQueue\Models\MailQueue::find($id);

        $this->setTemplate($view, $data);

        if ($this->sendMail(
            $mail->from,
            $mail->to,
            $mail->cc,
            $mail->bcc,
            $mail->subject,
            $mail->body,
            $this->getAttachmentPath($mail)
        )
        )
        {
            $mail->sent = 1;
            $mail->save();

            return true;
        }

        return false;
    }

    private function getAttachmentPath($mail)
    {
        if ($mail->attach_pdf)
        {
            $object = $mail->mailable;

            $pdfPath = base_path('storage/' . $object->pdf_filename);

            $pdf = PDFFactory::create();

            $pdf->save($object->html, $pdfPath);

            return $pdfPath;
        }

        return null;
    }

    private function sendMail($from, $to, $cc, $bcc, $subject, $body, $attachmentPath = null)
    {
        try
        {
            if ($this->templateView && view()->exists($this->templateView)) {
                $htmlView = $this->templateView;
                $viewData = $this->templateData;
            } else {
                $htmlView = (view()->exists('email_templates.html')) ? 'email_templates.html' : 'templates.emails.html';
                $viewData = ['body' => $body];
            }

            Mail::send([$htmlView, 'templates.emails.text'], $viewData, function ($message) use ($from, $to, $cc, $bcc, $subject, $attachmentPath)
            {
                $from = json_decode($from, true);
                $to   = json_decode($to, true);
                $cc   = json_decode($cc, true);
                $bcc  = json_decode($bcc, true);

                $message->from($from['email'], $from['name']);
                $message->subject($subject);

                foreach ($to as $toRecipient)
                {
                    $message->to(trim($toRecipient));
                }

                foreach ($cc as $ccRecipient)
                {
                    if ($ccRecipient !== '')
                    {
                        $message->cc(trim($ccRecipient));
                    }
                }

                foreach ($bcc as $bccRecipient)
                {
                    if ($bccRecipient !== '')
                    {
                        $message->bcc(trim($bccRecipient));
                    }
                }

                if (config('bt.mailReplyToAddress'))
                {
                    $message->replyTo(config('bt.mailReplyToAddress'));
                }

                if ($attachmentPath)
                {
                    $message->attach($attachmentPath);
                }
            });

            if ($attachmentPath and file_exists($attachmentPath))
            {
                unlink($attachmentPath);
            }

            return true;
        }
        catch (\Exception $e)
        {
            $this->error = $e->getMessage();

            return false;
        }
    }

    public function getError()
    {
        return $this->error;
    }
}
