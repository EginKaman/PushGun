<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Tariff;
use App\User;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->load('payments', 'payments.tariff');
        return view('payments.index', [
            'user' => $user,
        ]);
    }

    public function check(Request $request)
    {
        $s = base64_encode(hash_hmac('sha256', $request->getContent(), config('services.cloud_payments.api_key'), true));
        if ($request->header('Content-HMAC') !== $s) {
            return response()->json([
                'code' => 13
            ]);
        }
        if (Tariff::where('id', '=', json_decode($request->Data, true)['tariff'])->doesntExist()) {
            return response()->json([
                'code' => 13
            ]);
        }
        if (User::where('id', '=', $request->AccountId)->doesntExist()) {
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
        $s = base64_encode(hash_hmac('sha256', $request->getContent(), config('services.cloud_payments.api_key'), true));
        if ($request->header('Content-HMAC') !== $s) {
            return response()->json([
                'code' => 13
            ]);
        }
        $payment = new Payment();
        $payment->fill([
            'transaction_id' => $request->TransactionId,
            'amount' => (float)$request->Amount,
            'currency' => $request->Currency,
            'email' => $request->Email,
            'description' => $request->Description,
            'data' => json_decode($request->Data, true),
            'ip_address' => $request->IpAddress,
            'name' => $request->Name,
            'card_first_six' => $request->CardFirstSix,
            'card_last_four' => $request->CardLastFour,
            'card_exp_date' => $request->CardExpDate,
            'card_type' => $request->CardType,
            'status' => $request->Status,
            'token' => $request->Token,
            'total_fee' => $request->TotalFee,
            'card_product' => $request->CardProduct,
            'payment_method' => $request->PaymentMethod,
        ]);
        $user = User::find($request->AccountId);
        $payment->user()->associate($user);
        $payment->tariff()->associate($payment->data['tariff']);
        $payment->save();
        $user->tariff()->associate($payment->data['tariff']);
        $expired = now();
        if ($user->tariff_expired_at !== null) {
            $expired = $user->tariff_expired_at;
        }
        if (!empty($payment->data['yearly']) && $payment->data['yearly'] === true) {
            $expired->addYear();
        } else {
            $expired->addMonth();
        }
        $user->tariff_expired_at = $expired;
        $user->save();
        return response()->json([
            'code' => 0
        ]);
    }
}
