<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class ListingsService {

	public function index($filters)
	{
		$filters = $filters->only([
			'priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'
        ]);
		
		return [
			'filters' => $filters,
			'listings' => Listing::mostRecent()
				->filter($filters)
				->withoutSold()
				->paginate(10)
				->withQueryString()
		];
	}

	public function find($listing)
	{
		$listing->load(['images']);
        $offer = !Auth::user() ?
            null : $listing->offers()->byMe()->first();

		return [
			'listing' => $listing,
			'offerMade' => $offer
		];
	}
}