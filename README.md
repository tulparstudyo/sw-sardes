# frigian
## Instal
-- composer require swordbros/sw-frigian
## Settins
-- config/shop.php
```php
	'client' => [
		'html' => [
			'common' => [
				'baseurl' =>  'packages/swordbros/shop/themes/frigian' ,
				'template' => [
					'baseurl' => public_path( 'packages/swordbros/shop/themes/frigian' ),
				],
			],
		]
	],
```
## Edit
-- routes\web.php
```php
use Illuminate\Support\Facades\Cookie;
Auth::routes();
if(class_exists('Request')){
    $locale = \Cookie::get('locale');
    \Request::merge(['locale'=> $locale]);
    $currency = \Cookie::get('currency');
    \Request::merge(['currency'=> $currency]);
}
Route::get('/', '\Aimeos\Shop\Controller\CatalogController@homeAction')->name('aimeos_home');
```
