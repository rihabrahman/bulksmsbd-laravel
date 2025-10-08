<?php

namespace RihabRahman\BulkSmsBD\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RihabRahman\BulkSmsBD\Events\SmsDelivered;
use RihabRahman\BulkSmsBD\Events\SmsFailed;

class DlrWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $status = $request->input('status');
        $messageId = $request->input('message_id');
        $to = $request->input('to');
        $message = $request->input('message');

        $payload = compact('to', 'message', 'status', 'messageId');

        if ($status == 202) {
            event(new SmsDelivered($payload));
        } else {
            event(new SmsFailed($payload));
        }

        return response()->json(['success' => true]);
    }
}
