<?php

namespace App\Http\Controllers;

use App\Models\CustomNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = CustomNotification::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($n) {
                return [
                    'id' => (string)$n->id,
                    'type' => $n->type,
                    'title' => $n->title,
                    'message' => $n->message,
                    'isRead' => $n->is_read,
                    'createdAt' => $n->created_at->toISOString(),
                ];
            });

        return response()->json($notifications);
    }

    public function markAsRead($id, Request $request)
    {
        $notification = CustomNotification::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function markAllAsRead(Request $request)
    {
        CustomNotification::where('user_id', $request->user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
