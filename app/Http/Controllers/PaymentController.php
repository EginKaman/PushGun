<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Nova\Push;
use App\User;
use AvtoDev\CloudPayments\Client;
use AvtoDev\CloudPayments\Requests\Payments\Cards\CardsAuthRequestBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function check(Request $request)
    {
        $s = hash_hmac('sha256', $request->post(), config('services.cloud_payments.api_key'), true);
        \Log::info('Check payment', [
            'post' => $request->post(),
            'X-Content-HMAC' => $request->header('X-Content-HMAC'),
            'Content-HMAC' => $request->header('Content-HMAC')
        ]);
        $user = User::find($request->AccountId)->first();
        if (empty($user)) {
            return response()->json([
                'code' => 11
            ]);
        }
        return response()->json([
            'code' => 0
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Orders $order
     */
    public function store(Request $request)
    {
        $payment = new Payment();
        $payment->fill([
            'transaction_id' => $request->TransactionId,
            'amount' => $request->Amount,
            'currency' => $request->Currency,
            'currency_code' => $request->CurrencyCode,
            'email' => $request->Email,
            'description' => $request->Description,
            'json_data' => $request->JsonData,
            'ip_address' => $request->IpAddress,
            'name' => $request->Name,
            'card_first_six' => $request->CardFirstSix,
            'card_last_four' => $request->CardLastFour,
            'card_exp_date' => $request->CardExpDate,
            'card_type' => $request->CardType,
            'card_type_code' => $request->CardTypeCode,
            'status' => $request->Status,
            'status_code' => $request->StatusCode,
            'reason' => $request->Reason,
            'reason_code' => $request->ReasonCode,
            'card_holder_message' => $request->CardHolderMessage,
        ]);
        $payment->user()->associate(User::find($request->AccountId));
        $payment->save();
        return response()->json([
            'code' => 0
        ]);
    }
}
