<?php

namespace App\Services;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use Mockery\Exception;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;

class PaypalService {

    /**
     * @var mixed
     */
    protected $paypal;

    public function __construct() {

        if ( \config( 'settings.paypal_client_id' ) == '' || config( 'settings.paypal_secret_id' ) == '' ) {
            return \redirect()->back()->with( 'error', 'No Paypal settings found.' );
        }

        $this->paypal = new ApiContext(
            new oAuthTokenCredential(
                config( 'settings.paypal_client_id' ),
                config( 'settings.paypal_secret_id' )
            )
        );

// To use PayPal in live mode you have to add

// the below, I prefer to use the sandbox mode only.

//$this->payPal->setConfig(

        //    array('mode'  =>  'live')

    }

    /**
     * @param $order
     */
    public function processPayment( $order ) {

        // Add shipping amount if you want to charge for shipping
        $shipping = sprintf( '%0.2f', 0 );
        // Add any tax amount if you want to apply any tax rule
        $tax = sprintf( '%0.2f', 0 );

        $payer = new Payer();

        $payer->setPaymentMethod( 'paypal' );

        $items = array();

        foreach ( $order->items as $item ) {
            $orderItems[$item->id] = new Item();
            $orderItems[$item->id]->setName( $item->product->name )
                ->setCurrency( config( 'settings.currency_code' ) )
                ->setQuantity( $item->quantity )
                ->setPrice( \sprintf( "%0.2f", $item->price ) )
            ;

            array_push( $items, $orderItems[$item->id] );
        }

        $itemList = new ItemList();
        $itemList->setItems( $items );

        //Settings shipping details

        $details = new Details();
        $details->setShipping( $shipping )
            ->setTax( $tax )
            ->setSubtotal( sprintf( "%0.2f", $order->grand_total ) )
        ;

        //Create chargeable amount

        $amount = new Amount();
        $amount->setCurrency( config( 'settings.currency_code' ) )
            ->setTotal( \sprintf( "%0.2f", $order->grand_total ) )
            ->setDetails( $details )

        ;

        //Creating a transaction

        $transaction = new Transaction();
        $transaction->setAmount( $amount )
            ->setItemList( $itemList )
            ->setDescription( $order->user->full_name )
            ->setInvoiceNumber( $order->order_number )
        ;

        //Setting up the redirect urls

        $redirectUrl = new RedirectUrls();
        $redirectUrl->setReturnUrl( route( 'checkout.payment.complete' ) )
            ->setCancelUrl( route( 'checkout.index' ) )

        ;

        //Creating Payment Instance

        $payment = new Payment();
        $payment->setIntent( 'sale' )
            ->setPayer( $payer )
            ->setRedirectUrls( $redirectUrl )
            ->setTransactions( array( $transaction ) )
        ;

        try {
            $payment->create( $payment );
        } catch ( PaypalConnectionException $e ) {
            echo $e->getcode();
            echo $e->getData();
            exit( 1 );
        } catch ( Exception $e ) {
            echo $e->getMessage();
            exit( 1 );
        }

        $approvalUrl = $payment->getApprovalLink();

        header( "locaiton: {$approvalUrl}" );

        exit();

    }

    /**
     * @param $paymentId
     * @param $payerId
     */
    public function completePayment( $paymentId, $payerId ) {
        $payment = Payment::get( $paymentId, $this->paypal );

        $execute = new PaymentExecution();
        $execute->setPayerId( $payerId );

        try {
            $result = $payment->execute( $execute, $this->paypal );
        } catch ( PaypalConnectionException $exception ) {
            $data = json_decode( $exception->getData );

            $_SESSION['message'] = 'Error, ' . $data->message;
            exit;
        }

        if ( $result->state === 'approved' ) {
            $transactions = $result->getTransactions();
            $transaction = $transactions[0];
            $invoiceId = $transaction->invoice_number;

            $relatedResources = $transactions[0]->getRelatedResources();
            $sale = $relatedResources[0]->getSale();
            $saleId = $sale->getId();

            $transactionData = ['salesId' => $saleId, 'invoiceId' => $invoiceId];

            return $transactionData;
        } else {
            echo "<h3>" . $result->state . "</h3>";
            var_dump( $result );
            exit( 1 );
        }

    }

}
