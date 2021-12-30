<?php

namespace App\Http\Controllers\API_Controlling\Applications;

use App\Http\Controllers\Controller;
use App\Models\api\applications;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class applicationController extends Controller
{
    public function listApplications(): \Illuminate\Http\JsonResponse
    {
        $limit = Request("limit") ?? 12;
        $user_id = Auth()->user()->id;
        $app_id = Request("app_id") ?? false;
        $app_name = Request("app_name") ?? false;
        $query = applications::where('user_id', $user_id);
        if($app_id != false)
        {
            $query->where('id', $app_id);
        }
        else if($app_name != false)
        {
            $query->where('app_name', $app_name);
        }
        $applications = $query->limit($limit)->get();
        return response()->json(['action' => 'list', 'result' => ($applications ?? []), 'error' => false]);
    }

    public function deleteApplication(): \Illuminate\Http\JsonResponse
    {
        $user_id = Auth()->user()->id;
        $app_id = Request("app_id") ?? false;
        $query = applications::where('user_id', $user_id);
        if($app_id != false)
        {
            $query->where('id', $app_id);
        }
        else
        {
            return response()->json([
                "error" => "missing app_id param",
            ]);
        }
        $application = $query->first();
        $query->delete();
        return response()->json(["action" => "deleted application", 'error' => false, 'result' => $application]);
    }

    public function regenerateApplicationToken(): \Illuminate\Http\JsonResponse
    {
        $user_id = Auth()->user()->id;
        $app_id = Request("app_id") ?? false;
        $query = applications::where('user_id', $user_id);
        if($app_id != false)
        {
            $query->where('id', $app_id);
        }
        else
        {
            return response()->json([
                "error" => "missing app_id param",
            ]);
        }
        $app_token = base64_encode(openssl_random_pseudo_bytes(3 * (24 >> 2)));
        $app_token = $query->first()->update(['app_token' => $app_token])->get(["app_token"]);
        return response()->json(["action" => "application token regenerated for application", "result" => $app_token, 'error' => false]);
    }

    public function updateApplication(): \Illuminate\Http\JsonResponse
    {
        $rdata = Request()->validate([
            "app_name" => "max:128",
            "app_perms" => "max:512",
            "app_icon" => "max:256",
        ]);
        $user_id = Auth()->user()->id;
        $app_id = Request("app_id") ?? false;
        $query = applications::where('user_id', $user_id);

        if($app_id != false)
        {
            $query->where('id', $app_id);
        }
        else
        {
            return response()->json([
                "error" => "missing app_id param",
            ]);
        }
        $application = $query->first();
        $updated_app = $application->update($rdata)->get();

        return response()->json([
            "action" => "update",
            "updated" => $updated_app,
        ]);
    }

    public function createApplication(): \Illuminate\Http\JsonResponse
    {
        Request()->validate([
            "app_name" => "min:1|max:128",
        ]);
        $app_name = Request('app_name');
        $user_id = Auth()->user()->id;
        $app_perms = Request('app_perms');
        $app_token = base64_encode(openssl_random_pseudo_bytes(3 * (24 >> 2)));

        if(applications::where('user_id', $user_id)->where('app_name', $app_name)->count() > 0)
        {
            $app_name .= "(1)";
        }
        if(applications::where('user_id', $user_id)->count() > 12)
        {
            return response()->json([
                "error" => "reached limit of 12 applications per user",
            ]);
        }

        $i = new applications();
        $i->app_name = $app_name;
        $i->user_id = $user_id;
        $i->app_perms = $app_perms ?? "FULL";
        $i->app_token = $app_token;
        $i->save();

        $app_obj = applications::where('app_name', $app_name)->first();
        $app_icon = $app_obj['app_icon'];
        $app_status = $app_obj['app_status'];

        return response()->json([
            "action" => "create",
            "app_name" => "$app_name",
            "app_perms" => "$app_perms",
            "app_token" => "$app_token",
            "app_icon" => "$app_icon",
            "status" => "$app_status",
        ]);
    }
}
