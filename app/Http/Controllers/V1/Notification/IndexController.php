<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Notification;

use Illuminate\Http\Request;
use Inertia\Response;

class IndexController {
	public function __invoke(Request $request): Response
    {
        return inertia(
            'Notification/Index',
            [
                'notifications' => $request->user()
                    ->notifications()->paginate(10)
            ]
        );
    }
}