<?php

namespace App\Http\Controllers\User_Backend\Auth\Telegram;

use App\Http\Controllers\Controller;
use App\Models\protection\Telegramchats;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    //this function links the user id with the telegram chatid, by getting the chat id
    public function link_telegram_to_user($locale, $chat_id): \Illuminate\Http\RedirectResponse
    {
        Telegramchats::where('chat_id', $chat_id)->first()->update(['user_id' => Auth()->user()->id]);
        return redirect()->route('user.dashboard', App()->getLocale());
    }


    //this function reacts to telegram messages, and returns the Code.
    public function return_telegram_chatid($locale)
    {
        $last_messages = Telegram::getUpdates([
            "limit" => 3,
        ]);

        $counter = 0;
        foreach ($last_messages as $msg) {
            $chat_id = $msg["message"]["chat"]["id"];
            $t_username = $msg["message"]["from"]["username"];
            if (Telegramchats::where('chat_id', $chat_id)->count() <= 0) {
                Telegram::sendMessage([
                    "chat_id" => $chat_id,
                    "text" => "Hi " . $t_username . ", thats your Code:",
                ]);

                Telegram::sendMessage([
                    "chat_id" => $chat_id,
                    "text" => $chat_id . "",
                ]);

                $insert = new Telegramchats();
                $insert->user_id = "none"; //hier können wir die User Id nicht eintragen, weil es ja sein kann das mehrere user gleichzeitig telegram eine nachicht senden.
                $insert->chat_id = $chat_id;
                $insert->username = $t_username;
                $insert->save();

                $counter++;
            }
        }
        return response()->json(["updated" => "{$counter}"]);
    }
}
