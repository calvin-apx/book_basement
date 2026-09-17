<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        'appointments/donate/donateStore',
        'appointments/buy/buyStore',
        'cartList/store',
        'cartList/remove',
        'favorites/store',
        'favorites/remove',
        'user/register',
        'user/checkUser',
        'products/findFiltered'
    ];
}
