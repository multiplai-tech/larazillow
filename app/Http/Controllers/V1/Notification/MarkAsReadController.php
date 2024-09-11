<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Notification;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MarkAsReadController
{
	use AuthorizesRequests;
	
	public function __invoke(DatabaseNotification $notification)
	{
		$this->authorize('update', $notification);
        $notification->markAsRead();

        return redirect()->back()
            ->with('success', 'Notification marked as read');
	}
}