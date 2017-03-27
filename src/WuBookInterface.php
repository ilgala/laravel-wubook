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

/**
 *
 * @author ilgala
 */
interface WuBookInterface
{

    /**
     * @var string
     */
    const ENDPOINT = 'https://wubook.net/xrws/';

    /**
     * @var array
     */
    const FETCH_ROOMS = ['max_calls' => 120, 'time_window' => 86400];

    /**
     * @var array
     */
    const FETCH_BOOKINGS_CODES = ['max_calls' => 24, 'time_window' => 3600];

    /**
     * @var array
     */
    const FETCH_BOOKINGS = ['max_calls' => 288, 'time_window' => 43200];

    /**
     * @var array
     */
    const RPLAN_RPLANS = ['max_calls' => 240, 'time_window' => 86400];

    /**
     * @var array
     */
    const FETCH_ROOMS_VALUES = ['max_calls' => 240, 'time_window' => 43200];

    /**
     * @var array
     */
    const FETCH_RSRV_ERRORS = ['max_calls' => 12, 'time_window' => 3600];

    /**
     * @var array
     */
    const BCOM_READ_ALLOTMENTS = ['max_calls' => 95, 'time_window' => 86400];

    /**
     * @var array
     */
    const FETCH_CC = ['max_calls' => 40, 'time_window' => 3600];

    /**
     * @var array
     */
    const GET_PLANS = ['max_calls' => 120, 'time_window' => 86400];

    /**
     * @var array
     */
    const RPLAN_GET_RPLAN_VALUES = ['max_calls' => 240, 'time_window' => 43200];

}
