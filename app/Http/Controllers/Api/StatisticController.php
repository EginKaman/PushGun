<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Statistics\ConversionsResource;
use App\Http\Resources\Statistics\DeliveredResource;
use App\Http\Resources\Statistics\MailsResource;
use App\Http\Resources\Statistics\SentResource;
use App\Transition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MailsResource|\Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $pushes = $user->pushes()->selectRaw('count(*) as count, SUM(sent) as sent, SUM(delivered) as delivered, MIN(created_at) as created_at')
            ->groupByRaw('DAY(created_at)');
        $transitions = Transition::whereIn('push_id', $user->pushes()->pluck('id'))->selectRaw('count(*) as count, MIN(transitions.created_at) as created_at')
            ->groupByRaw('DAY(transitions.created_at)');
        if ($request->range === 'month') {
            $pushes->whereBetween('created_at', [
                now()->startOfMonth(),
                now()->endOfDay()
            ]);
            $transitions->whereBetween('transitions.created_at', [
                now()->startOfMonth(),
                now()->endOfDay()
            ]);
        } elseif ($request->range === 'year') {
            $pushes->whereBetween('created_at', [
                now()->startOfYear(),
                now()->endOfDay()
            ]);
            $transitions->whereBetween('transitions.created_at', [
                now()->startOfYear(),
                now()->endOfDay()
            ]);
        } else {
            $pushes->whereBetween('created_at', [
                now()->subWeek(),
                now()
            ]);
            $transitions->whereBetween('transitions.created_at', [
                now()->subWeek(),
                now()
            ]);
        }
        $pushes = $pushes->get();
        $transitions = $transitions->get();
        return (new MailsResource($pushes))->additional([
            'conversions' => new ConversionsResource($transitions),
            'delivered' => new DeliveredResource($pushes),
            'sent' => new SentResource($pushes),
        ]);
    }
}
