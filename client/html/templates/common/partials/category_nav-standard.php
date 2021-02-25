<?php
$nav = $this->get( 'nav', [] );
?>
<ul >
  <?php
  if ( $nav[ 'categories' ] ) {
      foreach ( $nav[ 'categories' ] as $item ) {
          if ( $item->getStatus() > 0 ) { ?>
			  <li class="nav-item"><a class="nav-link" href="<?= $this->url( $item->getTarget() ?: $this->config( 'client/html/catalog/tree/url/target' ), 'catalog', 'list', array_merge( $this->get( 'params', [] ), ['f_name' => $item->getName( 'url' ), 'f_catid' => $item->getId()] ), [], [] ) ; ?>">
				<?=$item->getName()?>
				</a> </li>
		  <?php
		  }
	  }
  }
  ?>
</ul>
