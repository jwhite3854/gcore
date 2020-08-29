<?php

use Jaw\GauntCore\Url;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo $data['meta'] ?>
        <link rel="stylesheet" href="<?php echo Url::render('/assets/css/uikit.min.css') ?>">
        <?php if ( count( $data['more_stylesheets'] ) ): ?>
            <?php foreach ( $data['more_stylesheets'] as $stylesheet ): ?>
                <link rel="stylesheet" href="<?php echo Url::render('assets/css/'.$stylesheet['href']) ?>" media="<?php echo $stylesheet['media'] ?>">
            <?php endforeach; ?>
        <?php endif; ?>
        <link rel="stylesheet" href="<?php echo Url::render('/assets/css/app.css') ?>">
    </head>
    <body class="loading ">
        <?php echo $data['nav'] ?>
        <div class="uk-section uk-section-secondary">
            <div class="uk-container"><?php echo $data['content'] ?></div>
        </div>
        <?php echo $data['footer'] ?>
        <script src="<?php echo Url::render('/assets/js/uikit.min.js') ?>"></script>
        <script src="<?php echo Url::render('/assets/js/app.js') ?>"></script>
        <?php if ( count( $data['more_scripts'] ) ): ?>
            <?php foreach ( $data['more_scripts'] as $script ): ?>
                <script src="<?php echo Url::render('assets/js/'.$script['src']) ?>" <?php echo $script['async'] ?> <?php echo $script['defer'] ?> ></script>
            <?php endforeach; ?>
        <?php endif; ?>
    </body>
</html>