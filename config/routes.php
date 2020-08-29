<?php

/**
 * Add the routes needed for the app.  
 * 
 * 'Homepage' already assumed to exist at home (controller) / index (action)
 * 
 */

$routes = [
    ['videos', 'home', 'videos', true ],
    ['collection', 'home', 'index', true ],
    ['collection/aaaaa', 'home', 'index', true ],
    ['collection/aaaaa/zzzzz', 'home', 'index', true ],
    ['collection/bbbbb', 'home', 'index', true ],
    ['api/favorites/get', 'api', 'getFavorites', false ],
];