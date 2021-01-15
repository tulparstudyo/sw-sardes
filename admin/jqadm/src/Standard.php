<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2017-2020
 * @package Admin
 * @subpackage JQAdm
 */


namespace Aimeos\Admin\JQAdm\Swordbros\Sardes;

sprintf( 'sardes' ); // for translation

/**
 * Default implementation of sardes JQAdm client.
 *
 * @package Admin
 * @subpackage JQAdm
 */
class Standard
	extends \Aimeos\Admin\JQAdm\Common\Admin\Factory\Base
	implements \Aimeos\Admin\JQAdm\Common\Admin\Factory\Iface
{
	/**
	 * Adds the required data used in the template
	 *
	 * @param \Aimeos\MW\View\Iface $view View object
	 * @return \Aimeos\MW\View\Iface View object with assigned parameters
	 */
	public function addData( \Aimeos\MW\View\Iface $view ) : \Aimeos\MW\View\Iface
	{

/*
		$langManager = \Aimeos\MShop::create( $context, 'locale/language' );
		$view->langItems = $langManager->searchItems( $langManager->createSearch( true ) );

		$ds = DIRECTORY_SEPARATOR;

		$view->itemDecorators = $this->getClassNames( 'MShop' . $ds . 'Sardes' . $ds . 'Provider' . $ds . 'Decorator' );
		$view->itemProviders = [
			'delivery' => $this->getClassNames( 'MShop' . $ds . 'Sardes' . $ds . 'Provider' . $ds . 'Delivery' ),
			'payment' => $this->getClassNames( 'MShop' . $ds . 'Sardes' . $ds . 'Provider' . $ds . 'Payment' ),
		];

		$view->itemSubparts = $this->getSubClientNames();
		$view->itemTypes = $this->getTypeItems();
*/
		return $view;
	}


	/**
	 * Copies a resource
	 *
	 * @return string|null HTML output
	 */
	public function copy() : ?string
	{
		$view = $this->getObject()->addData( $this->getView() );
/*
		try
		{
			if( ( $id = $view->param( 'id' ) ) === null ) {
				throw new \Aimeos\Admin\JQAdm\Exception( sprintf( 'Required parameter "%1$s" is missing', 'id' ) );
			}

			$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );

			$view->item = $manager->getItem( $id, $this->getDomains() );
			$view->itemAttributes = $this->getConfigAttributes( $view->item );
			$view->itemData = $this->toArray( $view->item, true );
			$view->itemBody = '';

			foreach( $this->getSubClients() as $idx => $client )
			{
				$view->tabindex = ++$idx + 1;
				$view->itemBody .= $client->copy();
			}
		}
		catch( \Exception $e )
		{
			$this->report( $e, 'copy' );
		}
*/
		return $this->render( $view );
	}


	/**
	 * Creates a new resource
	 *
	 * @return string|null HTML output
	 */
	public function create() : ?string
	{
		$view = $this->getObject()->addData( $this->getView() );
/*
		try
		{
			$data = $view->param( 'item', [] );

			if( !isset( $view->item ) ) {
				$view->item = \Aimeos\MShop::create( $this->getContext(), 'sardes' )->createItem();
			}

			$data['sardes.siteid'] = $view->item->getSiteId();

			$view->itemData = array_replace_recursive( $this->toArray( $view->item ), $data );
			$view->itemBody = '';

			foreach( $this->getSubClients() as $idx => $client )
			{
				$view->tabindex = ++$idx + 1;
				$view->itemBody .= $client->create();
			}
		}
		catch( \Exception $e )
		{
			$this->report( $e, 'create' );
		}
*/
		return $this->render( $view );
	}


	/**
	 * Deletes a resource
	 *
	 * @return string|null HTML output
	 */
	public function delete() : ?string
	{
/*
		$view = $this->getView();

		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );
		$manager->begin();

		try
		{
			if( ( $ids = $view->param( 'id' ) ) === null ) {
				throw new \Aimeos\Admin\JQAdm\Exception( sprintf( 'Required parameter "%1$s" is missing', 'id' ) );
			}

			$search = $manager->createSearch()->setSlice( 0, count( (array) $ids ) );
			$search->setConditions( $search->compare( '==', 'sardes.id', $ids ) );
			$items = $manager->searchItems( $search, $this->getDomains() );

			foreach( $items as $item )
			{
				$view->item = $item;

				foreach( $this->getSubClients() as $client ) {
					$client->delete();
				}
			}

			$manager->deleteItems( $items->toArray() );
			$manager->commit();

			return $this->redirect( 'swordbros/sardes', 'search', null, 'delete' );
		}
		catch( \Exception $e )
		{
			$manager->rollback();
			$this->report( $e, 'delete' );
		}
*/
		return $this->search();
	}


	/**
	 * Returns a single resource
	 *
	 * @return string|null HTML output
	 */
	public function get() : ?string
	{

		$view = $this->getObject()->addData( $this->getView() );
/*
		try
		{
			if( ( $id = $view->param( 'id' ) ) === null ) {
				throw new \Aimeos\Admin\JQAdm\Exception( sprintf( 'Required parameter "%1$s" is missing', 'id' ) );
			}

			$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );

			$view->item = $manager->getItem( $id, $this->getDomains() );
			$view->itemAttributes = $this->getConfigAttributes( $view->item );
			$view->itemData = $this->toArray( $view->item );
			$view->itemBody = '';

			foreach( $this->getSubClients() as $idx => $client )
			{
				$view->tabindex = ++$idx + 1;
				$view->itemBody .= $client->get();
			}
		}
		catch( \Exception $e )
		{
			$this->report( $e, 'get' );
		}
*/
		return $this->render( $view );
	}


	/**
	 * Saves the data
	 *
	 * @return string|null HTML output
	 */
	public function save() : ?string
	{
		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );
		$view = $this->getView();
		$manager->saveItem( $this->fromArray($view->param( 'option', [] ) )  );
		return $this->redirect( 'swordbros/sardes', 'search');
	}


	/**
	 * Returns a list of resource according to the conditions
	 *
	 * @return string|null HTML output
	 */
	public function searchData() : ?array
	{
		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );
		$search = $manager->createSearch();
		$items = $manager->searchItems( $search, [] )->first()->toArray();
		return $items;
		
	}
	public function search() : ?string
	{
		
		//$params = $this->storeSearchParams( $view->param(), 'sardes' );
		$view = $this->getView();
		$view->items = $this->searchData();
/*
		try
		{
			$total = 0;
			$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );


			$view->filterAttributes = $manager->getSearchAttributes( true );
			$view->filterOperators = $search->getOperators();
			$view->itemTypes = $this->getTypeItems();
			$view->total = $total;
			$view->itemBody = '';

			foreach( $this->getSubClients() as $client ) {
				$view->itemBody .= $client->search();
			}
		}
		catch( \Exception $e )
		{
			$this->report( $e, 'search' );
		}

*/		$tplconf = 'admin/jqadm/sardes/template-list';
		$default = 'options/list-standard';

		return $view->render( $view->config( $tplconf, $default ) );
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Admin\JQAdm\Iface Sub-client object
	 */
	public function getSubClient( string $type, string $name = null ) : \Aimeos\Admin\JQAdm\Iface
	{

		return $this->createSubClient( 'sardes/' . $type, $name );
	}


	/**
	 * Returns the backend configuration attributes of the provider and decorators
	 *
	 * @param \Aimeos\MShop\Sardes\Item\Iface $item Sardes item incl. provider/decorator property
	 * @return \Aimeos\MW\Common\Critera\Attribute\Iface[] List of configuration attributes
	 */
	public function getConfigAttributes( \Aimeos\MShop\Sardes\Item\Iface $item ) : array
	{
		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );

		try {
			return $manager->getProvider( $item, $item->getType() )->getConfigBE();
		} catch( \Aimeos\MShop\Exception $e ) {
			return [];
		}
	}


	/**
	 * Returns the domain names whose items should be fetched too
	 *
	 * @return string[] List of domain names
	 */
	protected function getDomains() : array
	{
		return $this->getContext()->getConfig()->get( 'mshop/domains', [] );
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of JQAdm client names
	 */
	protected function getSubClientNames() : array
	{
		return $this->getContext()->getConfig()->get( 'mshop/standard/subparts', [] );
	}


	/**
	 * Returns the available sardes type items
	 *
	 * @return \Aimeos\Map List of item implementing \Aimeos\MShop\Common\Type\Iface
	 */
	protected function getTypeItems() : \Aimeos\Map
	{
		$typeManager = \Aimeos\MShop::create( $this->getContext(), 'sardes/type' );

		$search = $typeManager->createSearch( true )->setSlice( 0, 10000 );
		$search->setSortations( [$search->sort( '+', 'sardes.type.position' )] );

		return $typeManager->searchItems( $search );
	}


	/**
	 * Creates new and updates existing items using the data array
	 *
	 * @param array $data Data array
	 * @return \Aimeos\MShop\Sardes\Item\Iface New sardes item object
	 */
	protected function fromArray( array $data ) : \Aimeos\MShop\Sardes\Item\Iface
	{
		$conf = [];

		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );

		$item = $manager->createItem($data);

		$item->fromArray( $data, true );

		return $item;
	}


	/**
	 * Constructs the data array for the view from the given item
	 *
	 * @param \Aimeos\MShop\Sardes\Item\Iface $item Sardes item object
	 * @return string[] Multi-dimensional associative list of item data
	 */
	protected function toArray( \Aimeos\MShop\Sardes\Item\Iface $item, bool $copy = false ) : array
	{
		$config = $item->getConfig();
		$data = $item->toArray( true );
		$data['config'] = [];

		if( $copy === true )
		{
			$data['sardes.siteid'] = $this->getContext()->getLocale()->getSiteId();
			$data['sardes.code'] = $data['sardes.code'] . '_copy';
			$data['sardes.id'] = '';
		}

		ksort( $config );

		foreach( $config as $key => $value )
		{
			$data['config']['key'][] = $key;
			$data['config']['val'][] = $value;
		}

		return $data;
	}


	/**
	 * Returns the rendered template including the view data
	 *
	 * @param \Aimeos\MW\View\Iface $view View object with data assigned
	 * @return string HTML output
	 */
	protected function render( \Aimeos\MW\View\Iface $view ) : string
	{
		$tplconf = 'admin/jqadm/sardes/template-item';
		$default = 'ajax/item-standard';

		return $view->render( $view->config( $tplconf, $default ) );
	}
}
