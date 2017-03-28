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
 * Description of WuBookRestrictions
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookRestrictions extends WuBookApi
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
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_add_rplan
     *
     * @param string $name
     * @param int $compact 0|1
     * @return mixed
     */
    public function rplan_add_rplan($name, $compact = 1)
    {
        return $this->call_method($this->token, 'rplan_add_rplan', [$name, $compact]);
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_rplans
     *
     * @return mixed
     */
    public function rplan_rplans()
    {
        return $this->call_method($this->token, 'rplan_rplans');
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_del_rplan
     *
     * @param int $id
     * @return mixed
     */
    public function rplan_del_rplan($id)
    {
        return $this->call_method($this->token, 'rplan_del_rplan', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_rename_rplan
     *
     * @param int $id
     * @return mixed
     */
    public function rplan_rename_rplan($id, $name)
    {
        return $this->call_method($this->token, 'rplan_rename_rplan', [$id, $name]);
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_update_rplan_rules
     *
     * @param int $id
     * @param array $rules
     * @return mixed
     */
    public function rplan_update_rplan_rules($id, $rules)
    {
        return $this->call_method($this->token, 'rplan_update_rplan_rules', [$id, $rules]);
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_update_rplan_values
     *
     * @param int $id
     * @param string $dfrom
     * @param array $values
     * @return mixed
     */
    public function rplan_update_rplan_values($id, $dfrom, $values)
    {
        return $this->call_method($this->token, 'rplan_update_rplan_values', [$id, $dfrom, $values]);
    }

    /**
     * http://tdocs.wubook.net/wired/rstrs.html#rplan_get_rplan_values
     *
     * @param string $dfrom
     * @param string $dto
     * @param array $rpids
     * @return mixed
     */
    public function rplan_get_rplan_values($dfrom, $dto, $rpids = [])
    {
        return $this->call_method($this->token, 'rplan_get_rplan_values', [$dfrom, $dto, $rpids]);
    }
}
