<?php

namespace App\Controllers;

use Jaw\GauntCore\Controller;

class apiController extends Controller {
    
    public function toggleFavorites(){
        
        $file = ArchiveApp::getConfig('file_base').'/assets/data/favs.json';
        $favsRaw = file_get_contents($file);
        $favsData = json_decode($favsRaw, true);
        $favs = $favsData['data'];

        $src = filter_input(INPUT_POST, "src");
        $srcID = md5($src);

        if ( $isRemove = array_key_exists($srcID, $favs) ) {
            unset($favs[$srcID]);
        } else {
            $favs[$srcID] = $src;
        }

        $favsData['data'] = $favs;

        file_put_contents($file, json_encode($favsData) );

        return $isRemove;
    }

    public function toggleFavoriteMode()
    {
        $enabled = filter_input(INPUT_POST, "enabled", FILTER_VALIDATE_BOOLEAN);
        Registry::set('api_favorites_enable_toggle', !$enabled);
    }

    public function clearAllFavorites()
    {
        $src = filter_input(INPUT_POST, "src");
        if ( $src === "1" ) {
            $favsData = array(
                'data' => array()
            );
    
            $file = ArchiveApp::getConfig('file_base').'/assets/data/favs.json';
            file_put_contents($file, json_encode($favsData) );
        }

        return $src;
    }
}