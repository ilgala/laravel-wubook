<?php

/*
 * This file is part of Laravel WuBook.
 *
 * (c) Filippo Galante <filippo.galante@b-ground.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    /*
     * Account informations
     */
    'username' => 'your-user',
    'password' => 'your-password',
    'provider_key' => 'your-provider-key',
    'lcode' => 'your-lcode',
    /*
     * If `cache_token` is set to true, all the API function will use a cached value and automatically renew it if necessary.
     * The cache key for the token is 'wubook.token'. The package will store also a 'wubook.token.ops' key, in order to trace the number of calls made with current token,
     * in order to refresh it if the maximum number of operation has been reached.
     *
     * **Attention:** If `cache_token` is set to false, the package will not check if the token has exceeded the maximum number of operations!
     *
     * Please read http://tdocs.wubook.net/wired/policies.html
     */
    'cache_token' => true
];
