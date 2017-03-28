<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IlGala\LaravelWubook\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the wubook facade class.
 *
 * @author Filippo Galante <filippo.galante@b-ground.com>
 */
class WuBook extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wubook';
    }
}
