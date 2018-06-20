<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessagesController extends Controller
{
    public function submit(Request $request) {
        $this->validate($request, [
            'text' => 'required',
            'speed' => 'required'
        ]);

        //Create new message

        $message = new Message;
        $message->text = $request->input('text');
        $message->speed = $request->input('speed');

        //Save Message

        $message->save();

        //Redirect
        return redirect('/')->with('success', 'Текст был сохранен');
    }

    public function getTexts() {
//        $texts = Message::last();
        $texts = Message::orderBy('created_at', 'desc')->first();
//        $texts = Message::orderBy('created_at', 'desc')->latest();

        return view('sufler')->with('texts', $texts);
    }
}
