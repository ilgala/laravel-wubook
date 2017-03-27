<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelWubook;

use fXmlRpc\Client;
use fXmlRpc\Parser\NativeParser;
use fXmlRpc\Serializer\NativeSerializer;
use Illuminate\Contracts\Config\Repository;
use IlGala\LaravelWubook\Exceptions\WuBookException;
use IlGala\LaravelWubook\Api\WuBookAuth;
use IlGala\LaravelWubook\Api\WuBookAvailability;
use IlGala\LaravelWubook\Api\WuBookRooms;

/**
 * This is the WuBook manager class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBook
{

    /**
     * @var string
     */
    const ENDPOINT = 'https://wubook.net/xrws/';

    /**
     * @var array
     */
    private $config;

    /**
     * @var Illuminate\Cache\Repository
     */
    private $cache;

    /**
     * Create a new WuBook Instance.
     *
     * @param Repository $config
     * @throws WuBookException
     */
    public function __construct(Repository $config)
    {
        // Setup credentials
        $this->config = array_only($config->get('wubook'), ['username', 'password', 'provider_key', 'lcode']);

        // Credentials check
        if (!array_key_exists('username', $this->config) || !array_key_exists('password', $this->config) || !array_key_exists('provider_key', $this->config) || !array_key_exists('lcode', $this->lcode)) {
            throw new WuBookException('Credentials are required!');
        }

        if (!array_key_exists('cache_token', $this->config)) {
            $this->config['cache_token'] = false;
        }

        // Utilities
        $this->cache = app()['cache'];
    }

    /**
     * Auth API
     *
     * @return WuBookAuth
     */
    public function auth()
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookAuth($this->config, $this->cache, $client);
    }

    public function availability($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookAvailability($this->config, $this->cache, $client, $token);
    }

    public function cancellation_policies($token = null)
    {

    }

    public function channel_manager($token = null)
    {

    }

    public function corporate_functions($token = null)
    {

    }

    public function extras($token = null)
    {

    }

    public function prices($token = null)
    {

    }

    public function reservations($token = null)
    {

    }

    public function restrictions($token = null)
    {

    }

    /**
     * Rooms API
     *
     * @return WuBookAuth
     */
    public function rooms($token = null)
    {
        // Setup client
        $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());

        return new WuBookRooms($this->config, $this->cache, $client, $token);
    }

    public function transactions($token = null)
    {

    }

    /**
     * Username getter.
     *
     * @return string
     */
    function get_username()
    {
        return $this->username;
    }

    /**
     * Password getter.
     *
     * @return string
     */
    function get_password()
    {
        return $this->password;
    }

    /**
     * Provider key getter.
     *
     * @return string
     */
    function get_provider_key()
    {
        return $this->provider_key;
    }

    /**
     * Client getter.
     *
     * @return PhpXmlRpc\Client
     */
    function get_client()
    {
        return $this->client;
    }

}
