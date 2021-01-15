<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2011
 * @copyright Aimeos (aimeos.org), 2015-2020
 * @package MShop
 * @subpackage Sardes
 */


namespace Aimeos\MShop\Sardes\Item;

class Standard
	extends \Aimeos\MShop\Common\Item\Base
	implements \Aimeos\MShop\Sardes\Item\Iface
{
	use \Aimeos\MShop\Common\Item\Config\Traits;
	use \Aimeos\MShop\Common\Item\ListRef\Traits;


	private $date;

	public function __construct( array $values = [], array $listItems = [], array $refItems = [] )
	{
		parent::__construct( 'sardes.', $values );

		$this->date = ( isset( $values['.date'] ) ? $values['.date'] : null );
		$this->initListItems( $listItems, $refItems );
	}

	public function getCode() : string
	{
		return $this->get( 'sardes.code', '' );
	}

	public function setCode( string $code ) : \Aimeos\MShop\Sardes\Item\Iface
	{
		return $this->set( 'sardes.code', $this->checkCode( $code ) );
	}

	public function getType() : ?string
	{
		return $this->get( 'sardes.type' );
	}

	public function setType( string $type ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.type', $this->checkCode( $type ) );
	}

	public function getProvider() : string
	{
		return $this->get( 'sardes.provider', '' );
	}

	public function setProvider( string $provider ) : \Aimeos\MShop\Sardes\Item\Iface
	{
		if( preg_match( '/^[A-Za-z0-9]+(,[A-Za-z0-9]+)*$/', $provider ) !== 1 ) {
			throw new \Aimeos\MShop\Sardes\Exception( sprintf( 'Invalid provider name "%1$s"', $provider ) );
		}

		return $this->set( 'sardes.provider', $provider );
	}


	public function getLabel() : string
	{
		return $this->get( 'sardes.label', '' );
	}

	public function setLabel( string $label ) : \Aimeos\MShop\Sardes\Item\Iface
	{
		return $this->set( 'sardes.label', $label );
	}

	public function getDateStart() : ?string
	{
		$value = $this->get( 'sardes.datestart' );
		return $value ? substr( $value, 0, 19 ) : null;
	}

	public function setDateStart( ?string $date ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.datestart', $this->checkDateFormat( $date ) );
	}

	public function getDateEnd() : ?string
	{
		$value = $this->get( 'sardes.dateend' );
		return $value ? substr( $value, 0, 19 ) : null;
	}

	public function setDateEnd( ?string $date ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.dateend', $this->checkDateFormat( $date ) );
	}

	public function getConfig() : array
	{
		return $this->get( 'sardes.config', [] );
	}

	public function setConfig( array $config ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.config', $config );
	}

	public function getPosition() : int
	{
		return $this->get( 'sardes.position', 0 );
	}

	public function setPosition( int $pos ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'server.position', $pos );
	}

	public function getStatus() : int
	{
		return $this->get( 'sardes.status', 1 );
	}

	public function setStatus( int $status ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.status', $status );
	}

	public function getDomain() : string
	{
		return $this->get( 'sardes.domain', 1 );
	}

	public function setDomain( string $domain ) : \Aimeos\MShop\Common\Item\Iface
	{
		return $this->set( 'sardes.domain', $domain );
	}

	public function getResourceType() : string
	{
		return 'sardes';
	}

	public function isAvailable() : bool
	{
		return parent::isAvailable() && $this->getStatus() > 0
			&& ( $this->getDateStart() === null || $this->getDateStart() < $this->date )
			&& ( $this->getDateEnd() === null || $this->getDateEnd() > $this->date );
	}

	public function fromArray( array &$list, bool $private = false ) : \Aimeos\MShop\Common\Item\Iface
	{
		$item = parent::fromArray( $list, $private );
		return $item;
	}

	public function toArray( bool $private = false ) : array
	{
		$list = parent::toArray( $private );
		unset($list['sardes.id']);
		return $list;
	}

}
