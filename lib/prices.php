<?php

class Prices
{
	const USD = 20;
	const INTL = 25;
	const APAC = 30;

	static public function resolvePriceRegion($region = null)
	{
		$price_region = 'USD';

		if($region == 'US') {
			$price_region = 'USD';
		} else if (
			($region == 'AU') || 
			($region == 'JP') ||
			($region == 'KP') ||
			($region == 'KR') ||
			($region == 'IN') ||
			($region == 'PI') ||
			($region == 'RC') ||
			($region == 'TW') 
			) {
			//Australia, Japan, Korea, India, Singapore, Philippines, China, Taiwan
				$price_region = 'APAC';
		} else {
			$price_region = 'INTL';
		}

		return $price_region;
	}
}