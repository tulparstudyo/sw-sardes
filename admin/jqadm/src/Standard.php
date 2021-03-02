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
		return $this->render( $view );
	}


	/**
	 * Deletes a resource
	 *
	 * @return string|null HTML output
	 */
	public function delete() : ?string
	{
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
		return $this->render( $view );
	}


	/**
	 * Saves the data
	 *
	 * @return string|null HTML output
	 */
	public function save() : ?string
	{
        $context = $this->getContext();
        $config = $context->getConfig();
		$manager = \Aimeos\MShop::create( $context, 'sardes' );
		$view = $this->getView();

        global $request;
        if( $request->input('sw-ajax', false)){ 
            $location = $config->get( 'client/product/import/xlsx/location' );
           ;
            $file_name = 'product-import-1.xlsx';
            
            $file_path = $location .'/'.$file_name;
            
            if($files = (array) $this->getView()->request()->getUploadedFiles()){
                foreach($files as $file ){
                    $file->moveTo($file_path);
                }
                $Xlsx = new \Aimeos\Controller\Jobs\Product\Import\Xlsx\Standard($context, $this->getAimeos());
                $Xlsx->run();
            }
            $context->getSession()->set( 'info', [$context->getI18n()->dt( 'admin', 'Items imported successfully' )] ); 
            return $this->redirect( 'product', 'search');
        } else{
            $manager->saveItem( $this->fromArray($view->param( 'option', [] ) )  );
            return $this->redirect( 'swordbros/sardes', 'search');

        }
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
        $tplconf = 'admin/jqadm/sardes/template-list';
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
		$default = 'ajax/item-'.$view->param('id');
		$view->context = $this->getContext(); 
		$view->aimeos = $this->getAimeos();

		return $view->render( $view->config( $tplconf, $default ) );
	}
}
