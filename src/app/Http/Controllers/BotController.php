<?php

namespace App\Http\Controllers;

use CodeBot\Element\Product;
use CodeBot\SenderRequest;
use CodeBot\Element\Button;
use CodeBot\WebHook;

use CodeBot\Build\Solid;
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
        $postback = $sender->getPostback();

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSenderId($senderId);

        if ($postback) {
            if (is_array($postback)) {
                $postback = json_encode($postback);
            }
            $bot->message('text', 'Você chamou o postback ' .  $postback);
            return '';
        }

        $bot->message('text', 'Oi, eu sou um bot....');
        $bot->message('text', 'Você digitou: ' . $message);
        $bot->message('image', 'http://colorfully.eu/wp-content/uploads/2012/05/summer-beach-sand-welcome-timeline-facebook-cover.jpg');

        $buttons = [
            new Button('web_url', null, 'https://google.com'),
            new Button('web_url', 'Drupal', 'https://www.drupal.org')
        ];
        $bot->template('buttons', 'A big test!', $buttons);

        $products = [
            new Product(
                'Product 1',
                'http://www.twccomunicacao.com.br/restrito/img/noticias/2016/04/wb_moc_post-4-dicas-matadoras-para-vender-produtos-afiliados-600x600_011.png',
                'A awesome product!',
                new Button('web_url', null, 'https://google.com')
            ),
            new Product(
                'Product 2',
                'http://www.twccomunicacao.com.br/restrito/img/noticias/2016/04/wb_moc_post-4-dicas-matadoras-para-vender-produtos-afiliados-600x600_011.png',
                'A awesome course!',
                new Button('web_url', null, 'https://google.com')
            )

        ];
        $bot->template('generic', '', $products);
        $bot->template('list', '', $products);

        return '';
    }
}
