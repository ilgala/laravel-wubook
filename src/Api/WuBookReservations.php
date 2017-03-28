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
 * Description of WuBookReservations
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookReservations extends WuBookApi
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
     * http://tdocs.wubook.net/wired/fetch.html#push_activation
     *
     * @param string $url
     * @param int $test
     * @return mixed
     */
    public function push_activation($url, $test = 0)
    {
        return $this->call_method($this->token, 'push_activation', [$url, $test]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#push_url
     *
     * @return mixed
     */
    public function push_url()
    {
        return $this->call_method($this->token, 'push_url');
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#fetch_new_bookings
     *
     * @param int $ancillary
     * @param int $mark
     * @return mixed
     */
    public function fetch_new_bookings($ancillary = 0, $mark = 1)
    {
        return $this->call_method($this->token, 'fetch_new_bookings', [$ancillary, $mark]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#mark_bookings
     *
     * @param array $reservations
     * @return mixed
     */
    public function mark_bookings($reservations = [])
    {
        return $this->call_method($this->token, 'mark_bookings', [$reservations]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#fetch_bookings
     *
     * @param string $dfrom
     * @param string $dto
     * @param int $oncreated
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_bookings($dfrom = '', $dto = '', $oncreated = 1, $ancillary = 0)
    {
        return $this->call_method($this->token, 'fetch_bookings', [$dfrom, $dto, $oncreated, $ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#fetch_bookings_codes
     *
     * @param string $dfrom
     * @param string $dto
     * @param int $oncreated
     * @return mixed
     */
    public function fetch_bookings_codes($dfrom, $dto, $oncreated = 1)
    {
        return $this->call_method($this->token, 'fetch_bookings_codes', [$dfrom, $dto, $oncreated]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#fetch_booking
     *
     * @param string $rcode
     * @param boolean $ancillary
     * @return mixed
     */
    public function fetch_booking($rcode, $ancillary = false)
    {
        return $this->call_method($this->token, 'fetch_booking', [$rcode, $ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/fetch.html#get_fount_symbols
     *
     * @return mixed
     */
    public function get_fount_symbols()
    {
        return $this->call_method($this->token, 'get_fount_symbols', [], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/rsrvs.html#cancel_reservation
     *
     * @param string $rcode
     * @param string $reason
     * @return mixed
     */
    public function cancel_reservation($rcode, $reason = '')
    {
        return $this->call_method($this->token, 'cancel_reservation', [$rcode, $reason]);
    }

    /**
     * http://tdocs.wubook.net/wired/rsrvs.html#new_reservation
     *
     * @param array $data
     * @return mixed
     */
    public function new_reservation($data)
    {
        return $this->call_method($this->token, 'new_reservation', $data);
    }
}
