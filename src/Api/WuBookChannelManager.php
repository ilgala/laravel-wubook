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
 * Description of WuBookChannelManager
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookChannelManager extends WuBookApi
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
     * http://tdocs.wubook.net/wired/woodoo.html#get_channel_symbols
     *
     * @return mixed
     */
    public function get_channel_symbols()
    {
        return $this->call_method($this->token, 'get_channel_symbols', [], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#get_otas
     *
     * @return mixed
     */
    public function get_otas()
    {
        return $this->call_method($this->token, 'get_otas', []);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#tag_ota
     *
     * @param int $chid
     * @param string $tag
     * @return mixed
     */
    public function tag_ota($chid, $tag)
    {
        return $this->call_method($this->token, '', [$chid, $tag]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#new_ota
     *
     * @param int $ctype
     * @param string $tag
     * @return mixed
     */
    public function new_ota($ctype, $tag = '')
    {
        return $this->call_method($this->token, '', [$ctype, $tag]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#ota_running
     *
     * @param int $chid
     * @return mixed
     */
    public function ota_running($chid)
    {
        return $this->call_method($this->token, 'ota_running', [$chid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#fetch_rsrv_errors
     *
     * @return mixed
     */
    public function fetch_rsrv_errors()
    {
        return $this->call_method($this->token, 'fetch_rsrv_errors');
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_start_procedure
     *
     * @param int $chid
     * @param int $bhid
     * @return mixed
     */
    public function bcom_start_procedure($chid, $bhid)
    {
        return $this->call_method($this->token, 'bcom_start_procedure', [$chid, $bhid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_confirm_activation
     *
     * @param int $chid
     * @return mixed
     */
    public function bcom_confirm_activation($chid)
    {
        return $this->call_method($this->token, 'bcom_confirm_activation', [$chid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_init_channel
     *
     * @param int $chid
     * @param string $currency
     * @return mixed
     */
    public function bcom_init_channel($chid, $currency)
    {
        return $this->call_method($this->token, 'bcom_init_channel', [$chid, $currency]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_rooms_rates
     *
     * @param int $chid
     * @return mixed
     */
    public function bcom_rooms_rates($chid)
    {
        return $this->call_method($this->token, 'bcom_rooms_rates', [$chid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_set_room_mapping
     *
     * @param int $chid
     * @param array $rmap
     * @param int $singlemap 0|1
     * @return mixed
     */
    public function bcom_set_room_mapping($chid, $rmap, $singlemap = 0)
    {
        return $this->call_method($this->token, 'bcom_set_room_mapping', [$chid, $rmap, $singlemap]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_set_rate_mapping
     *
     * @param int $chid
     * @param array $rmap
     * @return mixed
     */
    public function bcom_set_rate_mapping($chid, $rmap)
    {
        return $this->call_method($this->token, 'bcom_set_rate_mapping', [$chid, $rmap]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_read_allotments
     *
     * @param int $chid
     * @param string $dfrom
     * @param int $days
     * @return mixed
     */
    public function bcom_read_allotments($chid, $dfrom, $days)
    {
        return $this->call_method($this->token, '', [$chid, $dfrom, $days]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_notify_noshow
     *
     * @param string $rcode
     * @return mixed
     */
    public function bcom_notify_noshow($rcode)
    {
        return $this->call_method($this->token, 'bcom_notify_noshow', [$rcode]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#bcom_notify_invalid_cc
     *
     * @param string $rcode
     * @return mixed
     */
    public function bcom_notify_invalid_cc($rcode)
    {
        return $this->call_method($this->token, 'bcom_notify_invalid_cc', [$rcode]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_start_procedure
     *
     * @param int $chid
     * @param int $ehid
     * @return mixed
     */
    public function exp_start_procedure($chid, $ehid)
    {
        return $this->call_method($this->token, 'exp_start_procedure', [$chid, $ehid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_vat_models
     *
     * @return mixed
     */
    public function exp_vat_models()
    {
        return $this->call_method($this->token, 'exp_vat_models', [], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_init_channel
     *
     * @param int $chid
     * @param string $currency
     * @param float $fee
     * @param float $vat_taxes
     * @return mixed
     */
    public function exp_init_channel($chid, $currency, $fee, $vat_taxes)
    {
        return $this->call_method($this->token, 'exp_init_channel', [$chid, $currency, $fee, $vat_taxes]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_rooms_rates
     *
     * @param int $chid
     * @return mixed
     */
    public function exp_rooms_rates($chid)
    {
        return $this->call_method($this->token, 'exp_rooms_rates', [$chid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_set_room_mapping
     *
     * @param int $chid
     * @param array $rmap
     * @param array $allots
     * @return mixed
     */
    public function exp_set_room_mapping($chid, $rmap, $allots = [])
    {
        return $this->call_method($this->token, 'exp_set_room_mapping', [$chid, $rmap, $allots]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_set_rate_mapping
     *
     * @param int $chid
     * @param array $rmap
     * @return mixed
     */
    public function exp_set_rate_mapping($chid, $rmap)
    {
        return $this->call_method($this->token, 'exp_set_rate_mapping', [$chid, $rmap]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#exp_set_preferences
     *
     * @param int $chid
     * @param boolean $hct
     * @param string $minstay_error_behaviour
     * @param string $minstay_type
     * @param string $last_rate
     * @return mixed
     */
    public function exp_set_preferences($chid, $hct, $minstay_error_behaviour, $minstay_type, $last_rate = '')
    {
        return $this->call_method($this->token, 'exp_set_preferences', [$chid, $hct, $minstay_error_behaviour, $minstay_type, $last_rate]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#woodoo_suspended_commands
     *
     * @return mixed
     */
    public function woodoo_suspended_commands()
    {
        return $this->call_method($this->token, 'woodoo_suspended_commands');
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#woodoo_executed_commands
     *
     * @param string $day
     * @param boolean|int $chid
     * @return mixed
     */
    public function woodoo_executed_commands($day, $chid = false)
    {
        return $this->call_method($this->token, 'woodoo_executed_commands', [$day, $chid]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#woodoo_cancel_suspended
     *
     * @param array $trackings
     * @return mixed
     */
    public function woodoo_cancel_suspended($trackings)
    {
        return $this->call_method($this->token, 'woodoo_cancel_suspended', [$trackings]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#woodoo_relaunch_suspended
     *
     * @param array $trackings
     * @return mixed
     */
    public function woodoo_relaunch_suspended($trackings)
    {
        return $this->call_method($this->token, 'woodoo_relaunch_suspended', [$trackings]);
    }

    /**
     * http://tdocs.wubook.net/wired/woodoo.html#last_room_channels
     *
     * @param array $up_channels
     * @return mixed
     */
    public function last_room_channels($up_channels = [])
    {
        return $this->call_method($this->token, 'last_room_channels', [$up_channels]);
    }
}
