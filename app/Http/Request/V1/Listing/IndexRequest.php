<?php

declare(strict_types=1);

namespace App\Http\Request\V1\Listing;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'priceFrom' => [
				'nullable',
				'string',
			],
			'priceTo' => [
				'string',
				'nullable',
			],
			'beds' => [
				'nullable',
				'integer',
			],
			'baths' => [
				'nullable',
				'integer',
			],
			'areaFrom' => [
				'nullable',
				'integer',
			],
			'areaTo' => [
				'nullable',
				'integer',
			],
		];
	}
}