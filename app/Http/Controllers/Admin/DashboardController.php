<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TeamMember;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function stats()
    {
        $productsCount = Product::count();
        $teamCount = TeamMember::count();
        $messagesCount = ContactMessage::count();
        $unreadMessagesCount = ContactMessage::where('is_read', false)->count();

        return response()->json([
            'products' => $productsCount,
            'team' => $teamCount,
            'messages_total' => $messagesCount,
            'messages_unread' => $unreadMessagesCount,
            'status' => 'Healthy',
            'uptime' => '99.9%'
        ]);
    }
}
