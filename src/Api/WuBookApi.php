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

    /**
     * Creates a new WuBookAuth instance.
     *
     * @param array $config
     * @param Illuminate\Cache\Repository $cache
     * @param fXmlRpc\Client $client
     */
    public function __construct($config, Repository $cache, Client $client)
    {
        $this->config = $config;
        $this->cache = $cache;
        $this->client = $client;
        $this->auth = new WuBookAuth($config, $cache, $client);
    }

    /**
     * Prepends token and lcode or custom parameters
     *
     * @param mixed $params
     */
    protected function setup_client($params)
    {
        if (!is_array($params)) {
            // Setup params
            $params = [
                $this->get_token($params),
                $this->config['lcode']
            ];
        }

        $this->client->prependParams($token);
    }

    /**
     * Validate and, if necessary, retrieves a token or the cached token
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
        } elseif (is_string($response)) {
            // If response is string => new token
            return $response;
        } else {
            // Error
            throw new WuBookException('Token is empty or invalid');
        }
    }

    /**
     * Calls a wired API function.
     *
     * @param string $token
     * @param string $method
     * @param array $data
     * @return array
     * @throws WuBookException
     */
    protected function call_method($token, $method, $data = [])
    {
        if ($this->config['cache_token']) {
            // Check total operations
            $operations = $this->cache->get('wubook.token.ops');
            $operations++;

            if ($operations >= 60) {
                // Exceeded max ops, renew token
                $this->auth->release_token($this->get_token($token));
                $this->auth->acquire_token();
            }
        }

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
        } finally {
            if ($this->config['cache_token']) {
                // Increment total operations
                $this->cache->increment('wubook.token.ops');
            }
        }
    }
}
