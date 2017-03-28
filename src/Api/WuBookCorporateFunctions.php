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
 * Description of WuBookCorporateFunctions
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookCorporateFunctions extends WuBookApi
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
     * http://tdocs.wubook.net/wired/corps.html#corporate_fetch_accounts
     *
     * @param string $acode
     * @return mixed
     */
    public function corporate_fetch_accounts($acode = null)
    {
        $data = [];

        if (!empty($acode)) {
            array_push($data, $acode);
        }

        return $this->call_method($this->token, 'corporate_fetch_accounts', $data, ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_get_providers_info.
     *
     * @param array $acodes
     * @return mixed
     */
    public function corporate_get_providers_info($acodes = [])
    {
        return $this->call_method($this->token, 'corporate_get_providers_info', [$acodes], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_fetch_channels
     *
     * @return mixed
     */
    public function corporate_fetch_channels()
    {
        return $this->call_method($this->token, 'corporate_fetch_channels');
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_get_channels
     *
     * @param array $filters
     * @return mixed
     */
    public function corporate_get_channels($filters = [])
    {
        return $this->call_method($this->token, 'corporate_get_channels', [$filters]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_fetchable_properties
     *
     * @return mixed
     */
    public function corporate_fetchable_properties()
    {
        return $this->call_method($this->token, 'corporate_fetchable_properties', [], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_new_property
     *
     * @param string $lodg
     * @param boolean $woodoo_only
     * @param string $acode
     * @return mixed
     */
    public function corporate_new_property($lodg, $woodoo_only, $acode)
    {
        return $this->call_method($this->token, 'corporate_new_property', [$lodg, $woodoo_only, $acode]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_new_account_and_property
     *
     * @param string $lodg
     * @param boolean $woodoo_only
     * @param string $acode
     * @return mixed
     */
    public function corporate_new_account_and_property($lodg, $woodoo_only, $acode)
    {
        return $this->call_method($this->token, 'corporate_new_account_and_property', [$lodg, $woodoo_only, $acode]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_renew_booking
     *
     * @param string $months
     * @param int $pretend
     * @return mixed
     */
    public function corporate_renew_booking($months, $pretend = 1)
    {
        return $this->call_method($this->token, 'corporate_renew_booking', [$months, $pretend]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_renew_channels
     *
     * @param array $channels
     * @param int $pretend 0|1
     * @return mixed
     */
    public function corporate_renew_channels($channels, $pretend = 1)
    {
        return $this->call_method($this->token, 'corporate_renew_channels', [$channels, $pretend]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_set_autorenew_wb
     *
     * @param integer $v 0|1
     * @return mixed
     */
    public function corporate_set_autorenew_wb($v)
    {
        return $this->call_method($this->token, 'corporate_set_autorenew_wb', [$v]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_set_autorenew_wo
     *
     * @param array $lchans
     * @param int $v 0|1
     * @return mixed
     */
    public function corporate_set_autorenew_wo($lchans, $v)
    {
        return $this->call_method($this->token, 'corporate_set_autorenew_wo', [$lchans, $v]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_balance_transactions
     *
     * @return mixed
     */
    public function corporate_balance_transactions()
    {
        return $this->call_method($this->token, 'corporate_balance_transactions', [], ['token' => $this->get_token($this->token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/corps.html#corporate_balance_details
     *
     * @param int $transactionId
     * @return mixed
     */
    public function corporate_balance_details($transactionId)
    {
        return $this->call_method($this->token, 'corporate_balance_details', [$transactionId], ['token' => $this->get_token($this->token)]);
    }

}
