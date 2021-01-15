<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2011
 * @copyright Aimeos (aimeos.org), 2015-2020
 * @package MShop
 * @subpackage Sardes
 */


namespace Aimeos\MShop\Sardes\Manager;


/**
 * Common interface for all slider manager implementations.
 *
 * @package MShop
 * @subpackage Sardes
 */
interface Iface
	extends \Aimeos\MShop\Common\Manager\Iface, \Aimeos\MShop\Common\Manager\Find\Iface, \Aimeos\MShop\Common\Manager\ListRef\Iface
{
	/**
	 * Returns the slider provider which is responsible for the slider item.
	 *
	 * @param \Aimeos\MShop\Sardes\Item\Iface $item Delivery or payment slider item object
	 * @param string $type Sardes type code
	 * @return \Aimeos\MShop\Sardes\Provider\Iface Sardes provider object
	 * @throws \Aimeos\MShop\Sardes\Exception If provider couldn't be found
	 */
	public function getProvider( \Aimeos\MShop\Sardes\Item\Iface $item, string $type ) : \Aimeos\MShop\Sardes\Provider\Iface;

	/**
	 * Adds a new or updates an existing slider item in the storage.
	 *
	 * @param \Aimeos\MShop\Sardes\Item\Iface $item New or existing slider item that should be saved to the storage
	 * @param bool $fetch True if the new ID should be returned in the item
	 * @return \Aimeos\MShop\Sardes\Item\Iface Updated item including the generated ID
	 */
	public function saveItem( \Aimeos\MShop\Sardes\Item\Iface $item, bool $fetch = true ) : \Aimeos\MShop\Sardes\Item\Iface;
}
