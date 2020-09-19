<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Http\Requests\ChannelRequest;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('update');
    }

    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }

    public function update(ChannelRequest $request, Channel $channel)
    {

        if($request->hasFile('image')){
            $channel->clearMediaCollection('images');
            $channel->addMediaFromRequest('image')
                ->toMediaCollection('images');
        }

        $channel->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back();
    }
}
