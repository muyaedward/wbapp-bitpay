<?php

namespace Muyaedward\WbappBitpay;

use Illuminate\Support\Facades\Facade;

/**
 * Class WbappBitpayFacade.
 */
class WbappBitpayFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wbapp-bitpay';
    }
}
