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

/**
 * This is the WuBook rooms api class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookAvailability extends WuBookApi
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
     * http://tdocs.wubook.net/wired/avail.html#update_avail
     * http://tdocs.wubook.net/wired/avail.html#update_sparse_avail
     *
     * if dfrom param is not set the update_sparse_avail method will be called, update_avail method otherwise
     *
     * @param array $rooms
     * @param string $dfrom
     * @return mixed
     */
    public function update_avail($rooms, $dfrom = null)
    {
        if (empty($dfrom)) {
            return $this->call_method($this->token, 'update_sparse_avail', [$rooms]);
        } else {
            return $this->call_method($this->token, 'update_avail', [$dfrom, $rooms]);
        }
    }

    /**
     * http://tdocs.wubook.net/wired/avail.html#fetch_rooms_values
     *
     * if dfrom param is not set the update_sparse_avail method will be called, update_avail method otherwise
     *
     * @param array $rooms
     * @param string $dfrom
     * @return mixed
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

        return $this->call_method($this->token, 'fetch_rooms_values', $data);
    }

}
