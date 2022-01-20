/**
 * wcj-frontend-pvs-script.
 *
 * @version 1.0.2
 * @since   1.0.2
 */

jQuery(document).ready(function ($) {

    $("body").on("click",".variable-items-wrapper .variable-item",function(){
        var type = $(this).data('type');
        var value = $(this).data('value');
        
        if(type){
            $('.wcj_pvs_select_type_'+type).val('').trigger('change');
            $("."+type+"-variable-item").removeClass('selected');
        }

        $(this).addClass('selected');

        // $(this).toggleClass('selected');

        if(type != "" && value != ""){
            $('.wcj_pvs_select_type_'+type).val(value).trigger('change');
        
        }
    })

    $("body").on("click",".reset_variations",function(){
        $(".wcj_variable_items_wrapper li").removeClass("selected");
    });

});