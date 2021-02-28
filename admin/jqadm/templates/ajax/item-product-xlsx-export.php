<?php
$enc = $this->encoder();
$domains = array( 'attribute', 'media', 'price', 'product', 'text' );

$location = $this->config( 'client/product/export/xlsx/location' );

$file_name = 'product-excel.xlsx';
    
$file_path = $location .'/'.$file_name;

$Xlsx = new \Aimeos\Shop\Command\JobsCommand();
print_r($Xlsx);
//$def[] = ['jobs', null, 'product/export/xlsx'];
//$Xlsx->setDefinition($def);
print_r( get_class_methods( $Xlsx));
//$Xlsx = new \Aimeos\Controller\Jobs\Product\Export\Xlsx\Standard($this->get('context'), $this->get('aimeos'));
//$Xlsx->run();
die();
$productlist = $Csv->productlist();

$cols = ["item_code" => 'string', 
		 "item_label" => 'string', 
		 "item_type" => 'string', 
		 "item_status" =>'string', 
		 "text_type" => 'string', 
		 "text_content" => 'string', 
		 "text_type_2" => 'string', 
		 "text_content_2" => 'string', 
		 "media_url" => 'string', 
		 "price_currencyid" =>'string', 
		 "price_quantity" => 'string', 
		 "price_value" => 'string', 
		 "price_tax_rate" => 'string', 
		 "attribute_code" => 'string', 
		 "attribute_type" => 'string', 
		 "subproduct _code" => 'string', 
		 "product_list type" => 'string', 
		 "property_value" => 'string', 
		 "property_type" => 'string', 
		 "catalog_code" => 'string', 
		 "catalog_list_type" => 'string', 
		];

$wExcel = new Ellumilel\ExcelWriter();
$wExcel->writeSheetHeader('Sheet1', $cols);
$wExcel->setAuthor('Swordbros.ru');
foreach($productlist as $exportItems ){
    foreach( $exportItems as $item ){
        $media_url = '';
        $price_currencyid = '';
        $price_value = '';
        $text_type = '';
        $text_content = '';
        $text_type_2 = '';
        $text_content_2 = '';
        foreach( $domains as $domain ){
                if($listItems = $item->getListItems( $domain )){
                    if($domain=='media'){
                        if($listItem = $listItems->first()){
                            $info = $listItem->getRefItem();
                            $media_url = ($info->get('media.url'));
                        }
                    } if($domain=='price'){
                        if($listItem = $listItems->first()){
                            $info = $listItem->getRefItem();
                            $price_currencyid = ($info->get('price.currencyid'));
                            $price_value = ($info->get('price.value'));
                        }
                    } if($domain=='text'){
                        foreach($listItems as $listItem ){
                            $info = $listItem->getRefItem();
                            if($info->get('text.type')=='short'){
                                $text_type = 'short';
                                $text_content = $info->get('text.content');
                            } elseif($info->get('text.type')=='long'){
                                $text_type_2 = 'long';
                                $text_content_2 = $info->get('text.content');
                            }
                        }
                    }
                }


        }

        $row = ["item code" => $enc->xml( $item->getCode() ), 
                 "item label" => $enc->xml( $item->getLabel() ),
                 "item type" => $enc->xml( $item->getType() ),
                 "item status" => $enc->xml( $item->getStatus() ),
                 "text type" => $text_type,
                 "text content" =>  preg_replace( "/\r|\n/", "", $text_content ) ,
                 "text type_2" => $text_type_2,
                 "text content_2" => preg_replace( "/\r|\n/", "", $text_content_2 ) ,
                 "media url" => $media_url,
                 "price currencyid" => $price_currencyid ,
                 "price quantity" => '1',
                 "price value" => $price_value,
                 "price tax rate" => '',
                 "attribute code" => '',
                 "attribute type" => '',
                 "subproduct code" => '',
                 "product list type" => '',
                 "property value" => '',
                 "property type" => '',
                 "catalog code" => '',
                 "catalog list type" => ''
                ];
                $wExcel->writeSheetRow('Sheet1', $row);	
    } 
}

if(is_file($file_path)){
    unlink($file_path);
}
$wExcel->writeToFile($file_path); 

header('Content-Type: application/download');
header("Content-Disposition: attachment; filename=".$file_name); 
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile($file_path);

die();