<?php

namespace App\Services;

use Exception;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;

class PaypalService{
    protected $payPal;

    public function __construct()
    {
        if(config('settings.paypal_client_id') == '' || config('settings.paypal_secret_id') == ''){
            return \redirect()->back()->with('error','No Paypal settings found.');
        }

        $this->payPal = new ApiContext(
            new OAuthTokenCredential(config('settings.paypal_client_id'), config('settings.paypal_secret_id'))
        );

        // $this->payPal->setConfig(array('mode'=>'sandbox'));
    }

    public function processPayment($order){
        $shipping = sprintf('%0.2f',0);
        $tax = sprintf('%0.2f', 0);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = array();

        foreach ($order->items as $item) {
            $orderItems[$item->id] = new Item();
            $orderItems[$item->id]->setName($item->product->name)
                ->setCurrency(config('settings.currency_code'))
                ->setQuantity($item->quantity)
                ->setPrice(sprintf('%0.2f', $item->price))
            ;

            array_push($items, $orderItems[$item->id]);
        }

        $itemList = new ItemList();
        $itemList->setItems($items);


        $details = new Details();

        $details->setShipping($shipping)
            ->setTax($tax)
            ->setSubtotal(springf('%0.2f', $order->grand_total));
            ;

        $amount = new Amount();
        $amount->setCurrency(config('settings.currency_code'))
            ->setTotal(sprintf('%0.2f', $order->grand_total))
            ->setDetails($details)
        ;

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($order->user->full_name)
            ->setInvoiceNumber($order->order_number)
            ;

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('checkout.payment.complete'))
            ->setCancelUrl(route('checkout.index'))
            ;


        $payment = new Payment();

        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction))
        ;

        try{
            $payment->create($this->payPal);
        }catch(PayPalConnectionException $e){
            echo $e->getCode();
            echo $e->getData();
            exit(1);
        }catch(Exception $e){
            echo $e->getMessage();
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();
        header("Location: {$approvalUrl}");
        exit;
    }


    public function completePayment($paymentId, $payerId){
        $payment = Payment::get($paymentId, $this->payPal);
        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try {
            $result = $payment->execute($execute, $this->payPal);
        } catch (PayPalConnectionException $e) {
            $data = json_decode($e->getData());
            $_SESSION['message'] = 'Error, '.$data->message;
            exit;
        }

        if($result->state === 'approved'){
            $transactions = $result->getTransactions();
            $transaction = $transactions[0];
            $invoiceId = $transaction->invoice_number;

            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $saleId = $sale->getId();

            $transactionData = ['saledId' => $saleId, 'invoiceId' => $invoiceId];

            return $transactionData;
        }else{
            echo "<h3>".$result->state."</h3>";
            var_dump($result);
            exit;
        }
    }
}
