<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // ******** Page title ********
        $pageTitle = $event->title;
        // ******** Get src & srcset ********
        $event->getPhotoSrcAndSrcset($event);
        // ******** Get formated date ********
        $tools = new Tool;
        $event->date = $tools->getFormatedDate($event->date);

        return view('event/show', compact('pageTitle', 'event'));
    }
}
