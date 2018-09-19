<?php

namespace PaneeDesign\CoinMarketCapBundle\Handler\Features;

use PaneeDesign\CoinMarketCapBundle\Handler\Utils\ApiRequest;

/**
 * GlobalMetrics
 *
 * @link    https://github.com/paneedesign/coinmarketcap-bundle
 * @author  Vittorio Minacori (https://github.com/vittominacori)
 * @license https://github.com/paneedesign/coinmarketcap-bundle/blob/master/LICENSE (MIT License)
 */
class GlobalMetrics extends ApiRequest
{
    /**
     * GlobalMetrics constructor.
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        self::$apiPath .= 'global-metrics' . '/';
    }

    /**
     * @param array $params ["convert"]
     * @return mixed
     * @throws \Exception
     */
    public function quotesLatest($params = [])
    {
        return $this->get('quotes/latest', $params);
    }
}
