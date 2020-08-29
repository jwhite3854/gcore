<?php

/**
 * Proprietary and confidential
 * Copyright (c) jWhite3854 2020 - All Rights Reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 *
 * @copyright 2020
 */
declare(strict_types=1);

namespace Jaw\GauntCore;

use Jaw\GauntCore\Request;

class Url
{
    public static function render( $uri, $params = array())
    {
        if ( App::$isDevMode ) {
            $param['dev_mode'] = 1;
        }

        $param_string = '';
        if ( count($params) > 0 ) {
            $param_string = '?' . http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        }

        return APP_DOMAIN.APP_REDIRECT_BASE . trim( $uri, '/' ) . $param_string;
    }

    public static function isActive($uri)
    {

    }

    public static function getCurrent()
    {
        return self::render($_SERVER["REQUEST_URI"]);
    }
}