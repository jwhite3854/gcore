<?php

class MediaCollector {

    public static function getImages( $uri )
    {
        $jpgPath = APP_ROOT.'/images/'.$uri.'/*.[jJ][pP][gG]'; 
        return self::getFiles( $jpgPath );
    }

    public static function getMovies( $uri )
    {
        $filePath = APP_ROOT.'/images/'.$uri.'/*.mp4'; 
        $mp4Files = self::getFiles( $filePath );

        $filePath = APP_ROOT.'/images/'.$uri.'/*.MOV'; 
        $movFiles = self::getFiles( $filePath );
        
        return $mp4Files + $movFiles;
    }

    private static function getFiles( $filePath )
    {
        $locations = array();

        $files = glob( $filePath );
        //$movies = array_reverse($movies);

        $baseUrl = Url::render('/');
        $fileBase = ArchiveApp::getConfig('file_base');

        foreach ( $files as $file ) {
            $locations[] = str_replace($fileBase.'/', $baseUrl, $file);
        }

        return $locations;

    }

}