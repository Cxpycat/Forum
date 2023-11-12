<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use App\Http\Requests\UpdateNotificationRequest;

class NotificationController extends Controller
{

    /**
     * Update the specified resource in storage.
     */
    public function updateCollection (UpdateNotificationRequest $request)
    {
        $data = $request->validated();
        Notification::whereIn('id', $data['ids'])->update(['is_read' => true]);

        return response()->json([
            'count' => auth()->user()->notifications()->count(),
        ]);
    }

}
