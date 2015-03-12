<?php

class Prices
{
	const USD = 20;
	const INTL = 25;
	const APAC = 30;

	static public function resolvePriceRegion($request = null)
	{
		$price_region = 'USD';



		return $price_region;
	}
}