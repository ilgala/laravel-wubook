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

use fXmlRpc\Client;
use fXmlRpc\Exception\AbstractTransportException;
use IlGala\WuBook\Exceptions\WuBookException;
use Carbon\Carbon;

/**
 * This is the WuBook authentication class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookAuth
{

    /**
     * @var array
     */
    private $config;

    /**
     * @var Illuminate\Cache\Repository
     */
    private $cache;

    /**
     * @var fXmlRpc\Client
     */
    private $client;

    /**
     * Create a new WuBookAuth Instance.
     *
     * @param array $config
     * @param \Illuminate\Cache\Repository $cache
     * @param Client $client
     */
    public function __construct(array $config, Illuminate\Cache\Repository $cache, Client $client)
    {
        $this->config = $config;
        $this->client = $client;
        $this->cache = $cache;
    }

    /**
     * Acquire token. If cache_token option is set to true, the package will automatically save it into application cache
     *
     * http://tdocs.wubook.net/wired/auth.html#acquiring-and-releasing-a-token
     *
     *
     * @return string token
     */
    public function acquire_token()
    {
        // Setup request data
        $data = [
            $this->config['username'],
            $this->config['password'],
            $this->config['provider_key']
        ];

        try {
            // Retrieve response
            $response = $this->client->call('acquire_token', $data);

            // Check response
            if ($response[0] == 0) {
                // Success
                $token = $response[1];

                // Setup cache token expiration and max operations
                $expires_at = Carbon::now()->addSeconds(3600);

                // Setup cache
                if ($this->config['cache_token']) {
                    $this->cache->put('wubook.token', $token, $expires_at);
                    $this->cache->put('wubook.token.ops', 0, $expires_at);
                }

                return $token;
            } else {
                // Error
                throw new WuBookException($response[1], $response[0]);
            }
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

    /**
     * Token release.
     *
     * http://tdocs.wubook.net/wired/auth.html#acquiring-and-releasing-a-token
     *
     * @param string $token
     */
    public function release_token($token)
    {
        // Setup request data
        $data = [
            $token
        ];

        try {
            // Retrieve response
            $response = $this->client->call('release_token', $data);

            // Check response
            if ($response[0] == 0) {
                // Empty cache
                $this->cache->forget('wubook.token');
                $this->cache->forget('wubook.token.ops');

                return true;
            } else {
                // Error
                throw new WuBookException($response[1], $response[0]);
            }
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

    /**
     * The is_token_valid() function returns two information.
     * If (and only if) the ReturnCode is zero, it means that the token is valid.
     * In that case, the return value of the function is an integer and represents the number of times that this token has been used.
     *
     * The request_new param will not be considered if token is valid.
     *
     * http://tdocs.wubook.net/wired/auth.html#other-token-tools
     *
     * @param string $token
     * @param boolean $request_new
     * @return int|string
     * @throws IlGala\WuBook\Exceptions\WuBookException
     */
    public function is_token_valid($token, $request_new = false)
    {
        // Setup request data
        $data = [
            $token
        ];

        try {
            // Retrieve response
            $response = $this->client->call('is_token_valid', $data);

            if ($response[0] == 0) {
                return $response[1];
            } elseif ($request_new) {
                return $this->acquire_token();
            } else {
                return false;
            }
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

    /**
     * The provider_info() function is used to return the information WuBook holds about you as Wired Provider.
     * In particular, you can check what email we have registered and associated with your Provider Key.
     * The return value of this function is a Complex Structure.
     *
     * http://tdocs.wubook.net/wired/auth.html#other-token-tools
     *
     * @param string $token
     * @return mixed
     * @throws IlGala\WuBook\Exceptions\WuBookException
     */
    public function provider_info($token = null)
    {
        // Check token
        if (empty($token)) {
            $token = $this->cache->get('wubook.token');

            if (empty($token)) {
                $token = $this->acquire_token();
            }
        }

        // Setup request data
        $data = [
            $token
        ];

        try {
            // Retrieve response
            $response = $this->client->call('provider_info', $data);

            if ($response[0] == 0) {
                return $response[1];
            } else {
                // Error
                throw new WuBookException($response[1], $response[0]);
            }
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }
}
