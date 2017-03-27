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
class WuBookAvailability
{

    /**
     * @var string
     */
    private $token;

    /**
     * Create a new WuBookAvailability Instance.
     */
    public function __construct($config, $cache, $client, $token = null)
    {
        parent::__construct($config, $cache, $client);

        $this->token = $token;
    }

    /**
     * http://tdocs.wubook.net/wired/avail.html#updating-availability
     *
     * if dfrom param is not set the update_sparse_avail method will be called, update_avail method otherwise
     *
     * @param array $rooms
     * @param string $dfrom
     * @return type
     */
    public function update_avail($rooms, $dfrom = null)
    {
        if (empty($dfrom)) {
            $response = $this->call_method($this->token, 'update_sparse_avail', [$rooms]);
        } else {
            $response = $this->call_method($this->token, 'update_avail', [$dfrom, $rooms]);
        }

        return $response['has_error'] ? $response : $response['data'];
    }

    /**
     * http://tdocs.wubook.net/wired/avail.html#updating-availability
     *
     * if dfrom param is not set the update_sparse_avail method will be called, update_avail method otherwise
     *
     * @param array $rooms
     * @param string $dfrom
     * @return type
     */
    public function fetch_rooms_values($dfrom, $dto, $rooms = null)
    {
        // Setup data
        $data = [
            $dfrom,
            $dto
        ];

        if (!empty($rooms)) {
            array_push($data, $rooms);
        }

        $response = $this->call_method($this->token, 'fetch_rooms_values', $data);

        return $response['has_error'] ? $response : $response['data'];
    }

}
