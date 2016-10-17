/*-----------------------------------------------------------------------------------

 	Custom JS 
 
-----------------------------------------------------------------------------------*/
function htmldecode(s){
    window.HTML_ESC_MAP = {
    "nbsp":" ","iexcl":"¡","cent":"¢","pound":"£","curren":"¤","yen":"¥","brvbar":"¦","sect":"§","uml":"¨","copy":"©","ordf":"ª","laquo":"«","not":"¬","reg":"®","macr":"¯","deg":"°","plusmn":"±","sup2":"²","sup3":"³","acute":"´","micro":"µ","para":"¶","middot":"·","cedil":"¸","sup1":"¹","ordm":"º","raquo":"»","frac14":"¼","frac12":"½","frac34":"¾","iquest":"¿","Agrave":"À","Aacute":"Á","Acirc":"Â","Atilde":"Ã","Auml":"Ä","Aring":"Å","AElig":"Æ","Ccedil":"Ç","Egrave":"È","Eacute":"É","Ecirc":"Ê","Euml":"Ë","Igrave":"Ì","Iacute":"Í","Icirc":"Î","Iuml":"Ï","ETH":"Ð","Ntilde":"Ñ","Ograve":"Ò","Oacute":"Ó","Ocirc":"Ô","Otilde":"Õ","Ouml":"Ö","times":"×","Oslash":"Ø","Ugrave":"Ù","Uacute":"Ú","Ucirc":"Û","Uuml":"Ü","Yacute":"Ý","THORN":"Þ","szlig":"ß","agrave":"à","aacute":"á","acirc":"â","atilde":"ã","auml":"ä","aring":"å","aelig":"æ","ccedil":"ç","egrave":"è","eacute":"é","ecirc":"ê","euml":"ë","igrave":"ì","iacute":"í","icirc":"î","iuml":"ï","eth":"ð","ntilde":"ñ","ograve":"ò","oacute":"ó","ocirc":"ô","otilde":"õ","ouml":"ö","divide":"÷","oslash":"ø","ugrave":"ù","uacute":"ú","ucirc":"û","uuml":"ü","yacute":"ý","thorn":"þ","yuml":"ÿ","fnof":"ƒ","Alpha":"Α","Beta":"Β","Gamma":"Γ","Delta":"Δ","Epsilon":"Ε","Zeta":"Ζ","Eta":"Η","Theta":"Θ","Iota":"Ι","Kappa":"Κ","Lambda":"Λ","Mu":"Μ","Nu":"Ν","Xi":"Ξ","Omicron":"Ο","Pi":"Π","Rho":"Ρ","Sigma":"Σ","Tau":"Τ","Upsilon":"Υ","Phi":"Φ","Chi":"Χ","Psi":"Ψ","Omega":"Ω","alpha":"α","beta":"β","gamma":"γ","delta":"δ","epsilon":"ε","zeta":"ζ","eta":"η","theta":"θ","iota":"ι","kappa":"κ","lambda":"λ","mu":"μ","nu":"ν","xi":"ξ","omicron":"ο","pi":"π","rho":"ρ","sigmaf":"ς","sigma":"σ","tau":"τ","upsilon":"υ","phi":"φ","chi":"χ","psi":"ψ","omega":"ω","thetasym":"ϑ","upsih":"ϒ","piv":"ϖ","bull":"•","hellip":"…","prime":"′","Prime":"″","oline":"‾","frasl":"⁄","weierp":"℘","image":"ℑ","real":"ℜ","trade":"™","alefsym":"ℵ","larr":"←","uarr":"↑","rarr":"→","darr":"↓","harr":"↔","crarr":"↵","lArr":"⇐","uArr":"⇑","rArr":"⇒","dArr":"⇓","hArr":"⇔","forall":"∀","part":"∂","exist":"∃","empty":"∅","nabla":"∇","isin":"∈","notin":"∉","ni":"∋","prod":"∏","sum":"∑","minus":"−","lowast":"∗","radic":"√","prop":"∝","infin":"∞","ang":"∠","and":"∧","or":"∨","cap":"∩","cup":"∪","int":"∫","there4":"∴","sim":"∼","cong":"≅","asymp":"≈","ne":"≠","equiv":"≡","le":"≤","ge":"≥","sub":"⊂","sup":"⊃","nsub":"⊄","sube":"⊆","supe":"⊇","oplus":"⊕","otimes":"⊗","perp":"⊥","sdot":"⋅","lceil":"⌈","rceil":"⌉","lfloor":"⌊","rfloor":"⌋","lang":"〈","rang":"〉","loz":"◊","spades":"♠","clubs":"♣","hearts":"♥","diams":"♦","\"":"quot","amp":"&","lt":"<","gt":">","OElig":"Œ","oelig":"œ","Scaron":"Š","scaron":"š","Yuml":"Ÿ","circ":"ˆ","tilde":"˜","ndash":"–","mdash":"—","lsquo":"‘","rsquo":"’","sbquo":"‚","ldquo":"“","rdquo":"”","bdquo":"„","dagger":"†","Dagger":"‡","permil":"‰","lsaquo":"‹","rsaquo":"›","euro":"€"};
    if(!window.HTML_ESC_MAP_EXP)
        window.HTML_ESC_MAP_EXP = new RegExp("&("+Object.keys(HTML_ESC_MAP).join("|")+");","g");
    return s?s.replace(window.HTML_ESC_MAP_EXP,function(x){
        return HTML_ESC_MAP[x.substring(1,x.length-1)]||x;
    }):s;
}
var map;
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 7.511200, lng: 80.677505}, 
		zoom: 10,
	});
	var marker=new google.maps.Marker({
		position:{lat: 7.511200, lng: 80.677505},
		  // animation:google.maps.Animation.BOUNCE,
		});

	marker.setMap(map);
	var infowindow = new google.maps.InfoWindow({
		content:"Longville Estate Bungalow, <br> Rattota , <br>Matale."
	});

	infowindow.open(map,marker);
}

var ua = window.navigator.userAgent;
var safari = ua.indexOf("safari ");
var msie = ua.indexOf("MSIE ");
var ua = navigator.userAgent.toLowerCase(); 
if (ua.indexOf('safari') != -1) { 
  if (ua.indexOf('chrome') > -1) {
   $('body').addClass('chrome');
  } else {
  	$('body').addClass('safari');
   $('.left-panel-cont').css('height',$('.right-panel').height());
  }
}


if (msie > 0 && parseInt(ua.substring(msie + 5, ua.indexOf(".", msie))) < 11) // If Internet Explorer, return version number
{
   $('body').addClass('lie');
   $('#map').css('height',$('#carousel-excursion img').height());
   // $('#map').css('margin-right','0 !important');
   $('#map .gm-style').css('position','relative !important');
   $('.left-panel-cont').css('height',$('.right-panel-cont').height());
   $('.right-panel-cont .cont').css('height',$('.right-panel-cont img').height());
   $( window ).resize(function() {
	  $('#map').css('height',$('#carousel-excursion img').height());
	  $('.left-panel-cont').css('height',$('.right-panel-cont').height());
	  $('.right-panel-cont cont').css('height',$('.right-panel-cont img').height());
	});
}

$(window).resize(function(){
	if( $(window).width() > 767 ){
		$('header .header-nav-container nav ul').removeAttr('style');
	}
});


$(document).ready(function(){
	
	$('header .header-nav-container nav .mobile-menu-icon-wrp span').click(function(){
		$('header .header-nav-container nav ul').slideToggle('medium');
	});

	$('.booking-wrp .bkdate .inpt-wrp input').datetimepicker({
		format: 'DD/MM/YYYY'
	});
	$('.booking-wrp .packages .inpt-wrp').click(function(){
		$('.booking-wrp .packages ul').slideToggle();
	});
	$('.booking-wrp .destinations .inpt-wrp').click(function(){
		$('.booking-wrp .destinations ul').slideToggle();
	});
	// -------------------

	$('.booking-wrp .packages ul li').click(function(){
		$('.booking-wrp .packages .inpt-wrp input').val(htmldecode($(this).html()));
		$('.booking-wrp .packages ul').slideToggle();
	});
	$('.booking-wrp .destinations ul li').click(function(){
		$('.booking-wrp .destinations .inpt-wrp input').val(htmldecode($(this).html()));
		$('.booking-wrp .destinations ul').slideToggle();
	});

	$(document).ready(function() {
 
  	$("#top-destinations").owlCarousel({
  		// Most important owl features
	    items : 1,
	    itemsCustom : false,
	    itemsDesktop : [1199,1],
	    itemsDesktopSmall : [980,1],
	    itemsTablet: [768,2],
	    itemsTabletSmall: false,
	    itemsMobile : [479,1],
	    singleItem : false,
	    itemsScaleUp : false,
	    // Navigation
	    navigation : true,
	    navigationText : ["&lt;","&gt;"],
	    rewindNav : true,
	    scrollPerPage : false,
	 
	    //Pagination
	    pagination : false,
	    paginationNumbers: false,
	 
	    // Responsive 
	    responsive: true,
	    responsiveRefreshRate : 200,
	    responsiveBaseWidth: window,

	    //Lazy load
	    lazyLoad : true,
	    lazyFollow : true,
	    lazyEffect : "fade",

	    //Mouse Events
	    dragBeforeAnimFinish : true,
	    mouseDrag : true,
	    touchDrag : true,
    });
 	$("#top-reviews").owlCarousel({
 		items : 1,
	    itemsCustom : false,
	    itemsDesktop : [1199,1],
	    itemsDesktopSmall : [980,1],
	    itemsTablet: [768,1],
	    itemsTabletSmall: false,
	    itemsMobile : [479,1],
	    singleItem : false,
	    itemsScaleUp : false,
	    // Navigation
	    navigation : true,
	    navigationText : ["&lt;","&gt;"],
	    rewindNav : true,
	    scrollPerPage : false,
	 
	    //Pagination
	    pagination : false,
	    paginationNumbers: false,
	 
	    // Responsive 
	    responsive: true,
	    responsiveRefreshRate : 200,
	    responsiveBaseWidth: window,
	    //Mouse Events
	    dragBeforeAnimFinish : true,
	    mouseDrag : true,
	    touchDrag : true,
 	});
});

});

$(document).ready(function(){
	// reviewResize( $(window).width() );
});

$(window).resize(function(){
 	// reviewResize( $(window).width() );
});

function reviewResize( ww ){
	if ( ww > 767) {
		var maxH = new Array();
		$.each($('.review-row'),function(key,value){
			maxH.push($(value).height());
		});
		var sel = $('.review-row');
		var max = Math.max.apply(Math,maxH);
		var key = '';
		for (var i = 0; i < maxH.length; i++) {
			if(maxH[i] == max) {
				key = i;
				break;
			}
		}
		$.each($('.review-row'),function(akey,value){
			console.log(akey != key);
			if(akey != key)
				$($('.review-row')[akey]).css('height',maxH[key] + 41);
		});
		
	}
}
// $(window).ready(function(){
// 	var sh = $('#top-destinations .owl-wrapper-outer');
// 	$('.home-about-section .cont-wrp').css('height',$(sh).height());
// 	$('.home-top-destination-title').css('width',$(sh).width());
// });
// $(window).resize(function(){
// 	var sh = $('#top-destinations .owl-wrapper-outer');
// 	$('.home-about-section .cont-wrp').css('height',$(sh).height());
// 	$('.home-top-destination-title').css('width',$(sh).width());
// });
