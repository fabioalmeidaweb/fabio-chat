<?php

namespace App\Http\Controllers;

use CodeBot\Message\Image;
use CodeBot\Message\Text;
use CodeBot\SenderRequest;
use CodeBot\Element\Button;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\WebHook;
use CodeBot\CallSendApi;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function subscribe()
    {
        $webhook = new WebHook();
        $subscribe = $webhook->check(config('botfb.validationToken'));

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

        $callSendApi = new CallSendApi(config('botfb.pageAccessToken'));

        $text = new Text($senderId);
        $callSendApi->make($text->message('Oi, eu sou um bot....'));
        $callSendApi->make($text->message('Você digitou: ' . $message));

        $image = new Image($senderId);
        $callSendApi->make($image->message('http://colorfully.eu/wp-content/uploads/2012/05/summer-beach-sand-welcome-timeline-facebook-cover.jpg'));

        $message = new ButtonsTemplate($senderId);
        $message->add(new Button('web_url', 'Google', 'https://www.google.com.br'));
        $message->add(new Button('web_url', 'Drupal', 'https://www.drupal.org'));
        $callSendApi->make($message->message('Can you test to open a site?'));

        return '';
    }
}
