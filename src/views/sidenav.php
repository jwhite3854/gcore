<nav class="uk-navbar-primary uk-margin-bottom uk-section-primary" uk-navbar>
    <div class="uk-navbar-left">
        <a href="<?php echo $data['base_url'] ?>" class="logo uk-navbar-item uk-logo">
            <span class="logo-lg <?php echo ( $data['request_uri'] === '/' ? ' active' : '' ) ?>">
                <?php echo APP_MAIN_TITLE ?>
            </span>
        </a>
    </div>
    <div class="uk-navbar-right">
        <div class="uk-navbar-item">
            <a href="#offcanvas-slide" class="uk-button uk-button-default" uk-toggle>Menu</a>
        </div>
    </div>
</nav>

<div id="offcanvas-slide" uk-offcanvas>
    <div class="uk-offcanvas-bar uk-padding-remove">
        <nav class="uk-margin-bottom uk-background-secondary uk-light " uk-navbar>
            <div class="uk-navbar-left">
                <a href="<?php echo $data['base_url'] ?>" class="logo uk-navbar-item uk-logo">
                    <span class="logo-lg <?php echo ( $data['request_uri'] === '/' ? ' active' : '' ) ?>">
                        <?php echo APP_MAIN_TITLE ?>
                    </span>
                </a>
            </div>
        </nav>
        <div class="uk-padding">
        <ul class="uk-nav-parent-icon" uk-nav>
        <?php foreach ( $data['links'] as $key => $link ): ?>
            <?php if ( array_key_exists( $key, $data['children'] ) ): ?>
                <li class="uk-parent">
                    <a href="#"><?php echo $link['title'] ?></a>
                    <ul class="uk-nav-sub uk-nav-parent-icon" uk-nav>
                        <?php foreach ( $data['children'][$key] as $childkey => $child ): ?>
                            <?php if ( array_key_exists( $childkey, $data['grandChildren'] ) ): ?>
                                <li class="uk-parent">
                                    <a href="#" aria-expanded="false"><?php echo $child['title'] ?></a>
                                    <ul class="uk-nav-sub">
                                    <?php foreach ( $data['grandChildren'][$childkey] as $grandChild ): ?>
                                        <li><a href="<?php echo $grandChild['link_url'] ?>"><?php echo $grandChild['title'] ?></a></li>
                                    <?php endforeach; ?>
                                    </ul>
                                </li>
                                <?php else: ?>
                                <li>
                                    <a href="<?php echo $child['link_url'] ?>" aria-expanded="false">
                                        <span> <?php echo $child['title'] ?> </span>
                                    </a>
                                </li>
                            <?php endif; ?>
                    <?php endforeach; ?>
                    </ul>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo $link['link_url'] ?>">
                        <span> <?php echo $link['title'] ?> </span>
                    </a>
                </li>
            <?php endif; ?>          
        <?php endforeach ?>
            </ul>
        </div>
    </div>
</div>