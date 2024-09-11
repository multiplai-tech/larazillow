<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Listing;

use App\Models\Listing;
use App\Services\ListingsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ShowController
{
	use AuthorizesRequests;

	public function __construct(
		protected ListingsService $listingsService
	)
	{

	}

	public function __invoke(Listing $listing)
	{
		$this->authorize('view', $listing);

        return inertia('Listing/Show', $this->listingsService->find($listing));
	}
}