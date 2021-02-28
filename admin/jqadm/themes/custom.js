/*
 * Custom sw-sardes JS
 */
function loadLocaleImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
				let thumb = $(input).parents('.sardes-img').find('.image');
				console.log(thumb);
                $(thumb).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

$(document).ready(function(){
	$('.htmleditor').each(function(){
		CKEDITOR.replace( this , {

            allowedContent: true
        });
	});
	$.get( "/admin/default/jqadm/get/swordbros/sardes/admin-bar", function( data ) {
		$('.app-menu').prepend(data);
	});
    let url = window.location.href;
    if(url.indexOf('jqadm/search/log')>0){
        $.get( "/admin/default/jqadm/get/swordbros/sardes/main-navbar-log", function( data ) {
            $('.main-navbar.log').append(data);
        });
    } else if(url.indexOf('jqadm/search/product')>0){
        $.get( "/admin/default/jqadm/get/swordbros/sardes/main-navbar-product", function( data ) {
            $('.main-navbar').append(data);
        });
    }
	$('body').on('change', '.sardes-img .image-file', function(){
		loadLocaleImage(this);
	});
    $('body').on('change', '#excel-file', function(){
        $('#export-product').submit();
    });
});
