<?php

namespace App\Http\Controllers\User_Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\protection\Telegramchats;
use App\Models\protection\Twofactorauths;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class TwoFactorAuthenticationController extends Controller
{
    public function show_2fa_page($locale)
    {
        return view('User_Backend.Account.2fa.2fa_page');
    }

    public function handle_2fa_request($locale): \Illuminate\Http\RedirectResponse
    {
        return redirect()->route('user.dashboard', app()->getLocale());
    }

    public function add_telegram($locale): string
    {
        $bot = Telegram::getUpdates([
            "limit" => 3,
        ]);
        foreach ($bot as $item)
        {
            $chat_id = $item["message"]["chat"]["id"];
            $username = $item["message"]["from"]["username"];
            if(Telegramchats::where('chat_id', $chat_id)->count() <= 0)
            {
                Telegram::sendMessage([
                    "chat_id" => $chat_id,
                    "text" => "Hi ".$username.", thats your Code:",
                ]);

                Telegram::sendMessage([
                    "chat_id" => $chat_id,
                    "text" => $chat_id."",
                ]);

                $insert = new Telegramchats();
                $insert->user_id = "none";
                $insert->chat_id = $chat_id;
                $insert->username = $username;
                $insert->save();
            }
        }
        return "true";
    }

}
