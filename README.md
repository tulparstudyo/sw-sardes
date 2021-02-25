# sardes

# Setup
```
    "require": {
        ...
        "tulparstudyo/sw-sardes": "^1.0"
    }

```
```
    "files": [
        ...
        "ext/sw-sardes/helper/theme_helper.php"
    ]
```
```
    "post-update-cmd": [
        ...
        "@php artisan migrate --path=ext/sw-sardes/lib/custom/setup/options",
        "Swordbros\\Sardes::composerUpdate"
    ]
```
