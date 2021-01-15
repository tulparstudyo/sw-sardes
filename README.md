# sardes

# Setup
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
        "@php artisan migrate --path=ext/sw-sardes/lib/custom/setup/options"
    ]
}
```
