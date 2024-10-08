<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Listing;

use App\Http\Request\V1\Listing\IndexRequest;
use App\Models\Listing;
use App\Services\ListingsService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IndexController
{
	use AuthorizesRequests;

	public function __construct(
		protected ListingsService $listingsService
	)
	{

	}
	
	public function __invoke(IndexRequest $request)
	{
		$this->authorize('viewAny', Listing::class);
		
        return inertia('Listing/Index', $this->listingsService->index($request));
	}
}