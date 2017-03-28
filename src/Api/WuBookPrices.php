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
 * Description of WuBookPrices
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBookPrices extends WuBookApi
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
     * http://tdocs.wubook.net/wired/prices.html#add_pricing_plan
     *
     * @param string $name
     * @param int $daily 0|1
     * @return mixed
     */
    public function add_pricing_plan($name, $daily = 1)
    {
        return $this->call_method($this->token, 'add_pricing_plan', [$name, $daily]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#add_vplan
     *
     * @param string $name
     * @param int $id
     * @param int $dtype -2|-1|1|2
     * @param float|int $value
     * @return mixed
     */
    public function add_vplan($name, $id, $dtype, $value)
    {
        return $this->call_method($this->token, 'add_pricing_plan', [$name, $id, $dtype, $value]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#del_plan
     *
     * @param int $id
     * @return mixed
     */
    public function del_plan($id)
    {
        return $this->call_method($this->token, 'del_plan', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#update_plan_name
     *
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function update_plan_name($id, $name)
    {
        return $this->call_method($this->token, 'update_plan_name', [$id, $name]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#get_pricing_plans
     *
     * @return mixed
     */
    public function get_pricing_plans()
    {
        return $this->call_method($this->token, 'get_pricing_plans');
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#update_plan_rack
     *
     * @param int $id
     * @param array $rack
     * @return mixed
     */
    public function update_plan_rack($id, $rack)
    {
        return $this->call_method($this->token, 'update_plan_rack', [$id, $rack]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#mod_vplans
     *
     * @param array $plans
     * @return mixed
     */
    public function mod_vplans($plans)
    {
        return $this->call_method($this->token, 'mod_vplans', [$plans]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#update_plan_prices
     *
     * @param int $id
     * @param string $dfrom
     * @param array $prices
     * @return mixed
     */
    public function update_plan_prices($id, $dfrom, $prices)
    {
        return $this->call_method($this->token, 'update_plan_prices', [$id, $dfrom, $prices]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#fetch_plan_prices
     *
     * @param int $id
     * @param string $dfrom
     * @param string $dto
     * @param array $rooms
     * @return mixed
     */
    public function fetch_plan_prices($id, $dfrom, $dto, $rooms = [])
    {
        return $this->call_method($this->token, 'fetch_plan_prices', [$id, $dfrom, $dto, $rooms = []]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#convert_to_daily_plan
     *
     * @param int $id
     * @return mixed
     */
    public function convert_to_daily_plan($id)
    {
        return $this->call_method($this->token, 'convert_to_daily_plan', [$id]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#update_plan_periods
     *
     * @param int $id
     * @param array $periods
     * @return mixed
     */
    public function update_plan_periods($id, $periods)
    {
        return $this->call_method($this->token, 'update_plan_periods', [$id, $periods]);
    }

    /**
     * http://tdocs.wubook.net/wired/prices.html#delete_periods
     *
     * @param int $id
     * @param array $periods
     * @return mixed
     */
    public function delete_periods($id, $periods)
    {
        return $this->call_method($this->token, 'delete_periods', [$id, $periods]);
    }

}
