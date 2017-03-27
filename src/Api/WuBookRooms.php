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

use IlGala\LaravelWubook\Api\WuBookApi;
use IlGala\LaravelWubook\Exceptions\WuBookException;

/**
 * This is the WuBook rooms api class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookRooms extends WuBookApi
{

    /**
     * @var string
     */
    private $token;

    /**
     * Create a new WuBookRooms Instance.
     */
    public function __construct($config, $cache, $client, $token = null)
    {
        parent::__construct($config, $cache, $client);

        $this->token = $token;
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#fetching-existing-rooms
     *
     * @param int $ancillary 0|1
     * @return array
     * @throws WuBookException
     */
    public function fetch_rooms($ancillary = 0)
    {
        $response = $this->call_method($this->token, 'fetch_rooms', [$ancillary]);

        return $response['has_error'] ? $response : $response['data'];
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#adding-a-new-room.
     *
     * @param array $data
     * @return array
     * @throws WuBookException
     */
    public function new_room($data, $virtual = false)
    {
        if ($virtual) {
            $response = $this->call_method($this->token, 'new_virtual_room', $data);
        } else {
            $response = $this->call_method($this->token, 'new_room', $data);
        }

        return $response['has_error'] ? $response : $response['data'];
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#modifying-a-room.
     *
     * The method will return a boolean only if response has no error.
     *
     * @param array $data
     * @param array|boolean $virtual
     * @return type
     */
    public function mod_room($data, $virtual = false)
    {
        if ($virtual) {
            $response = $this->call_method($this->token, 'mod_virtual_room', $data);
        } else {
            $response = $this->call_method($this->token, 'mod_room', $data);
        }

        return $response['has_error'] ? $response : true;
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#removing-a-room
     *
     * The method will return a boolean only if response has no error.
     *
     * @param int $id
     * @return boolean|string
     */
    public function del_room($id)
    {
        $response = $this->call_method($this->token, 'del_room', [$id]);

        return $response['has_error'] ? $response : true;
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#other-functions
     *
     * @param int $id
     * @return array
     */
    public function room_images($id)
    {
        $response = $this->call_method($this->token, 'room_images', [$id]);

        return $response['has_error'] ? $response : $response['data'];
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#update-functions
     *
     * The method will return a boolean only if response has no error.
     *
     * @param string $url
     * @return boolean|string
     */
    public function push_update_activation($url)
    {
        $response = $this->call_method($this->token, 'push_update_activation', [$url]);

        return $response['has_error'] ? $response : true;
    }

    /**
     * http://tdocs.wubook.net/wired/rooms.html#update-functions
     *
     * @return string
     */
    public function push_update_url()
    {
        $response = $this->call_method($this->token, 'push_update_url');

        return $response['has_error'] ? $response : $response['data'];
    }

}
