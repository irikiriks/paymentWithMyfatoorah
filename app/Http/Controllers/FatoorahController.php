<?php

namespace App\Http\Controllers;

use App\Http\Services\FatoorahServices;
use Illuminate\Http\Request;

class FatoorahController extends Controller
{

    private $fatoorahServices;




    public function __construct(FatoorahServices $fatoorahServices)
    {
        $this->fatoorahServices = $fatoorahServices;
    }




    public function payOrder()
    {
        $data = [
            'CustomerName' => 'ibrahimrezk',
            'NotificationOption' => 'Lnk',
            'InvoiceValue' => 100,
            'CustomerEmail' => 'ibrahimrezk@live.com',
            'CallBackUrl' => 'http://payment-ahmed-emam.test/api/call_back',
            'ErrorUrl' => 'https://youtube.com',
            'Language' =>  'en',
            'DisplayCurrencyIso' => 'KWD',

        ];

        return $this->fatoorahServices->sendPayment($data);
    }

    public function paymentCallBack(Request $request)
    {

        // return ($request);
        // dd($request);

        $data = [];
        $data['key'] = $request->paymentId;
        $data['keyType'] = 'paymentId';


        return $this->fatoorahServices->getPaymentStatus($data);
    }
}
