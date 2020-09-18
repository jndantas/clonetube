<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function show(Channel $channel)
    {
        return view('channels.show', compact('channel'));
    }
}
