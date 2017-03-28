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
 * Description of WuBookCancellationPolicies
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookCancellationPolicies extends WuBookApi
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
     * http://tdocs.wubook.net/wired/cpolicies.html#fetch_policies
     *
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_policies($ancillary = 0)
    {
        return $this->call_method($this->token, 'fetch_policies', [$ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/cpolicies.html#new_policy
     *
     * @param array $data
     * @return mixed
     */
    public function new_policy($data)
    {
        return $this->call_method($this->token, 'new_policy', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/cpolicies.html#mod_policy
     *
     * @param array $data
     * @return mixed
     */
    public function mod_policy($data)
    {
        return $this->call_method($this->token, 'mod_policy', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/cpolicies.html#del_policy
     *
     * @param int $id
     * @return mixed
     */
    public function del_policy($id)
    {
        return $this->call_method($this->token, 'del_policy', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/cpolicies.html#fetch_policy_calendar
     *
     * @param string $dfrom
     * @param string $dto
     * @return mixed
     */
    public function fetch_policy_calendar($dfrom, $dto)
    {
        return $this->call_method($this->token, 'fetch_policy_calendar', [$dfrom, $dto]);
    }

    /**
     * http://tdocs.wubook.net/wired/cpolicies.html#set_policy_calendar
     *
     * @param int $id
     * @param string $dfrom
     * @param string $dto
     * @return mixed
     */
    public function set_policy_calendar($id, $dfrom, $dto)
    {
        return $this->call_method($this->token, 'set_policy_calendar', [$id, $dfrom, $dto]);
    }
}
