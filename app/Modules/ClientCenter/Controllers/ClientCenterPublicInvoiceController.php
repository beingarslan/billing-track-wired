<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\ClientCenter\Controllers;

use Carbon\Carbon;
use Stripe\StripeClient;
use BT\Support\FileNames;
use BT\Events\InvoiceViewed;
use Illuminate\Http\Request;
use BT\Support\PDF\PDFFactory;
use Illuminate\Support\Facades\DB;
use BT\Http\Controllers\Controller;
use BT\Modules\Invoices\Models\Invoice;
use BT\Modules\Payments\Models\Payment;
use BT\Support\Statuses\InvoiceStatuses;
use BT\Modules\Merchant\Support\MerchantFactory;
use BT\Modules\PaymentMethods\Models\PaymentMethod;

class ClientCenterPublicInvoiceController extends Controller
{
    public function show($urlKey)
    {
        $invoice = Invoice::where('url_key', $urlKey)->first();

        app()->setLocale($invoice->client->language);

        event(new InvoiceViewed($invoice));

        return view('client_center.invoices.public')
            ->with('invoice', $invoice)
            ->with('statuses', InvoiceStatuses::statuses())
            ->with('urlKey', $urlKey)
            ->with('merchantDrivers', MerchantFactory::getDrivers(true))
            ->with('attachments', $invoice->clientAttachments);
    }

    public function pdf($urlKey)
    {
        $invoice = Invoice::with('items.taxRate', 'items.taxRate2', 'items.amount.item.invoice', 'items.invoice')
            ->where('url_key', $urlKey)->first();

        event(new InvoiceViewed($invoice));

        $pdf = PDFFactory::create();

        $pdf->download($invoice->html, FileNames::invoice($invoice));
    }

    public function html($urlKey)
    {
        $invoice = Invoice::with('items.taxRate', 'items.taxRate2', 'items.amount.item.invoice', 'items.invoice')
            ->where('url_key', $urlKey)->first();

        return $invoice->html;
    }

    public function pay($urlKey)
    {
        $invoice = Invoice::with('items.taxRate', 'items.taxRate2', 'items.amount.item.invoice', 'items.invoice')
            ->where('url_key', $urlKey)->first();

        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $totalprice = floatval($invoice->amount->total);
        $session = $stripe->checkout->sessions->create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
            'currency' => 'usd',
            'unit_amount' =>  intval($totalprice) * 100, // convert dollars to cents
            'product_data' => [
                'name' => 'Pay',
                'images' => ["https://i.imgur.com/EHyR2nP.png"],
                'description' =>" " 
            ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('clientCenter.public.invoice.pay-success', [$urlKey]).'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' =>  route('invoices.index'),
        ]);
        return redirect($session->url);
    }

    public function paySuccess(Request $request, $urlKey)
    {
        $invoice = Invoice::where('url_key', $urlKey)->first();
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $session = $stripe->checkout->sessions->retrieve(
          $request->session_id,
          []
        );
        DB::table('invoice_transactions')->insert([
                'invoice_id' => $invoice->id, 
                'is_successful' => $session->payment_status == 'paid' ? 1:0,
                'transaction_reference' => $session->payment_intent,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        $method = PaymentMethod::where('name', 'Credit Card')->first();

        $payment = Payment::create([
            'client_id' => $invoice->client_id,
            'invoice_id' => $invoice->id,
            'amount' => $invoice->amount->total,
            'payment_method_id' => $method->id,
            'paid_at' => Carbon::now(),
        ]);
        return redirect()->to('/invoices')->with('alertSuccess', 'Successfull Payment');
    }
}
