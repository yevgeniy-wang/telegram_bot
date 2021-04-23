<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public static function botUpdate()
    {
        $apiKey = env('TELEGRAM_BOT_KEY');

        $update_id = null;

        while (true) {

            $updates = \Illuminate\Support\Facades\Http::get('https://api.telegram.org/bot' . $apiKey . '/getUpdates?offset=' . $update_id)->json();

            foreach ($updates['result'] as $update) {
                $update_id = $update['update_id'] + 1;

                $chatId = $update['message']['chat']['id'];

                $order = Order::find($update['message']['text']);

                if ($order) {
                    if ($order->completed == 1){
                        $text = 'Order ' . $order->title . ' is completed';
                    } else {
                        $text = 'Order ' . $order->title . ' is in process';
                    }
                } else $text = 'Could not find the order';

                $parameters = [
                    'chat_id' => $chatId,
                    'text' => $text
                ];

                $message = \Illuminate\Support\Facades\Http::get('https://api.telegram.org/bot' . $apiKey . '/sendMessage?' . http_build_query($parameters));

            }

            sleep(3);

        }
    }
}
