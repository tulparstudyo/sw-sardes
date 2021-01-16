# sardes

# Setup
## composer.json
```
"require": {
    ...
    "tulparstudyo/sw-sardes": "^1.0"
}
```
```
"autoload": {
    "files": [
        ...
        "ext/sw-sardes/helper/theme_helper.php"
    ]
}
```
```
"scripts": {
    "post-update-cmd": [
        ...
        "Swordbros\\Sardes::composerUpdate",
        "@php artisan migrate --path=ext/sw-sardes/lib/custom/setup/options"
    ]
}
```
## config/shop.php
```
'client' => [
    ...
    'common' => [
        'baseurl' =>  'packages/swordbros/shop/themes/sardes/' ,
        'template' => [
            'baseurl' => 'packages/swordbros/shop/themes/sardes',
        ],
    ]
],

```
