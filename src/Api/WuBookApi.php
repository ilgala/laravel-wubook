<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelWubook\Api;

use IlGala\LaravelWubook\Api\WuBookAuth;
use IlGala\LaravelWubook\Exceptions\WuBookException;

/**
 * This is the WuBook api abstract class.
 *
 * @author ilgala
 */
abstract class WuBookApi
{

    /**
     * @var array
     */
    protected $config;

    /**
     * @var Illuminate\Cache\Repository
     */
    protected $cache;

    /**
     * @var fXmlRpc\Client
     */
    protected $client;

    /**
     * @var IlGala\LaravelWubook\Api\WuBookAuth
     */
    protected $auth;

    public function __construct($config, $cache, $client)
    {
        $this->config = $config;
        $this->cache = $cache;
        $this->client = $client;
        $this->auth = new WuBookAuth($config, $cache, $client);
    }

    /**
     * Prepends token and lcode.
     */
    protected function setup_client($token)
    {
        // Setup params
        $params = [
            $this->get_token($token),
            $this->config['lcode']
        ];

        $this->client->prependParams($params);
    }

    /**
     *
     * @param string $token
     * @return string
     * @throws WuBookException
     */
    protected function get_token($token)
    {
        // Check token
        if (empty($token) && $this->config['cache_token']) {
            $token = $this->cache->get('wubook.token');
        }

        $response = $this->auth->is_token_valid($token, $this->config['cache_token']);

        if (is_int($response)) {
            // If response is integer => valid token
            return $token;
        } else if (is_string($response)) {
            // If response is string => new token
            return $response;
        } else {
            // Error
            throw new WuBookException('Token is empty or invalid');
        }
    }

    protected function call_method($token, $method, $data = [])
    {
        // Setup client
        $this->setup_client($token);

        try {
            // Retrieve response
            $response = $this->client->call($method, $data);

            return [
                'has_error' => $response[0] != 0,
                'data' => $response[1]
            ];
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

}
