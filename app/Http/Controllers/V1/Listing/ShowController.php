<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Listing;

use App\Models\Listing;
use App\Services\ListingsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowController
{
	use AuthorizesRequests;

	public function __invoke(Listing $listing, ListingsService $listingsService)
	{
		$this->authorize('view', $listing);

        return inertia('Listing/Show', $listingsService->find($listing));
	}
}