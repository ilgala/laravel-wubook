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

class WuBookAuth
{

    /**
     *
     * @var array
     */
    private $credentials;

    /**
     * @var fXmlRpc\Client
     */
    private $client;

    /**
     * Create a new WuBookAuth Instance
     *
     * @param type $credentials
     * @param \fXmlRpc\Client $client
     */
    public function __construct($credentials, Client $client)
    {
        $this->credentials = $credentials;
        $this->client = $client;
    }

    /**
     * Acquire token.
     *
     * http://tdocs.wubook.net/wired/auth.html#acquiring-and-releasing-a-token
     *
     * @return String token
     */
    public function acquire_token()
    {
        // Setup request data
        $data = [
            $this->credentials['username'],
            $this->credentials['password'],
            $this->credentials['provider_key']
        ];

        try {
            // Retrieve response
            $response = $this->client->call('acquire_token', $data);

            // Check response
            if ($response[0] == 0) {
                // Success
                return $response[1];
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
     */
    public function release_token($token)
    {
        // Setup request data
        $data = [
            $token
        ];

        // Retrieve response
        try {
            return $this->client->call('release_token', $data);
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

    /**
     * The is_token_valid() function returns two information.
     * If (and only if) the ReturnCode is zero, it means that the token is valid.
     * In that case, the return value of the function is an integer and represents the number of times that this token has been used.
     *
     * http://tdocs.wubook.net/wired/auth.html#other-token-tools
     *
     * @param string $token
     * @return bool
     * @throws IlGala\WuBook\Exceptions\WuBookException
     */
    public function is_token_valid($token)
    {
        // Setup request data
        $data = [
            $token
        ];

        // Retrieve response
        try {
            return $this->client->call('is_token_valid', $data);
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
    public function provider_info($token)
    {
        // Setup request data
        $data = [
            $token
        ];

        // Retrieve response
        try {
            return $this->client->call('provider_info', $data);
        } catch (AbstractTransportException $error) {
            throw new WuBookException($error->getMessage(), $error->getCode(), $error);
        }
    }

}
