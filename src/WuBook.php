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

class WuBook implements WuBookInterface
{

    /**
     * @var array
     */
    private $credentials;

    /**
     * @var PhpXmlRpc\Client
     */
    private $client;

    /**
     * IlGala\WuBook\Api\WuBookAuth
     */
    private $auth;

    /**
     * Create a new WuBook Instance
     */
    public function __construct(Repository $config, Client $client = null)
    {
        // Setup credentials
        $this->credentials = array_only($config->get('wubook'), ['username', 'password', 'provider_key']);

        // Credentials check
        if (!array_key_exists('username', $this->credentials) || !array_key_exists('password', $this->credentials) || !array_key_exists('provider_key', $this->credentials)) {
            throw new WuBookException('Credentials are required!');
        }

        // Setup client
        if (!$client) {
            $client = new Client(self::ENDPOINT, null, new NativeParser(), new NativeSerializer());
        }

        $this->client = $client;
    }

    public function auth()
    {
        return new WuBookAuth($this->credentials, $this->client);
    }

    public function availability()
    {

    }

    public function cancellation_policies()
    {

    }

    public function channel_manager()
    {

    }

    public function corporate_functions()
    {

    }

    public function extras()
    {

    }

    public function prices()
    {

    }

    public function reservations()
    {

    }

    public function restrictions()
    {

    }

    public function rooms()
    {

    }

    public function transactions()
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
