$(document).ready(function(){

    function resize(){
        var height = $(".b-menu").parent(".left").parent("div").height();
        $(".b-menu").css("height",height-19);
    }
    resize();

    setTimeout(resize,1000);

    $(window).resize(resize);

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