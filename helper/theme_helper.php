<?php
if(!function_exists('sardes_url')){
	function sardes_url($file=''){
		return '/'.rtrim(config('shop.client.html.common.baseurl', 'packages/swordbros/shop/themes/sardes'), '/').'/'.ltrim($file, '/');	
	}
}
if(!function_exists('sardes_widget')){
	function sardes_widget($file=''){
		return \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/widget')->getBody($file);
	}
}
if(!function_exists('sardes_header')){
	function sardes_header(){
		return \Aimeos\Shop\Facades\Shop::get('locale/select')->getBody();
	}
}
if(!function_exists('sardes_footer')){
	function sardes_footer(){
		return \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/footer')->getBody();
	}
}
if(!function_exists('get_username')){
	function get_username(){
		return \Auth::user()->name;
	}
}
if(!function_exists('sardes_catalog_filter')){
	function sardes_catalog_filter(){
		return \Aimeos\Shop\Facades\Shop::get('catalog/filter')->getBody();
	}
}
if(!function_exists('sardes_top_products')){
	function sardes_top_products(){
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/widget')->getContext();
		$products = \Aimeos\Controller\Frontend::create( $ctx, 'product' )
			->uses( ['media', 'price', 'text'] )
			->search();
		return($products);
	}
}
if(!function_exists('sardes_new_products')){
	function sardes_new_products(){
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/widget')->getContext();
		$products = \Aimeos\Controller\Frontend::create( $ctx, 'product' )
			->uses( ['media', 'price', 'text'] )
			->search();
		return($products);
	}
}

// ADMIN
if(!function_exists('sardes_options')){
	function sardes_options(){
		$options = [];
		$ctx = \Aimeos\Shop\Facades\Shop::get('swordbros/sardes/widget')->getContext();
		$ctl = new \Aimeos\Admin\JQAdm\Swordbros\Sardes\Standard($ctx);
		if($ctl){
			$locale = $ctx->getLocale();
			$options['selectLanguageId'] = $locale->getLanguageId();
			$options['selectLanguageId'] = $locale->getCurrencyId();
			$options =$ctl->searchData();  
		} else {
			$options['selectLanguageId'] =  \Request::input('locale', 'ru');
			$options['selectLanguageId'] =  \Request::input('locale', 'ru');
		}
        request()->session()->put('sardes_options', $options);
        return [];
	}
}
if(!function_exists('sardes_option')){
	function sardes_option($key, $lang=false){
		$data = request()->session()->get('sardes_options', []);
		if(empty($data)) $data = sardes_options();
		return get_option_value($data, $key, $lang);  
	}
}


if(!function_exists('is_selected')){
	function is_selected($data, $key, $value){

		if(isset($data[$key]) ){
			if($data[$key]==$value){
				return "selected checked";
			} 
		}
		return "";
	}
}

if(!function_exists('is_checked')){
	function is_checked($data, $key){

		if(isset($data[$key])){
			if($data[$key]){
				return "checked";
			} 
		}
		return "";
	}
}

if(!function_exists('get_option_value')){
	function get_option_value($data, $key, $lang=false){
		if(empty($lang)) $lang = \Request::input('locale', 'ru');
		if(isset($data[$key])){
			if($lang && isset($data[$key][$lang])){
				return $data[$key][$lang];
			} else if(!is_array($data[$key])){
				return $data[$key];
			}
		}
		return null;
	}
}
if(!function_exists('sardes_admin_bar')){
	function sardes_admin_bar($context){
		echo '<span style="color:#FFF">'.get_username().' <a href="/" target="_blank">Front Page</a></span>';
	}
}

