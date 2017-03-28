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
 * Description of WuBookTransactions
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookTransactions extends WuBookApi
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
     * http://tdocs.wubook.net/wired/transactions.html#balance_transactions
     *
     * @return mixed
     */
    public function balance_transactions()
    {
        return $this->call_method($this->token, 'balance_transactions', [], ['token' => $this->get_token($token)]);
    }

    /**
     * http://tdocs.wubook.net/wired/transactions.html#balance_details
     *
     * @param int $id
     * @return mixed
     */
    public function balance_details($id)
    {
        return $this->call_method($this->token, 'balance_details', [$id]);
    }

}
