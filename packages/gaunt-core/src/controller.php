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

use Jaw\GauntCore\View;
use Jaw\GauntCore\Url;

class Controller
{
    protected $data;
    private $model;
    private $action;
    private $template;
    private $params;

    const VIEW_PATH = APP_ROOT.'/src/views';

    /**
     * Controller constructor.
     * @param $model
     * @param $action
     * @param $params
     */
    public function __construct( $model, $action, $params = array())
    {
        $this->model = $model;
        $this->action = $action;
        $this->template = $model . '/' . $action;
        $this->params = $params;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }

    /** 
     * Render controller, Web view is rendered if no path specified.
     * 
     * @param array $data               Used in the body template
     * @param array $metaData           Used in the head template
     * @param array $moreStylesheets 
     * @param array $moreScripts
     * 
     * @return string
     */
    function render( $data = array(), $metaData = array(), $moreStylesheets = array(), $moreScripts = array() )
    {
        $this->setMetaDataDefaults($metaData);

        //Layout Paths
        $layoutPath = self::VIEW_PATH . '/layout.php';
        $layoutNavPath = self::VIEW_PATH . '/sidenav.php';
        $layoutFooterPath = self::VIEW_PATH . '/footer.php';
        $layoutMetaPath = self::VIEW_PATH . '/meta.php';

        $bodyLayoutPath = self::VIEW_PATH . '/' . $this->template .'.php';

        //Create Meta / Nav / Footer / Body Views Instances
        $bodyView = new View( $data, $bodyLayoutPath );
        $navView = new View( $this->getNavData(), $layoutNavPath );
        $footerView = new View( $footerData, $layoutFooterPath );
        $metaView = new View( $metaData, $layoutMetaPath );

        //Creates an array that contains layouts required data 
        $renderData = array(
            'meta' => $metaView->render(), 
            'nav' => $navView->render(), 
            'content' => $bodyView->render(), 
            'footer' => $footerView->render(), 
            'more_stylesheets' => $moreStylesheets, 
            'more_scripts' => $moreScripts, 
        );

        //Render Full Layout
        $layoutView = new View($renderData, $layoutPath);

        return $layoutView->render();
    }

    private function setMetaDataDefaults(&$metaData)
    {
        if ( !array_key_exists('title', $metaData) ) {
            $metaData['title'] = APP_MAIN_TITLE;
        }
    }

    private function getNavData()
    {
        $request = App::getRequest();
        $routes = Router::getKeyedRoutes();
        
        $links = [];
        $children = [];
        $grandChildren = [];
        foreach ($routes as $path => $route) {
    
            $parts = explode('/', $path);
            $key = $parts[0];
            if ( $route['visible'] ) {
                $links[$key] = [
                    'title'     => ucwords(str_replace('-', ' ', $key)),
                    'link_url'      => Url::render($path)
                ];
            
                if ( count($parts) > 1 ) {
                    $key2 = $parts[1];
                    $children[$key][$key2] = [
                        'title' => ucwords(str_replace('-', ' ', $key2)),
                        'link_url' => Url::render($path)
                    ];
            
                    if (count($parts) > 2) {
                        $key3 = $parts[2];
                        $grandChildren[$key2][$key3] = [
                            'title' => ucwords(str_replace('-', ' ', $key3)),
                            'link_url' => Url::render($path)
                        ];
                    }
                }
            }
        }

        $navData = [
            'base_url' => Url::render('/') ,
            'request_uri' => $request->getUri(),
            'links' => $links,
            'children' => $children,
            'grandChildren' => $grandChildren
        ];
    
        return $navData;
    }
}