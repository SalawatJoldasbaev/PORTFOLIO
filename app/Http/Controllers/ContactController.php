<?php

namespace App\Http\Controllers;

use App\Src\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function SendMessage(Request $request)
    {
        $message = Http::post("https://api.telegram.org/bot" . env("BOT_TOKEN") . "/sendMessage", [
            'chat_id' => env("ADMIN_ID"),
            'parse_mode' => 'html',
            'text' => "NEW MESSAGE\n\nName: " . strip_tags($request->name) . "\nEmail: " . strip_tags($request->email) . "\nMessage: " . strip_tags($request->message),
        ])->json();
        if ($message['ok'] === true) {
            return Response::success();
        } else {
            return Response::error('message not sent, try again');
        }
    }
}
