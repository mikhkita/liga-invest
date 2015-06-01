$(document).ready(function(){

    // function resize(){
    //     var height = $(".b-menu").parent(".left").parent("div").height();
    //     $(".b-menu").css("height",height-19);
    // }
    // resize();

    // setTimeout(resize,1000);

    // $(window).resize(resize);
    var rePhone = /^(?:\+\d \(\d{3}\) \d{3}\-\d{2}\-\d{2})?$/,
        tePhone = '+7 (999) 999-99-99',
        reDate = /^(?:[0-3]\d\.[0-1]\d\.\d\d)?$/,
        teDate = '99.99.99'; 
        

    $.validator.addMethod('customPhone', function (value) {
        return rePhone.test(value);
    });
    $.validator.addMethod('customDate', function (value) {
        return reDate.test(value);
    });
    $(".agree-btn").parents('form').each(function(){
        $(this).validate({
            rules: {
                'User[usr_phone_number]': 'customPhone',
                'User[usr_qiwi]': 'customPhone',
                'User[usr_output_date]': 'customDate',
                'User[usr_passport_series]': {
                    number: true
                },
                'User[usr_yandex]': {
                    number: true
                },
                'User[usr_passport_number]': {
                    number: true
                },
            },
            messages: {
                'User[usr_passport_series]': {
                    number: "Поле заполнено неверно"
                },
                'User[usr_yandex]': {
                    number: "Поле заполнено неверно"
                },
                'User[usr_passport_number]': {
                    number: "Поле заполнено неверно"
                },
            }
        });
            $(this).find("input[name='User[usr_phone_number]'],input[name='User[usr_qiwi]']").mask(tePhone,{placeholder:"_"});
            $(this).find("input[name='User[usr_output_date]']").mask(teDate,{placeholder:"_"});
            $(this).find("input[name='User[usr_unit_code]']").mask("999-999",{placeholder:"_"});
            $(this).find("input[name='User[usr_card]']").mask("9999 9999 9999 9999",{placeholder:"_"});
    });

    $("select[name='investition']").change(function(){
        var program = $("select[name='investition'] option:selected").val();
        if($("div[data-id='"+program+"'] img").length) {
            $("#program img").attr("src",$("div[data-id='"+program+"'] img").attr("src"));
            $("#program").removeClass("no-image");
        } else {
            $("#program").addClass("no-image");
        }
        $("#program div").text($("div[data-id='"+program+"'] div").text());
        
    });

    var title = window.location.href,
    titleVar = 2;
    title = title.split(/[\/#?]+/);
    title = title[titleVar];
    $("li[data-name='"+title+"']").addClass("active");

    $("#check_agree").change(function(){
        if($("#check_agree").prop("checked")) {
            $(".agree-btn").prop("disabled",false).removeClass("disabled");
        } else {
            $(".agree-btn").prop("disabled",true).addClass("disabled");
        }
    });

//     function copy_clip(meintext)
// {
//  if (window.clipboardData) {
//    // для IE
//    window.clipboardData.setData("Text", meintext);
//    }
//    else if (window.netscape) 
//    { 
//     try {
//     if (netscape.security.PrivilegeManager.enablePrivilege)
//        netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');
//        // netscape.security.PrivilegeManager.enablePrivilege('UniversalBrowserRead');
//        // netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserWrite")
//     } catch (e) {alert('Настройка безопасности браузера не позволяет обращаться к буферу обмена!\n'+e); return;}

//        var clip = Components.classes['@mozilla.org/widget/clipboard;1']
//                      .createInstance(Components.interfaces.nsIClipboard);
//        alert(clip);
//        if (!clip) return;
       
//        var trans = Components.classes['@mozilla.org/widget/transferable;1']
//                       .createInstance(Components.interfaces.nsITransferable);
//        if (!trans) return;
       
//        trans.addDataFlavor('text/unicode');
       
//        var str = new Object();
//        var len = new Object();
       
//        var str = Components.classes["@mozilla.org/supports-string;1"]
//                     .createInstance(Components.interfaces.nsISupportsString);
       
//        var copytext=meintext;
       
//        str.data=copytext;
       
//        trans.setTransferData("text/unicode",str,copytext.length*2);
       
//        var clipid=Components.interfaces.nsIClipboard;
       
//        if (!clip) return false;
       
//        clip.setData(trans,null,clipid.kGlobalClipboard);
   
//    }
//    alert("В буфер обмена сохранено:\n\n" + meintext);
//    return false;
// }

    if( $("#map_canvas").length ){
    	var myPlace = new google.maps.LatLng(59.942342, 30.320029);
        var myOptions = {
            zoom: 16,
            center: myPlace,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true
        }
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 

        var marker = new google.maps.Marker({
    	    position: myPlace,
    	    map: map,
    	    title: "Лига Инвест Групп"
    	});
    }

    //  var options = {
    //     $AutoPlay: true,                                
    //     $SlideDuration: 500,                            

    //     $BulletNavigatorOptions: {                      
    //         $Class: $JssorBulletNavigator$,             
    //         $ChanceToShow: 2,                           
    //         $AutoCenter: 1,                            
    //         $Steps: 1,                                  
    //         $Lanes: 1,                                  
    //         $SpacingX: 10,                              
    //         $SpacingY: 10,                              
    //         $Orientation: 1                             
    //     }
    // };

    // var jssor_slider1 = new $JssorSlider$("slider1_container", options);

});