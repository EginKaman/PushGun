<?php

namespace App\Http\Controllers;

use App\Site;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function update(Request $request, Site $site)
    {
        $this->validate($request, ['endpoint' => 'required']);

        $site->updatePushSubscription(
            $request->endpoint,
            $request->publicKey,
            $request->authToken,
            $request->contentEncoding
        );

        return response()->json(null, 204);
    }

    /**
     * Delete the specified subscription.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $this->validate($request, ['endpoint' => 'required']);

        $request->user()->deletePushSubscription($request->endpoint);

        return response()->json(null, 204);
    }
}
