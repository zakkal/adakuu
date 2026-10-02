<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;

class NotificationController extends Controller
{
    /**
     * Get all notifications (for dropdown)
     */
    public function index()
    {
        $notifications = AdminNotification::latest()
            ->take(50) // Limit to 50 most recent
            ->get();

        $unreadCount = AdminNotification::where('is_read', false)->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead()
    {
        AdminNotification::where('is_read', false)->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification
     */
    public function destroy($id)
    {
        $notification = AdminNotification::findOrFail($id);
        $notification->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Delete all notifications
     */
    public function destroyAll()
    {
        AdminNotification::truncate();

        return response()->json(['success' => true]);
    }

    /**
     * Get unread count only (for polling)
     */
    public function unreadCount()
    {
        $count = AdminNotification::where('is_read', false)->count();

        return response()->json(['count' => $count]);
    }
}
