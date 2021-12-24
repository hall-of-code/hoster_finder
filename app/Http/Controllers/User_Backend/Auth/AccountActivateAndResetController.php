<?php

namespace App\Http\Controllers\User_Backend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\accountverify;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AccountActivateAndResetController extends Controller
{
    /**
     * @throws \Exception
     */
    public function send_verification_mail($to, $username, $user_id)
    {
        $verify_code = random_int(100000, 999999);
        $in = new accountverify();
        $in->user_id = $user_id;
        $in->confirm_code = $verify_code;
        $in->save();
        Mail::to($to)->send( new RegisterMail(["confirm_code" => $verify_code, "username" => $username, 'uid' => $user_id]) );
    }

    public function show_confirm_code_page()
    {
        return view("User_Backend.Account.Confirm.confirm_account");
    }

    //function takes confirmation code, and id by URL -- or manually by POST Request insert from the show_confirm_code_page()-view
    public function confirm_account_by_code($locale, $code = 0, $user_id = 0)
    {
        if($code == 0 )
        {
            $code = Request()->get('confirm_code');
        }
        if($user_id == 0)
        {
            $user_id = Auth()->id();
        }
        if(accountverify::where('user_id', $user_id)->where('confirm_code', 'LIKE', '%'.$code.'%')->count() > 0 && strlen($code) >= 5)
        {
            User::where('id', $user_id)->update(['acc_status' => 1]);
            return redirect()->route('user.dashboard', app()->getLocale());
        }
        return Response('False: ID='. Auth()->id());
    }
}
