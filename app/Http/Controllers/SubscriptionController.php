<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Channel $channel
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Channel $channel)
    {
        return $channel->subscriptions()->create([
            'user_id' => auth()->user()->id
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Channel $channel
     * @param Subscription $subscription
     * @return void
     * @throws \Exception
     */
    public function destroy(Channel $channel,Subscription $subscription)
    {
        $subscription->delete();

        return response()->json([]);
    }
}
