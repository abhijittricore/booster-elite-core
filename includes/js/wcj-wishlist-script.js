/**
 * wcj-opc-script.
 *
 * @version 1.0.0
 * @since  1.0.0
 */

jQuery(document).ready(function ($) {
    
    if( $("#wcj_wishlist_table_products").hasClass("wcj_wishlist_table_products") ){
        var wcj_guest_wishlist_str = wcj_getCookie('wcj_guest_wishlist_str');
        if( wcj_guest_wishlist_str != undefined && wcj_guest_wishlist_str != "" ){
            var data = {
                'action': 'wcj_wishlist_table_products',
                'wcj_guest_wishlist_str': wcj_guest_wishlist_str,
            };
            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    
                },
                success: function (response) {
                    $(".wcj_wishlist_table_products").html(response.guest_wishlist_html);
                },
                complete: function() {
                    
                }

            });
        }
        else{
            $(".wcj_wishlist_table_products").html('<tr><td colspan="6" style="text-align: center;">'+ajax_object.wishlist_page_table_msg+'</td><tr>');
        }
    }

    // add to wishlist
	$('body').on('click', ".wcj_ajax_add_to_wishlist", function(e){
        e.preventDefault();
        var thisobj = $(this);
        var product_id = $(this).data('product_id');
        
        if(ajax_object.logged_user_id != 0 && ajax_object.logged_user_id > 0){
            var data = {
                'action': 'wcj_ajax_add_to_wishlist',
                'product_id': product_id,
            };
            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $(thisobj).addClass('loading');
                    $('.wcj_wishlist_ajax_msg_'+product_id).remove();
                },
                success: function (response) {
                    if(response.success == 1){
                        $(thisobj).parent().append("<p class='wcj_wishlist_ajax_msg_"+product_id+"'> "+response.messages+" <a href='"+response.wishlist_url+"'>"+response.url_text+"</a></p>");
                    }
                },
                complete: function() {
                    $(thisobj).removeClass('loading');
                }

            });
        }
        else{
            $(".wcj_wishlist_ajax_msg_"+product_id).remove();
            $(thisobj).addClass('loading');
            var already = 0;
            var wcj_wishlist_str = wcj_getCookie('wcj_guest_wishlist_str');
            if( wcj_wishlist_str != undefined && wcj_wishlist_str != "" ){
                
                wcj_wishlist_arr = JSON.parse("[" + wcj_wishlist_str + "]");
                
                if( wcj_wishlist_arr.includes(product_id)  ){
                    var already = 1;
                }
                else{
                    wcj_wishlist_arr.push(product_id);
                    wcj_wishlist_str = wcj_wishlist_arr.toString();
                    wcj_setCookie('wcj_guest_wishlist_str', wcj_wishlist_str, 365);
                }
            }
            else{
                wcj_setCookie('wcj_guest_wishlist_str', product_id, 365);
            }

            setTimeout(function(){
                var wcj_add_message = "";
                if( already == 1 ){
                    wcj_add_message = ajax_object.wcj_already_to_wishlist_msg;
                }
                else{
                    wcj_add_message = ajax_object.wcj_added_to_wishlist_msg;
                }
                $(thisobj).parent().append("<p class='wcj_wishlist_ajax_msg_"+product_id+"'> "+wcj_add_message+" <a href='"+ajax_object.wcj_wishlist_url+"'>"+ajax_object.wcj_wishlist_url_text+"</a></p>");
                $(thisobj).removeClass('loading');
            },2000);
        }
    });

    // remove from wishlist
    $('body').on('click', ".wcj_ajax_remove_from_wishlist", function(e){
        e.preventDefault();
        var thisobj = $(this);
        var product_id = $(this).data('product_id');
        
        if(ajax_object.logged_user_id != 0 && ajax_object.logged_user_id > 0){
            var data = {
                'action': 'wcj_ajax_remove_from_wishlist',
                'product_id': product_id,
            };
            $.ajax({
                type: "POST",
                url: ajax_object.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    $(thisobj).addClass('loading');
                },
                success: function (response) {
                    if(response.success == 1){
                        $(thisobj).parent().parent().remove();
                    }
                },
                complete: function() {
                    $(thisobj).removeClass('loading');
                }

            });
        }
        else{
            $(thisobj).addClass('loading');

            var wcj_wishlist_str = wcj_getCookie('wcj_guest_wishlist_str');
            if( wcj_wishlist_str != undefined && wcj_wishlist_str != "" ){
                
                wcj_wishlist_arr = JSON.parse("[" + wcj_wishlist_str + "]");
                
                if( wcj_wishlist_arr.includes(product_id)  ){
                    wcj_wishlist_arr.splice(wcj_wishlist_arr.indexOf(product_id),1);
                    wcj_wishlist_str = wcj_wishlist_arr.toString();
                    wcj_setCookie('wcj_guest_wishlist_str', wcj_wishlist_str, 365);
                }
            }

            setTimeout(function(){
                $(thisobj).parent().parent().remove();
                $(thisobj).removeClass('loading');
            },2000);
        }
    });

    // add to cart wishlist product
    $('body').on('click', ".wcj_ajax_add_to_cart_wishlist_pro", function(e){
        e.preventDefault();
        var thisobj = $(this);
        var product_id = $(this).data('product_id');
        var data = {
            'action': 'wcj_ajax_add_to_cart_wishlist_pro',
            'product_id': product_id,
        };
        $.ajax({
            type: "POST",
            url: ajax_object.ajax_url,
            data: data,
            dataType: 'json',
            beforeSend: function() {
                $(thisobj).addClass('loading');
            },
            success: function (response) {
                if(response.success == 1){
                    var $wcj_wishlist_page_notice = $(".wcj_wishlist_page_notice");
                    $(thisobj).parent().parent().remove();
                    $('.wcj_wishlist_page_notice').html(response.messages);
                    $('html, body').animate({
                        scrollTop: ($wcj_wishlist_page_notice.offset().top - 50)
                    }, 500);
                    if(ajax_object.logged_user_id == 0 ){
                        var wcj_wishlist_str = wcj_getCookie('wcj_guest_wishlist_str');
                        if( wcj_wishlist_str != undefined && wcj_wishlist_str != "" ){
                            
                            wcj_wishlist_arr = JSON.parse("[" + wcj_wishlist_str + "]");
                            
                            if( wcj_wishlist_arr.includes(product_id)  ){
                                wcj_wishlist_arr.splice(wcj_wishlist_arr.indexOf(product_id),1);
                                wcj_wishlist_str = wcj_wishlist_arr.toString();
                                wcj_setCookie('wcj_guest_wishlist_str', wcj_wishlist_str, 365);
                            }
                        }
                    }
                }
            },
            complete: function() {
                $(thisobj).removeClass('loading');
            }

        });
    });

    // Set a Cookie
    function wcj_setCookie(cName, cValue, expDays) {
            let date = new Date();
            date.setTime(date.getTime() + (expDays * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
    }

    // Get a cookie
    function wcj_getCookie(cName) {
          const name = cName + "=";
          const cDecoded = decodeURIComponent(document.cookie); //to be careful
          const cArr = cDecoded .split('; ');
          let res;
          cArr.forEach(val => {
              if (val.indexOf(name) === 0) res = val.substring(name.length);
          })
          return res;
    }

});