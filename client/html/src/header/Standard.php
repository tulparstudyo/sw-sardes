<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2020
 * @package Client
 * @subpackage Html
 */


namespace Aimeos\Client\Html\Swordbros\Sardes\Header;


/**
 * Default implementation of account profile HTML client.
 *
 * @package Client
 * @subpackage Html
 */
class Standard
	extends \Aimeos\Client\Html\Common\Client\Factory\Base
	implements \Aimeos\Client\Html\Iface
{

	private $subPartPath = 'client/html/header';
	private $subPartNames = ['address'];
	private $view;


	/**
	 * Returns the HTML code for insertion into the body.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string HTML code
	 */
	public function getBody( string $uid = '' ) : string
	{
		$context = $this->getContext();
		$view = $this->getView();

		try
		{
			if( !isset( $this->view ) ) {
				$view = $this->view = $this->getObject()->addData( $view );
			}

			$html = '';
			foreach( $this->getSubClients() as $subclient ) {
				$html .= $subclient->setView( $view )->getBody( $uid );
			}
			$view->profileBody = $html;
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
			$this->logException( $e );
		}

		/** client/html/account/profile/standard/template-body
		 * Relative path to the HTML body template of the account profile client.
		 *
		 * The template file contains the HTML code and processing instructions
		 * to generate the result shown in the body of the frontend. The
		 * configuration string is the path to the template file relative
		 * to the templates directory (usually in client/html/templates).
		 *
		 * You can overwrite the template file configuration in extensions and
		 * provide alternative templates. These alternative templates should be
		 * named like the default one but with the string "standard" replaced by
		 * an unique name. You may use the name of your project for this. If
		 * you've implemented an alternative client class as well, "standard"
		 * should be replaced by the name of the new class.
		 *
		 * @param string Relative path to the template creating code for the HTML page body
		 * @since 2016.10
		 * @category Developer
		 * @see client/html/account/profile/standard/template-header
		 */
		$tplconf = 'client/html/account/profile/standard/template-body';
		$default = 'header/body-standard';

		return $view->render( $view->config( $tplconf, $default ) );
	}


	/**
	 * Returns the HTML string for insertion into the header.
	 *
	 * @param string $uid Unique identifier for the output if the content is placed more than once on the same page
	 * @return string|null String including HTML tags for the header on error
	 */
	public function getHeader( string $uid = '' ) : ?string
	{
		$view = $this->getView();

		try
		{
			if( !isset( $this->view ) ) {
				$view = $this->view = $this->getObject()->addData( $view );
			}

			$html = '';
			foreach( $this->getSubClients() as $subclient ) {
				$html .= $subclient->setView( $view )->getHeader( $uid );
			}
			$view->profileHeader = $html;

			/** client/html/account/profile/standard/template-header
			 * Relative path to the HTML header template of the account profile client.
			 *
			 * The template file contains the HTML code and processing instructions
			 * to generate the HTML code that is inserted into the HTML page header
			 * of the rendered page in the frontend. The configuration string is the
			 * path to the template file relative to the templates directory (usually
			 * in client/html/templates).
			 *
			 * You can overwrite the template file configuration in extensions and
			 * provide alternative templates. These alternative templates should be
			 * named like the default one but with the string "standard" replaced by
			 * an unique name. You may use the name of your project for this. If
			 * you've implemented an alternative client class as well, "standard"
			 * should be replaced by the name of the new class.
			 *
			 * @param string Relative path to the template creating code for the HTML page head
			 * @since 2016.10
			 * @category Developer
			 * @see client/html/account/profile/standard/template-body
			 */
			$tplconf = 'client/html/account/profile/standard/template-header';
			$default = 'account/profile/header-standard';

			return $view->render( $view->config( $tplconf, $default ) );
		}
		catch( \Exception $e )
		{
			$this->logException( $e );
		}

		return null;
	}


	/**
	 * Returns the sub-client given by its name.
	 *
	 * @param string $type Name of the client type
	 * @param string|null $name Name of the sub-client (Default if null)
	 * @return \Aimeos\Client\Html\Iface Sub-client object
	 */
	public function getSubClient( string $type, string $name = null ) : \Aimeos\Client\Html\Iface
	{
		/** client/html/account/profile/decorators/excludes
		 * Excludes decorators added by the "common" option from the account profile html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to remove a decorator added via
		 * "client/html/common/decorators/default" before they are wrapped
		 * around the html client.
		 *
		 *  client/html/account/profile/decorators/excludes = array( 'decorator1' )
		 *
		 * This would remove the decorator named "decorator1" from the list of
		 * common decorators ("\Aimeos\Client\Html\Common\Decorator\*") added via
		 * "client/html/common/decorators/default" to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2016.10
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/account/profile/decorators/global
		 * @see client/html/account/profile/decorators/local
		 */

		/** client/html/account/profile/decorators/global
		 * Adds a list of globally available decorators only to the account profile html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap global decorators
		 * ("\Aimeos\Client\Html\Common\Decorator\*") around the html client.
		 *
		 *  client/html/account/profile/decorators/global = array( 'decorator1' )
		 *
		 * This would add the decorator named "decorator1" defined by
		 * "\Aimeos\Client\Html\Common\Decorator\Decorator1" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2016.10
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/account/profile/decorators/excludes
		 * @see client/html/account/profile/decorators/local
		 */

		/** client/html/account/profile/decorators/local
		 * Adds a list of local decorators only to the account profile html client
		 *
		 * Decorators extend the functionality of a class by adding new aspects
		 * (e.g. log what is currently done), executing the methods of the underlying
		 * class only in certain conditions (e.g. only for logged in users) or
		 * modify what is returned to the caller.
		 *
		 * This option allows you to wrap local decorators
		 * ("\Aimeos\Client\Html\Account\Decorator\*") around the html client.
		 *
		 *  client/html/account/profile/decorators/local = array( 'decorator2' )
		 *
		 * This would add the decorator named "decorator2" defined by
		 * "\Aimeos\Client\Html\Account\Decorator\Decorator2" only to the html client.
		 *
		 * @param array List of decorator names
		 * @since 2016.10
		 * @category Developer
		 * @see client/html/common/decorators/default
		 * @see client/html/account/profile/decorators/excludes
		 * @see client/html/account/profile/decorators/global
		 */

		return $this->createSubClient( 'account/profile/' . $type, $name );
	}


	/**
	 * Processes the input, e.g. store given values.
	 *
	 * A view must be available and this method doesn't generate any output
	 * besides setting view variables if necessary.
	 */
	public function process()
	{
		$context = $this->getContext();
		$view = $this->getView();

		try
		{
			parent::process();
		}
		catch( \Aimeos\MShop\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'mshop', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Aimeos\Controller\Frontend\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'controller/frontend', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Aimeos\Client\Html\Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', $e->getMessage() ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
		}
		catch( \Exception $e )
		{
			$error = array( $context->getI18n()->dt( 'client', 'A non-recoverable error occured' ) );
			$view->profileErrorList = array_merge( $view->get( 'profileErrorList', [] ), $error );
			$this->logException( $e );
		}
	}


	/**
	 * Returns the list of sub-client names configured for the client.
	 *
	 * @return array List of HTML client names
	 */
	protected function getSubClientNames() : array
	{
		return $this->getContext()->getConfig()->get( $this->subPartPath, $this->subPartNames );
	}


	/**
	 * Sets the necessary parameter values in the view.
	 *
	 * @param \Aimeos\MW\View\Iface $view The view object which generates the HTML output
	 * @param array &$tags Result array for the list of tags that are associated to the output
	 * @param string|null &$expire Result variable for the expiration date of the output (null for no expiry)
	 * @return \Aimeos\MW\View\Iface Modified view object
	 */
	public function addData( \Aimeos\MW\View\Iface $view, array &$tags = [], string &$expire = null ) : \Aimeos\MW\View\Iface
	{
		$context = $this->getContext();
		$locale = $context->getLocale();
		$view->selectLanguageId = $locale->getLanguageId();
		$view->selectCurrencyId = $locale->getCurrencyId();

		/** client/html/account/profile/domains
		 * A list of domain names whose items should be available in the account profile view template
		 *
		 * The templates rendering customer details can contain additional
		 * items. If you want to display additional content, you can configure
		 * your own list of domains (attribute, media, price, product, text,
		 * etc. are domains) whose items are fetched from the storage.
		 *
		 * @param array List of domain names
		 * @since 2016.10
		 * @category Developer
		 */
		$domains = $context->getConfig()->get( 'client/html/account/profile/domains', ['customer/address'] );

		$cntl = \Aimeos\Controller\Frontend::create( $context, 'customer' );
		$view->profileCustomerItem = $cntl->uses( $domains )->get();

		$startid = 1;//$view->config( 'client/html/catalog/filter/tree/startid' );

		$cntl = \Aimeos\Controller\Frontend::create( $this->getContext(), 'catalog' )
			->uses( $domains )->root( $startid );

		if( ( $currentid = $view->param( 'f_catid' ) ) !== null ) {
			$catItems = $cntl->getPath( $currentid );
			$catIds = $catItems->keys()->toArray();
		} else {
			$catItems = map();
			$catIds = [$startid];
		}

		$view->categories =  \Aimeos\Shop\Facades\Catalog::uses(['text', 'media'])->getTree();
		$view->treeCatalogPath = $catItems;
		$view->treeCatalogTree = $cntl->visible( [1] )->getTree();
		$view->treeFilterParams = $this->getClientParams( $view->param(), ['f'] );


		return parent::addData( $view, $tags, $expire );
	}
}
