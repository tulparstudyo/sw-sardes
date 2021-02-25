/**
 * Specific JS for the elegance theme
 * 
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014
 */
var sardes = {
    "hello": function () {
        console.log('5e3f3a70f0e7e751bdf23ad726449141');
    },
    "getURLVar": function (key, url) {
        var value = [];

        var query = String(url).split('?');

        if (query[1]) {
            var part = query[1].split('&');

            for (i = 0; i < part.length; i++) {
                var data = part[i].split('=');

                if (data[0] && data[1]) {
                    value[data[0]] = data[1];
                }
            }

            if (value[key]) {
                return value[key];
            } else {
                return '';
            }
        }
    },
    "loadLocaleImage": function (input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                let thumb = $(input).parents('sardes-img').find('.image');
                $(thumb).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
}
$(document).ready(function () {
    sardes.hello();
    $('body').on('click', '.locale-select-language a', function (e) {
        e.preventDefault();
        document.cookie = "locale=" + sardes.getURLVar('locale', $(this).attr('href')) + ";  Path=/;expires=Fri, 31 Dec 9999 23:59:59 GMT";
        window.location.reload();
    });
    $('body').on('click', '.locale-select-currency a', function (e) {
        e.preventDefault();
        document.cookie = "currency=" + sardes.getURLVar('currency', $(this).attr('href')) + ";  Path=/;expires=Fri, 31 Dec 9999 23:59:59 GMT";
        window.location.reload();
    });
    $('body').on('change', '.sardes-img .image-file', function () {
        alert();
        sardes.loadLocaleImage(this);
    });


    $(".product__box form").on("submit", function (ev) {

        Aimeos.createOverlay();
        $.post($(this).attr("action"), $(this).serialize(), function (data) {
            Aimeos.createContainer(AimeosBasketStandard.updateBasket(data));
        });

        return false;
    });

    /*
    $("#formid").on("submit", function (ev) {

        Aimeos.createOverlay();
        $.post($(this).attr("action"), $(this).serialize(), function (data) {
            Aimeos.createContainer(AimeosBasketStandard.updateBasket(data));
        });

        return false;
    });*/

    AimeosBasketMini.updateBasket = function (basket) {

        if (!(basket.data && basket.data.attributes)) {
            return;
        }

        var attr = basket.data.attributes;
        var price = Number.parseFloat(attr['order.base.price']);
        var delivery = Number.parseFloat(attr['order.base.costs']);


        var formatter = new Intl.NumberFormat([], {
            currency: attr['order.base.currencyid'],
            style: "currency"
        });

        $(".aimeos .basket-mini-main .value").html(formatter.format(price + delivery));
        $(".aimeos .basket-mini-product .total .price").html(formatter.format(price + delivery));
        $(".aimeos .basket-mini-product .delivery .price").html(formatter.format(delivery));

        if (basket.included) {

            var csrf = '';
            var count = 0;
            var body = $(".aimeos .basket-mini-product .basket-body");
            var prototype = $(".aimeos .basket-mini-product .product.prototype");

            if (basket.meta && basket.meta.csrf) {
                csrf = basket.meta.csrf.name + '=' + basket.meta.csrf.value;
            }

            $(".aimeos .basket-mini-product .product").not(".prototype").remove();

            for (var i = 0; i < basket.included.length; i++) {
                var entry = basket.included[i];

                if (entry.type === 'basket/product') {
                    var product = prototype.clone();

                    product.data("urldata", csrf);
                    product.data("url", entry.links.self.href);
                    console.log(entry.attributes);
                    $(".name", product).html(entry.attributes['order.base.product.name']);
                    $(".quantity", product).html(entry.attributes['order.base.product.quantity']);
                    $(".price", product).html(formatter.format(entry.attributes['order.base.product.price']));
                    $(".product-image", product).attr("src", "/" + entry.attributes['order.base.product.mediaurl']);
                    body.append(product.removeClass("prototype"));

                    count += Number.parseInt(entry.attributes["order.base.product.quantity"]);
                }
            }

            $(".aimeos .basket-mini-main .quantity").html(count);
        }
    }


    $(".catalog-detail-basket form, .catalog-list-items form").off();
    $(".catalog-detail-basket form, .catalog-list-items form").on("submit", function (ev) {
        var valid = true;
        $("input.select-option").each(function (param) {
            if ($(this).prop("disabled")) return;
            var name = $(this).attr('name');
            if (!$("input[name='" + name + "']:checked").val()) {
                valid = false;
            }
        });
        if (valid) {
            Aimeos.createOverlay();
            $.post($(this).attr("action"), $(this).serialize(), function (data) {
                Aimeos.createContainer(AimeosBasketStandard.updateBasket(data));
            });
        } else {
            if ($('#select_option_alert').length) {
                var select_option_alert = $('#select_option_alert').val();
            } else {
                var select_option_alert = "Please select all required options.";
            }
            alert(select_option_alert);
        }
        return false;
    });






});



$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    console.log("tab shown...");
    localStorage.setItem('activeTab', $(e.target).attr('href'));
});

// read hash from page load and change tab
var activeTab = localStorage.getItem('activeTab');
if (activeTab) {
    $('.nav-tabs a[href="' + activeTab + '"]').tab('show');
}

