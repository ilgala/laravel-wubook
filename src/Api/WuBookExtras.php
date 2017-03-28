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
 * Description of WuBookExtras
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookExtras extends WuBookApi
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
     * http://tdocs.wubook.net/wired/extras.html#fetch_opportunities
     *
     * @param string $dfrom
     * @param string $dto
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_opportunities($dfrom, $dto, $ancillary = 0)
    {
        return $this->call_method($this->token, 'fetch_opportunities', [$dfrom, $dto, $ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#new_opportunity
     *
     * @param array $data
     * @return mixed
     */
    public function new_opportunity($data)
    {
        return $this->call_method($this->token, 'new_opportunity', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#mod_opportunity
     *
     * @param array $data
     * @return mixed
     */
    public function mod_opportunity($data)
    {
        return $this->call_method($this->token, 'mod_opportunity', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#del_opportunity
     *
     * @param int $id
     * @return mixed
     */
    public function del_opportunity($id)
    {
        return $this->call_method($this->token, 'del_opportunity', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#fetch_soffers
     *
     * @param string $dfrom
     * @param string $dto
     * @param int $ancillary
     * @return mixed
     */
    public function fetch_soffers($dfrom, $dto, $ancillary = 0)
    {
        return $this->call_method($this->token, 'fetch_soffers', [$dfrom, $dto, $ancillary]);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#new_soffer
     *
     * @param array $data
     * @return mixed
     */
    public function new_soffer($data)
    {
        return $this->call_method($this->token, 'new_soffer', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#mod_soffer
     *
     * @param array $data
     * @return mixed
     */
    public function mod_soffer($data)
    {
        return $this->call_method($this->token, 'mod_soffer', $data);
    }

    /**
     * http://tdocs.wubook.net/wired/extras.html#del_soffer
     *
     * @param int $id
     * @return mixed
     */
    public function del_soffer($id)
    {
        return $this->call_method($this->token, 'del_soffer', [$id]);
    }

}
