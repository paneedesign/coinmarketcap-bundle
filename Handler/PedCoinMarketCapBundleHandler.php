<?php
/**
 * Created by PhpStorm.
 * User: vittominacori
 * Date: 27/04/18
 * Time: 16:43
 */

namespace PaneeDesign\CoinMarketCapBundle\Handler;

use Exception;
use Unirest;

class PedCoinMarketCapBundleHandler
{
    private static $endpoint = '';
    private static $headers = [];

    /**
     * PedCoinMarketCapBundleHandler constructor.
     * @param string $endpoint
     * @param string $contentType
     */
    public function __construct($endpoint = '', $contentType = '')
    {
        self::$endpoint = $endpoint;
        self::$headers = [
            'Accept' => $contentType,
            'Content-Type' => $contentType
        ];
    }

    // public methods

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getListings()
    {
        return $this->get('listings');
    }

    /**
     * @param array $params (Optional parameters "convert", "limit", "start")
     * @return mixed
     * @throws Exception
     */
    public function getTicker($params = [])
    {
        return $this->get('ticker', $params);
    }

    /**
     * @param integer $id
     * @param array $params (Optional parameters "convert")
     * @return mixed
     * @throws Exception
     */
    public function getTickerById($id, $params = [])
    {
        return $this->get('ticker/' . $id, $params);
    }

    /**
     * @param array $params (Optional parameters "convert")
     * @return mixed
     * @throws Exception
     */
    public function getGlobalData($params = [])
    {
        return $this->get('global', $params);
    }

    // private methods

    /**
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws Exception
     */
    private function get($method, $parameters = [])
    {
        $apiCall = self::$endpoint . $method;
        $response = Unirest\Request::get($apiCall, self::$headers, $parameters);
        if ($response->code == 200) {
            return $response->body;
        } else {
            throw new Exception($response->body, $response->code);
        }
    }

    /**
     * @param string $method
     * @param array $body
     * @param string $type
     * @return mixed
     * @throws Exception
     */
    private function post($method, $body = [], $type = '')
    {
        $apiCall = self::$endpoint . $method;
        if ($type == 'json') {
            $body = Unirest\Request\Body::json($body);
        }
        $response = Unirest\Request::post($apiCall, self::$headers, $body);
        if ($response->code == 200) {
            return $response->body;
        } else {
            throw new Exception($response->body, $response->code);
        }
    }
}