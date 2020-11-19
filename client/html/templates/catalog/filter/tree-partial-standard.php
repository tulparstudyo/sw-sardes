<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();


/** client/html/catalog/tree/url/target
 * Destination of the URL where the controller specified in the URL is known
 *
 * The destination can be a page ID like in a content management system or the
 * module of a software development framework. This "target" must contain or know
 * the controller that should be called by the generated URL.
 *
 * @param string Destination of the URL
 * @since 2019.01
 * @category Developer
 * @see client/html/catalog/tree/url/controller
 * @see client/html/catalog/tree/url/action
 * @see client/html/catalog/tree/url/config
 */
$target = $this->config( 'client/html/catalog/tree/url/target' );

$controller = $this->config( 'client/html/catalog/tree/url/controller', 'catalog' );

$action = $this->config( 'client/html/catalog/tree/url/action', 'list' );

$config = $this->config( 'client/html/catalog/tree/url/config', [] );

?>
<?php foreach( $this->get( 'nodes', [] ) as $item_key=>$item ) : ?>
<?php if( $item->getStatus() > 0 ) : ?>
<a class="accordion__title collapsed" href="#<?= $enc->attr( $this->url( $item->getTarget() ?: $target, $controller, $action, array_merge( $this->get( 'params', [] ), ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], $config ) ); ?>"  data-toggle="collapse" data-target="#item-<?=$item_key?>" aria-expanded="false">
<?= $enc->html( $item->getName(), $enc::TRUST ); ?><i class="far fa-chevron-down"></i></a>
<?=count( $item->getChildren() )?>***
<?php if( count( $item->getChildren() ) > 0 ) : ?>
<div id="item-<?=$item_key?>" class="collapse">
    <ul class="accordion__category-list">
        <li><a href="#">Dresses</a></li>
        <li><a href="#">Jackets &amp; Coats</a></li>
        <li><a href="#">Sweaters</a></li>
        <li><a href="#">Jeans</a></li>
        <li><a href="#">Blouses &amp; Shirts</a></li>
    </ul>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
