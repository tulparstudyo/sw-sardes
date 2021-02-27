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
        $config = $this->getContext()->getConfig();
		$manager = \Aimeos\MShop::create( $this->getContext(), 'sardes' );
		$view = $this->getView();

        global $request;
        if( $request->input('sw-ajax', false)){ 
            $location = $config->get( 'client/product/import/xlsx/location' );
           ;
            $file_name = 'product-import.xlsx';
            
            $file_path = $location .'/'.$file_name;
            
            if($files = (array) $this->getView()->request()->getUploadedFiles()){
                foreach($files as $file ){
                    $file->moveTo($file_path);
                }
                $this->import_xlsx($file_path);
            }
            return $this->redirect( 'product', 'search');
        } else{
            $manager->saveItem( $this->fromArray($view->param( 'option', [] ) )  );
            return $this->redirect( 'swordbros/sardes', 'search');

        }
	}

    private function import_xlsx($path){
		$total = $errors = 0;
		$context = $this->getContext();
		$config = $context->getConfig();
		$logger = $context->getLogger();


		if( file_exists( $path ) === false ) {
			return;
		}

        $domains = array( 'attribute', 'media', 'price', 'product', 'text' );
		$domains = $config->get( 'client/product/import/xlsx/domains', $domains );
		$mappings = $config->get( 'client/product/import/xlsx/mapping', $this->getDefaultMapping() );
		$converters = $config->get( 'client/product/import/xlsx/converter', [] );
		$maxcnt = (int) $config->get( 'client/product/import/xlsx/max-size', 1000 );
		$skiplines = (int) $config->get( 'client/product/import/xlsx/skip-lines', 0 );
		$strict = (bool) $config->get( 'client/product/import/xlsx/strict', true );
		$backup = $config->get( 'client/product/import/xlsx/backup' );

		if( !isset( $mappings['item'] ) || !is_array( $mappings['item'] ) )
		{
			$msg = sprintf( 'Required mapping key "%1$s" is missing or contains no array', 'item' );
			throw new  \Aimeos\MShop\Exception( $msg );
		}
$options = array(
    'TempDir'                    => $backup,
    'SkipEmptyCells'             => false,
    'ReturnDateTimeObjects'      => true,
    'CustomFormats'              => array(20 => 'hh:mm')
);


		try
		{
			$procMappings = $mappings;
			unset( $procMappings['item'] );
            $manager = \Aimeos\MShop::create( $context, 'product' );

			//$codePos = $this->getCodePosition( $mappings['item'] );
			//$convlist = $this->getConverterList( $converters );
			//$processor = $this->getProcessors( $procMappings );
			//$container = $this->getContainer();
			//$path = $container->getName();

			$msg = sprintf( 'Started product import from "%1$s" (%2$s)', $path, __CLASS__ );
			$logger->log( $msg, \Aimeos\MW\Logger\Base::NOTICE );
print_r($mappings);            
            die($path);
$reader = new \Aspera\Spreadsheet\XLSX\Reader($options);
$reader->open($path);

foreach ($reader as $row) {
    print_r($row);
}

$reader->close();
            

            
            $products = $this->getProducts( array_keys( $data ), $domains );
            print_r($products);
            foreach( $data as $code => $list ){
                $code = trim( $code );
                if( isset( $products[$code] ) ) {
                    $product = $products[$code];
                } else {
                    $product = $manager->createItem();
                }
                $type = 'select';
                $product = $product->fromArray( $map[0], true );
                $product = $manager->saveItem( $product->setType( $type ) );
            }

            $chunkcnt = count( $data );

            $msg = 'Imported product lines from "%1$s": %2$d/%3$d (%4$s)';
            $logger->log( sprintf( $msg, $path, $chunkcnt , $chunkcnt, __CLASS__ ), \Aimeos\MW\Logger\Base::NOTICE );

            $total += $chunkcnt;
            unset( $products, $data );


		}
		catch( \Exception $e )
		{
			$logger->log( 'Product import error: ' . $e->getMessage() . "\n" . $e->getTraceAsString() );
			$this->mail( 'Product CSV import error', $e->getMessage() . "\n" . $e->getTraceAsString() );
			throw new  \Aimeos\MShop\Exception( $e->getMessage() );
		}


	}
	protected function getDefaultMapping() : array
	{
		return array(
			'item' => array(
				0 => 'product.code',
				1 => 'product.label',
				2 => 'product.type',
				3 => 'product.status',
			),
			'text' => array(
				4 => 'text.type',
				5 => 'text.content',
				6 => 'text.type',
				7 => 'text.content',
			),
			'media' => array(
				8 => 'media.url',
			),
			'price' => array(
				9 => 'price.currencyid',
				10 => 'price.quantity',
				11 => 'price.value',
				12 => 'price.taxrate',
			),
			'attribute' => array(
				13 => 'attribute.code',
				14 => 'attribute.type',
			),
			'product' => array(
				15 => 'product.code',
				16 => 'product.lists.type',
			),
			'property' => array(
				17 => 'product.property.value',
				18 => 'product.property.type',
			),
			'catalog' => array(
				19 => 'catalog.code',
				20 => 'catalog.lists.type',
			),
		);
	}
	protected function getProducts( array $codes, array $domains ) : array
	{
		$result = [];
		$manager = \Aimeos\MShop::create( $this->getContext(), 'product' );

		$search = $manager->createSearch();
		$search->setConditions( $search->compare( '==', 'product.code', $codes ) );
		$search->setSlice( 0, count( $codes ) );

		foreach( $manager->searchItems( $search, $domains ) as $item ) {
			$result[$item->getCode()] = $item;
		}

		return $result;
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
