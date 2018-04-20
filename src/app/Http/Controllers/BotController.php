<?php

namespace App\Http\Controllers;

use CodeBot\SenderRequest;
use CodeBot\WebHook;
use CodeBot\CallSendApi;
use CodeBot\Message\Text;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function subscribe()
    {
        $webhook = new WebHook();
        $subscribe = $webhook->check('var');
        if (!$subscribe) {
            abort(403, 'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest();
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi('asaa');

        $callSendApi->make($text->message('Oi, eu sou um bot....'));
        $callSendApi->make($text->message('VOcê digitou: ' . $message));

        return '';
    }
}
