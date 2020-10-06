<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Statistics\ConversionsResource;
use App\Http\Resources\Statistics\MailsResource;
use App\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MailsResource
     */
    public function __invoke(Request $request, Site $site)
    {
        $user = Auth::user();
        $pushes = $site->pushes()->selectRaw('count(*) as count, MIN(created_at) as created_at')
            ->groupByRaw('DAY(created_at)');
        $transitions = $site->transitions()->selectRaw('count(*) as count, MIN(transitions.created_at) as created_at')
            ->groupByRaw('DAY(transitions.created_at), `laravel_through_key`');
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
            'delivered' => new ConversionsResource(collect()),
            'sent' => new ConversionsResource(collect()),
        ]);
    }
}
