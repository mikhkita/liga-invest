var customHandlersAdmin = [];

$.fn.setCursorPosition = function(pos) {
    this.each(function(index, elem) {
    if (elem.setSelectionRange) {
        elem.setSelectionRange(pos, pos);
    } else if (elem.createTextRange) {
        var range = elem.createTextRange();
        range.collapse(true);
        range.moveEnd('character', pos);
        range.moveStart('character', pos);
        range.select();
    }
    });
    return this;
};
$(document).ready(function(){   
    var myWidth,
        myHeight,
        progress = new KitProgress("#D26A44",5);

    progress.endDuration = 0.3;
    progress.setTop(39);

    checkCookie();

    function whenResize(){
        if( typeof( window.innerWidth ) == 'number' ) {
            myWidth = window.innerWidth;
            myHeight = window.innerHeight;
        } else if( document.documentElement && ( document.documentElement.clientWidth || 
        document.documentElement.clientHeight ) ) {
            myWidth = document.documentElement.clientWidth;
            myHeight = document.documentElement.clientHeight;
        } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
            myWidth = document.body.clientWidth;
            myHeight = document.body.clientHeight;
        }
    }
    $(window).resize(whenResize);
    whenResize();

    $(".b-kit-update,.b-kit-create").fancybox({
        type: "ajax",
        closeBtn: false,
        helpers: {
            overlay: {
                locked: true 
            },
            title : null
        },
        padding: 0,
        margin: 30,
        beforeShow: function(){
            var $form = $(".fancybox-inner form");
            bindForm($form);
            // bindImageUploader();
            if( $form.attr("data-beforeShow") && customHandlers[$form.attr("data-beforeShow")] ){
                customHandlers[$form.attr("data-beforeShow")]($form);
            }
        },
        afterShow: function(){
            var field = $(".fancybox-inner").find("input,textarea").eq(0);
            field.focus();
            field.setCursorPosition(field.val().length);
        }
    });

    $(".b-kit-switcher").click(function(){
        toggleMode(!$(this).hasClass("checked"));
        return false;
    });

    function bindForm($form){
        $form.validate({
            ignore: ""
        });
        $form.submit(function(e){
            if( $(this).valid() && !$(this).find("input[type=submit]").hasClass("blocked") ){
                var $form = $(this),
                    url = $form.attr("action"),
                    data;

                $(this).find("input[type=submit]").addClass("blocked");

                progress.start(3);

                if( $form.attr("data-beforeAjax") && customHandlers[$form.attr("data-beforeAjax")] ){
                    customHandlers[$form.attr("data-beforeAjax")]($form);
                }

                $.ajax({
                    type: $form.attr("method"),
                    url: url,
                    data: $form.serialize(),
                    success: function(msg){
                        $form.find("input[type='text'],input[type='number'],textarea").val("");
                        $form.find("input").eq(0).focus();

                        progress.end(function(){
                            $form.find("input[type=submit]").removeClass("blocked");
                            setResult(msg);
                        });

                        $.fancybox.close();
                    }
                });
            }else{
                $(".fancybox-overlay").animate({
                    scrollTop : 0
                },200);
            }
            return false;
        });

        function setResult(msg){
            var json = JSON.parse(msg);

            if( json.result == "updated" ){
                $("*[data-id='"+json.id+"']").html(json.text);
            }
        }

        // $(".b-input-image").change(function(){
        //     var cont = $(this).parents(".b-image-cont").parent("div");
        //     if( $(this).val() != "" ){
        //         cont.find(".b-input-image-add").addClass("hidden");
        //         cont.find(".b-image-wrap").removeClass("hidden");
        //         cont.find(".b-input-image-img").css("background-image","url('/"+$(this).val()+"')");
        //     }else{
        //         cont.find(".b-input-image-add").removeClass("hidden");
        //         cont.find(".b-image-wrap").addClass("hidden");
        //     }
        // });

        // // Удаление изображения
        // $(".b-image-delete").click(function(){
        //     var cont = $(this).parents(".b-image-cont").parent("div");
        //     cont.find(".b-image-cancel").attr("data-url",cont.find(".b-input-image").val())// Сохраняем предыдущее изображение для того, чтобы можно было восстановить
        //                         .show();// Показываем кнопку отмены удаления
        //     cont.find(".b-input-image").val("").trigger("change");// Удаляем ссылку на фотку из поля
        // });

        // // Отмена удаления
        // $(".b-image-cancel").click(function(){
        //     var cont = $(this).parent("div");
        //     cont.find(".b-input-image").val(cont.find(".b-image-cancel").attr("data-url")).trigger("change")// Возвращаем сохраненную ссылку на изображение в поле
        //     cont.find(".b-image-cancel").hide(); // Прячем кнопку отмены удаления                                 
        // });

    }

    // function bindImageUploader(){
    //     $(".b-get-image").click(function(){
    //         var cont = $(this).parents(".b-image-cont").parent("div");
    //         $(".b-for-image-form").load(cont.find(".b-get-image").attr("data-path"), {}, function(){
    //             $(".upload").addClass("upload-show");
    //             $(".b-upload-overlay").addClass("b-upload-overlay-show")
    //             $(".plupload_cancel,.b-upload-overlay,.plupload_save").click(function(){
    //                 $(".b-upload-overlay").removeClass("b-upload-overlay-show");
    //                 $(".upload").addClass("upload-hide");
    //                 setTimeout(function(){
    //                     $(".b-for-image-form").html("");
    //                 },400);
    //                 return false;
    //             });
    //         });
    //     });
    // }

    /* Hot keys ------------------------------------ Hot keys */
    if( $(".b-kit-update").length ){
        var cmddown = false,
            ctrldown = false;
        function down(e){
            if( e.keyCode == 13 && ( cmddown || ctrldown ) ){
                if( !$(".b-kit-popup form").length ){
                    $(".b-kit-create").click();
                }else{
                    $(".fancybox-wrap form").trigger("submit",[false]);
                }
            }
            if( e.keyCode == 91 ) cmddown = true;
            if( e.keyCode == 17 ) ctrldown = true;
            if( e.keyCode == 27 && $(".fancybox-wrap").length ) $.fancybox.close();
        }
        function up(e){
            if( e.keyCode == 91 ) cmddown = false;
            if( e.keyCode == 17 ) ctrldown = false;
        }
        $(document).keydown(down);
        $(document).keyup(up);
    }
    /* Hot keys ------------------------------------ Hot keys */

    function transition(el,dur){
        el.css({
            "-webkit-transition":  "all "+dur+"s ease-in-out", "-moz-transition":  "all "+dur+"s ease-in-out", "-o-transition":  "all "+dur+"s ease-in-out", "transition":  "all "+dur+"s ease-in-out"
        });
    }

    // bindImageUploader();
});

function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
          "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : null;
    }

    function setCookie(name, value, options) {
        options = options || {};
    
        var expires = options.expires;
    
        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }
    
        value = encodeURIComponent(value);
    
        var updatedCookie = name + "=" + value;
    
        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }
    
        document.cookie = updatedCookie;
    }

    function deleteCookie(name) {
        setCookie(name, "", {
            expires: -1
        })
    }

    function checkCookie(){
        if( getCookie("edit") != null ){
            toggleMode(1);
        }else{
            toggleMode(0);
        }
    }

    function toggleMode(tog){
        if( tog ){
            setCookie("edit",1);
            $(".b-kit-switcher").addClass("checked");
            $(".b-kit-not-update").removeClass("b-kit-not-update").addClass("b-kit-update");
        }else{
            deleteCookie("edit");
            $(".b-kit-switcher").removeClass("checked");
            $(".b-kit-update").removeClass("b-kit-update").addClass("b-kit-not-update");
        }
    }