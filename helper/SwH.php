<?php

class SwH{

   static function get_languages(){

        try

        {

            $query = \DB::table('mshop_locale')->select('langid')->groupBy('langid')->having('langid', '>', '')->get();

            return json_decode(json_encode($query->all()),1);

            

        } catch(Exception $e){

            echo $e->getMessage();

        }       

   }

   static function widgets($widgets){

        try

        {

            return Aimeos\Shop\Facades\Shop::get( 'swordbros/widgets' )->getBody($widgets);

            

        } catch(Exception $e){

            return $e->getMessage();

        }       

   }

    

   static function topMenu(){

        $data =  \Aimeos\Shop\Facades\Catalog::uses(['text', 'media'])

                ->getTree();

        if($data->hasChildren()){

            echo '<ul class="">';

            foreach ($data->getChildren() as $main_category) {

                echo '<li class="nav-item"><a href="'.route('aimeos_shop_list',array_merge( ['locale'=> \Route::current()->parameter('locale','ru'), 'currency'=> \Route::current()->parameter('currency','RUB')], ['f_name' => $main_category->getName( 'url' ), 'f_catid' => $main_category->getId()] )).'" class="nav-link">'.$main_category->getName().'</a></li>';

            } 

            echo '</ul>';

        }

    }

    

    static function storeInfo($key=false){

        $store_info['ru']=array(

            'name' => '',

            'address' => 'deneme adresi',

            'phone' => '',

            'whatsapp' => '#',

            'instagram' => 'https://www.instagram.com/palto.ru/',

            'vk' => '#',

            'facebook' => '#',

            'twitter' => '#',

            'pinterest' => '#',

            'linkedin' => '#',

            'youtube' => '#',

            'social-ok' => '#',

            'pinme' => '#',

            'google-plus' => '#',

            'copyright' => 'Авторские права © 2020 SWORD BROS. Все права защищены.',

            'map' => [

                'latitude' => '',

                'longitude' => '',

            ],

            'meta' => [

                'title' => 'Online palto store-Paltoru.com',

                'keyword' => 'Женщины, Мужчины,Дети',

                'description' => '',

            ]

        );

        $store_info['en']=array(

            'name' => '',

            'address' => 'deneme',

            'phone' => '',

            'whatsapp' => '',

            'intagram' => 'https://www.instagram.com/palto.ru/',

            'vk' => '#',

            'facebook' => '#',

            'twitter' => '#',

            'pinterest' => '#',

            'linkedin' => '#',

            'youtube' => '#',

            'social-ok' => '#',

            'pinme' => '#',

            'google-plus' => '#',

            'copyright' => 'Copyright © 2020 SWORD BROS. All rights reserved.',

            'map' => [

                'latitude' => '',

                'longitude' => '',

            ],

            'meta' => [

                'title' => 'Online palto store-Paltoru.com',

                'keyword' => 'Женщины, Мужчины,Дети',

                'description' => '',

            ]

        );

        

        $langid = 'ru';// \Route::current()->parameter('locale','ru');

        if(isset($store_info[$langid])){

            if(isset($store_info[$langid][$key])){

                return $store_info[$langid][$key];

            }

        }

        return null;

    }

    

    static function productStars($id, $input_name=''){

        if(!empty($id)){

            $query = \DB::table('mshop_product')->select('id', 'review_count', 'rating')->where('id', $id)->get()->first();

            if($query ){

                return SwH::stars($query->rating, $input_name);

            }

        }

    }



    static function stars($rating=0, $input_name=''){

        $id = rand();

        if($input_name){

            $disabled = '';

        } else{

            $disabled = ' disabled="disabled" readonly="readonly" ';

        }

        return '<div class="rating-box"><ul>

<li'.($rating>=1?'':'class="silver-color"').'><i class="ion-ios-star'.($rating>=1?'':'-outline').'"></i></li>

<li'.($rating>=2?'':'class="silver-color"').'><i class="ion-ios-star'.($rating>=2?'':'-outline').'"></i></li>

<li'.($rating>=3?'':'class="silver-color"').'><i class="ion-ios-star'.($rating>=3?'':'-outline').'"></i></li>

<li'.($rating>=4?'':'class="silver-color"').'><i class="ion-ios-star'.($rating>=4?'':'-outline').'"></i></li>

<li'.($rating>=5?'':'class="silver-color"').'><i class="ion-ios-star'.($rating>=5?'':'-outline').'"></i></li>

</ul></div>';

    }

    

    static function socialBar($class=''){

        $html = '<ul class="star-social-bar m-social-share '.$class.'"  style="padding-left: 0;" >

                   

                    <li id="social-fb" style="display: inline-block; margin-right: 10px!important;">

                        <a href="'.self::storeInfo('facebook').'" style="color: white">

                        <img src="'.url()->to('/').'/public/fe/assets/images/social/fb.png" style=" max-width: 35px;margin-top: 3px;" >

                        </a>

                    </li>

                  

                    <li id="social-vk" style="display: inline-block; margin-right: 10px!important;">

                        <a href="'.self::storeInfo('vk').'">

                        <img src="'.url()->to('/').'/public/fe/assets/images/social/vk.png" style=" max-width: 35px;margin-top: 3px;" >

                        </a>

                    </li>

                    <li id="social-ig" style="display: inline-block;">

                        <a href="'.self::storeInfo('instagram').'" style="color: white">

                        <img src="'.url()->to('/').'/public/fe/assets/images/social/instagram.png" style="  max-width: 35px;margin-top: 3px;" >

                        </a>

                    </li>

                   

                </ul>

';

        return $html;

    }



}

?>

