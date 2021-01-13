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

<ul class="sidebar__menu-collapse level-<?= $enc->attr( $this->get( 'level', 0 ) ); ?>  ">
	<?php foreach( $this->get( 'nodes', [] ) as $item ) : ?>
		<?php if( $item->getStatus() > 0 ) : ?>

			<li class="sidebar__menu-collapse-list cat-item catid-<?= $enc->attr( $item->getId()
				. ( $item->hasChildren() ? ' withchild' : ' nochild' )
				. ( $this->get( 'path', map() )->getId()->last() == $item->getId() ? ' active' : '' )
				. ' catcode-' . $item->getCode() . ' ' . $item->getConfigValue( 'css-class' ) ); ?>"
				data-id="<?= $item->getId(); ?>" >
               
				<a class="accordion__title cat-item" href="<?= $enc->attr( $this->url( $item->getTarget() ?: $target, $controller, $action, array_merge( $this->get( 'params', [] ), ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], $config ) ); ?>"><!--
					-->
				<span class="cat-name"><?= $enc->html( $item->getName(), $enc::TRUST ); ?></span><i class="far fa-chevron-down"></i></a>
			
				<?php  if($item->hasChildren()){ ?>
                    <ul class="dropdown kenne-dropdown">
                             
                        <?php foreach($item->getChildren() as $itemk ){?>
                              <li>          
                              <a href="<?= $enc->attr( $this->url( $itemk ->getTarget() ?: $target, $controller, $action, array_merge( $this->get( 'params', [] ), ['f_name' => $itemk ->getName( 'url' ), 'f_catid' => $itemk ->getId()] ), [], $config ) ); ?>">
                    	       <?=$itemk->getName();?></a> 
                        <?php } ?>
                
                    </ul>     
                    <?php } ?>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
</ul>



