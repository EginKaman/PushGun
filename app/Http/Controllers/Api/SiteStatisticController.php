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
    public function index(Request $request, Site $site)
    {
        $user = Auth::user();
        $statistics = $site->pushes()->selectRaw('count(*) as count, MIN(created_at) as created_at')
            ->groupByRaw('DAY(created_at)');
        if ($request->range === 'month') {
            $statistics->whereBetween('created_at', [
                now()->startOfMonth(),
                now()
            ]);
        } elseif ($request->range === 'year') {
            $statistics->whereBetween('created_at', [
                now()->startOfYear(),
                now()
            ]);
        } else {
            $statistics->whereBetween('created_at', [
                now()->subWeek(),
                now()
            ]);
        }
        $statistics = $statistics->get();
        return (new MailsResource($statistics))->additional([
            'conversions' => new ConversionsResource(collect()),
            'delivered' => new ConversionsResource(collect()),
            'sent' => new ConversionsResource(collect()),
        ]);
    }
}
