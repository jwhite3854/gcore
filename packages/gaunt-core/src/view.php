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

class View
{
    protected $data;
    protected $path;

    /**
     * View constructor.
     * @param $data
     * @param $path
     */
    public function __construct( &$data, $path )
    {
        if( file_exists($path) ) {
            $this->path = $path;   
        } 
            
        $this->data = $data;
    }

    public function render()
    {
        $data = &$this -> data;
        if ( !empty( $this->path ) ) {
            ob_start();
            require $this->path;
            $content = ob_get_clean();
        } else {
            $content = 'Template does not exist';
        }

        return $content;
    }
}