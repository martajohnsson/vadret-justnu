$(document).ready(function() {


	// CACHE
	$.ajaxSetup({cache:true});

	// VARIABEL: Webbsidan
	sitename = 'Vädret just nu';
	folder_name = '/vadret-justnu';

	// TOOLTIP
	$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

	// KLASSER
	id_content = '#content';
	id_help = '#help';
	id_google_maps_position = 'google-maps-position';
	id_google_maps_position_current = 'google-maps-position-current';

	// VARIABLAR: Kaka
	cookie_tempmenu = 'vjn_tempmenu';

	// VARIABLAR: Timeouts
	timeout_1000 = 1000;
	timeout_1500 = 1500;
	timeout_3000 = 3000;

	// AJAX-TYPER
	ajax_type_get = 'GET';
	ajax_type_post = 'POST';


	// KAKA: Visa temperaturen i huvudmenyn
	if($.cookie(cookie_tempmenu)) {

		// HÄMTA
		$.ajax({
			url: folder_name + '/get/weather/temperature/' + $.cookie(cookie_tempmenu),
			type: ajax_type_get,
			beforeSend: function(b) {
				
			},

			success: function(s) {
				$.getScript(folder_name + '/configurations/required/javascripts/javascript-tooltip.js');

				$('.menu-temperature').css({ 'color': '#666666', 'cursor': 'pointer' }).attr({ 'id': 'menu', 'data': 'temperature', 'title': 'Gå till den sparade platsen' });
				$('#temperature').html(s);
				$('.icon-delete-temperature').show();

				$.cookie(cookie_tempmenu, $.cookie(cookie_tempmenu), { expires: 7, path: '/' });
			},

			error: function(e) {
				
			}
		});

	};


	// KAKA: Visa temperaturen i huvudmenyn
	$('body').on('click', '.menu-temperature', function() {

		// SPLITTRA
		var cookie_temperature = $.cookie(cookie_tempmenu);
		var coordinates_temperature = cookie_temperature.split('-');

		window.location = folder_name + '/' + coordinates_temperature[0];

	});



	// TEXTFÄLT: Anpassa textfältet efter textens höjd
	$("textarea").autosize();

	// HÖGERKLICK: Inaktivera högerklick på bilder
	$("img").each(function(){$(this)[0].oncontextmenu=function(){return false}});

	// TEXTFÄLT: Inaktivera den automatiska "autocomplete"-funktionen
	$("input").attr("autocomplete","off");

	// ÖPPNA I EN NY FLIK
	$("a").each(function(){var b=new RegExp("/"+window.location.host+"/");if(!b.test(this.href)&&$(this).prop("href")!="javascript:void(0)"){$(this).attr({title:"Öppnas i en ny flik"});$(this).click(function(a){a.preventDefault();a.stopPropagation();window.open(this.href,"_blank")})}});

	// TIMEAGO
	$.timeago.settings.strings={prefixAgo:"för",prefixFromNow:"om",suffixAgo:"sedan",suffixFromNow:"",seconds:"mindre än en minut",minute:"ungefär en minut",minutes:"%d minuter",hour:"ungefär en timme",hours:"ungefär %d timmar",day:"en dag",days:"%d dagar",month:"ungefär en månad",months:"%d månader",year:"ungefär ett år",years:"%d år"};

	// MER INFORMATION: Stäng
	// $("body").on("click",class_overlay_close,function(){$("input, textarea, select").attr("disabled",false);$(class_overlay).hide();$(class_overlay_view).hide();$("html").css({"overflow-y":"scroll"});window.scrollTo(0, scroll_position)});
	// $("body").on("keyup",function(e){if(e.keyCode==27){$("input, textarea, select").attr("disabled",false);$(class_overlay).hide();$(class_overlay_view).hide();$("html").css({"overflow-y":"scroll"});window.scrollTo(0, scroll_position)}});



	$('body').on('click', '#menu', function() {
		var menu_data = $(this).attr('data');
		var menu_data_coordinates = $(this).attr('data-coordinates');

		if(menu_data == 'home') {
			window.location = folder_name;

		} else if(menu_data == 'home-coordinates') {
			window.location = folder_name + '/start-with:' + menu_data_coordinates;

		} else if(menu_data == 'history') {
			window.location = folder_name + '/history';

		} else if(menu_data == 'manual') {
			window.location = folder_name + '/manual';
		}
	});


});











;(function(a){a.tooltipsy=function(c,b){this.options=b;this.$el=a(c);this.title=this.$el.attr("title")||"";this.$el.attr("title","");this.random=parseInt(Math.random()*10000);this.ready=false;this.shown=false;this.width=0;this.height=0;this.delaytimer=null;this.$el.data("tooltipsy",this);this.init()};a.tooltipsy.prototype={init:function(){var e=this,d,b=e.$el,c=b[0];e.settings=d=a.extend({},e.defaults,e.options);d.delay=+d.delay;if(typeof d.content==="function"){e.readify()}if(d.showEvent===d.hideEvent&&d.showEvent==="click"){b.toggle(function(f){if(d.showEvent==="click"&&c.tagName=="A"){f.preventDefault()}if(d.delay>0){e.delaytimer=window.setTimeout(function(){e.show(f)},d.delay)}else{e.show(f)}},function(f){if(d.showEvent==="click"&&c.tagName=="A"){f.preventDefault()}window.clearTimeout(e.delaytimer);e.delaytimer=null;e.hide(f)})}else{b.bind(d.showEvent,function(f){if(d.showEvent==="click"&&c.tagName=="A"){f.preventDefault()}e.delaytimer=window.setTimeout(function(){e.show(f)},d.delay||0)}).bind(d.hideEvent,function(f){if(d.showEvent==="click"&&c.tagName=="A"){f.preventDefault()}window.clearTimeout(e.delaytimer);e.delaytimer=null;e.hide(f)})}},show:function(i){if(this.ready===false){this.readify()}var b=this,f=b.settings,h=b.$tipsy,k=b.$el,d=k[0],g=b.offset(d);if(b.shown===false){if((function(m){var l=0,e;for(e in m){if(m.hasOwnProperty(e)){l++}}return l})(f.css)>0){b.$tip.css(f.css)}b.width=h.outerWidth();b.height=h.outerHeight()}if(f.alignTo==="cursor"&&i){var j=[i.clientX+f.offset[0],i.clientY+f.offset[1]];if(j[0]+b.width>a(window).width()){var c={top:j[1]+"px",right:j[0]+"px",left:"auto"}}else{var c={top:j[1]+"px",left:j[0]+"px",right:"auto"}}}else{var j=[(function(){if(f.offset[0]<0){return g.left-Math.abs(f.offset[0])-b.width}else{if(f.offset[0]===0){return g.left-((b.width-k.outerWidth())/2)}else{return g.left+k.outerWidth()+f.offset[0]}}})(),(function(){if(f.offset[1]<0){return g.top-Math.abs(f.offset[1])-b.height}else{if(f.offset[1]===0){return g.top-((b.height-b.$el.outerHeight())/2)}else{return g.top+b.$el.outerHeight()+f.offset[1]}}})()]}h.css({top:j[1]+"px",left:j[0]+"px"});b.settings.show(i,h.stop(true,true))},hide:function(c){var b=this;if(b.ready===false){return}if(c&&c.relatedTarget===b.$tip[0]){b.$tip.bind("mouseleave",function(d){if(d.relatedTarget===b.$el[0]){return}b.settings.hide(d,b.$tipsy.stop(true,true))});return}b.settings.hide(c,b.$tipsy.stop(true,true))},readify:function(){this.ready=true;this.$tipsy=a('<div id="tooltipsy'+this.random+'" style="position:fixed;z-index:2147483647;display:none">').appendTo("body");this.$tip=a('<div class="'+this.settings.className+'">').appendTo(this.$tipsy);this.$tip.data("rootel",this.$el);var c=this.$el;var b=this.$tip;this.$tip.html(this.settings.content!=""?(typeof this.settings.content=="string"?this.settings.content:this.settings.content(c,b)):this.title)},offset:function(b){return this.$el[0].getBoundingClientRect()},destroy:function(){if(this.$tipsy){this.$tipsy.remove();a.removeData(this.$el,"tooltipsy")}},defaults:{alignTo:"element",offset:[0,-1],content:"",show:function(c,b){b.fadeIn(100)},hide:function(c,b){b.fadeOut(100)},css:{},className:"tooltipsy",delay:200,showEvent:"mouseenter",hideEvent:"mouseleave"}};a.fn.tooltipsy=function(b){return this.each(function(){new a.tooltipsy(this,b)})}})(jQuery);
jQuery.fn.forceNumeric=function(){return this.each(function(){$(this).keydown(function(b){var a=b.which||b.keyCode;if(!b.shiftKey&&!b.altKey&&!b.ctrlKey&&a>=48&&a<=57||a>=96&&a<=105||a==190||a==188||a==110||a==8||a==9||a==13||a==37||a==39||a==35||a==36||a==46||a==116||a==65&&b.ctrlKey===true||a==86&&b.ctrlKey===true){return true}else{return false}})})};
function disabled_fields(a,b){if(b==true){$(a).each(function(){$(this).attr("disabled",true)})}else{if(b==false){$(a).each(function(){$(this).attr("disabled",false)})}}};
function number_format(f,c,h,e){f=(f+"").replace(/[^0-9+\-Ee.]/g,"");var b=!isFinite(+f)?0:+f,a=!isFinite(+c)?0:Math.abs(c),j=(typeof e==="undefined")?",":e,d=(typeof h==="undefined")?".":h,i="",g=function(o,m){var l=Math.pow(10,m);return""+Math.round(o*l)/l};i=(a?g(b,a):""+Math.round(b)).split(".");if(i[0].length>3){i[0]=i[0].replace(/\B(?=(?:\d{3})+(?!\d))/g,j)}if((i[1]||"").length<a){i[1]=i[1]||"";i[1]+=new Array(a-i[1].length+1).join("0")}return i.join(d)};
function calculate_distance(f,i,e,h){var g=6371;var k=toRad(e-f);var b=toRad(h-i);var f=toRad(f);var e=toRad(e);var m=Math.sin(k/2)*Math.sin(k/2)+Math.sin(b/2)*Math.sin(b/2)*Math.cos(f)*Math.cos(e);var l=2*Math.atan2(Math.sqrt(m),Math.sqrt(1-m));var j=g*l;return j}function toRad(a){return a*Math.PI/180};
function convert_ms(d){var b=parseInt((d%1000)/100),e=parseInt((d/1000)%60),c=parseInt((d/(1000*60))%60),a=parseInt((d/(1000*60*60))%24);if(a!=0&&c==0&&e==0&&b==0){return a+" "+(a==1?"timme":"timmar")}else{if(a!=0&&c!=0&&e!=0&&b==0){return a+" "+(a==1?"timme":"timmar")+", "+c+" "+(c==1?"minut":"minuter")+" och "+e+" "+(e==1?"sekund":"sekunder")}else{if(a==0&&c!=0&&e==0&&b==0){return c+" "+(c==1?"minut":"minuter")}else{if(a==0&&c!=0&&e!=0&&b==0){return c+" "+(c==1?"minut":"minuter")+" och "+e+" "+(e==1?"sekund":"sekunder")}else{if(a==0&&c==0&&e!=0&&b==0){return e+" "+(e==1?"sekund":"sekunder")}else{if(a==0&&c==0&&e==0&&b!=0){return b+" "+(b==1?"millisekund":"millisekunder")}}}}}}};
function new_tab(a){var b=window.open(a,"_blank");b.focus()};
function current_datetime(){var g=new Date();var d=g.getFullYear();var e=g.getMonth()+1;var b=g.getDay();var a=g.getHours();var c=g.getMinutes();var f=g.getSeconds();return d+"-"+(e<10?"0"+e:e)+"-"+(b<10?"0"+b:b)+", "+(a<10?"0"+a:a)+":"+(c<10?"0"+c:c)+":"+(f<10?"0"+f:f)};

function temp(value, unit) {
	var split = value.split('.');
	console.log(split);
	// var temp_value = (split[1] == 0 ? split[0] : number_format(split[0].'.'.split[1], 1));

	// return temp_value;
}





/*
function gm(lat, lng, id, saved) {

	// VARIABLAR
	var map;
	var map_coordinates;
	var map_options;
	var marker;


	// FUNKTION
	// function initialize() {
		geocoder = new google.maps.Geocoder();
		map_coordinates = new google.maps.LatLng(lat, lng);

		map_options = {
			center: map_coordinates,
			zoom: 8,
			minZoom: 2,
			maxZoom: 19,
			streetViewControl: false
		};

		map = new google.maps.Map(document.getElementById(id), map_options);

		marker = new google.maps.Marker({
			position: map_coordinates,
			map: map,
			draggable: false
		});

		geocoder.geocode({'latLng': map_coordinates}, function(results, status) {
			if(status == google.maps.GeocoderStatus.OK) {
				if(results[0]) {

					for(i = 0; i < results[0].address_components.length; i++) {
						if(results[0].address_components[i].types[0] == 'route') {
							var route = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'street_number') {
							var street_number = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'administrative_area_level_2') {
							var city = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'administrative_area_level_1') {
							var county = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'postal_code') {
							var postal_code = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'country') {
							var country = results[0].address_components[i].long_name;
						}

						if(results[0].address_components[i].types[0] == 'postal_town') {
							var postal_town = results[0].address_components[i].long_name;
						}
					}


					var route_string = (route == undefined ? '' : route);
					var street_number_string = (street_number == undefined ? '' : (route.match(/\d+/g) ? '' : ' ' + street_number));
					var postal_code_string = (postal_code == undefined ? '' : ', ' + postal_code);
					var postal_town_string = (postal_town == undefined ? '' : ' ' + postal_town);
					var city_string = (city == undefined ? '' : (postal_town == city ? '' : ', ' + city));
					var county_string = (county == undefined ? '' : ', ' + county);
					var country_string = (country == undefined ? '' : ', ' + country);

					var address_string = route_string + street_number_string + postal_code_string + postal_town_string + city_string + county_string + country_string;
					$(class_google_maps_address).html(address_string);



					// if(saved == 0) {

						$.ajax({
							url: folder_name + '/configurations/required/javascripts/gets/address.php?coor=' + lat + ',' + lng + '&s=' + route + '&sn=' + street_number + '&pc=' + postal_code + '&pt=' + postal_town + '&ci=' + city + '&cy=' + county + '&cry=' + country,
							type: ajax_type_get,
							success: function(s) {
								
							},
							error: function(e) {
								console.log(e);
							}
						});

					// }

				}
			} else {
				var error = {
					'ZERO_RESULTS': 'Kunde inte hitta någon adress',
					'OVER_QUERY_LIMIT': 'Andelen för adress-utdelning, överskreds',
					'REQUEST_DENIED': 'Förfrågan om adressen nekades av servern',
					'INVALID_REQUEST': 'Koordinaterna kunde inte hittas',
					'UNKNOWN_ERROR': 'Okänt fel uppstod. Var god ladda om sidan för att försöka igen'
				};

				$(class_google_maps_address).html('<div class="color-blue">' + error[status] + '</div>');
			}
		});



		// KARTA: Vänta tills kartan har laddats klart
		google.maps.event.addListener(map, 'tilesloaded', function() {
			maploaded = true;

			if(maploaded == true) {
				$(class_google_maps_loader_current).fadeOut('fast');
			}
		});




		var newLatLng = new google.maps.LatLng(lat, lng);
		marker.setPosition(newLatLng);
	// }

}
*/





/*!
	Autosize v1.18.4 - 2014-01-11
	Automatically adjust textarea height based on user input.
	(c) 2014 Jack Moore - http://www.jacklmoore.com/autosize
	license: http://www.opensource.org/licenses/mit-license.php
*/

!function(a){var b,c={className:"autosizejs",append:"",callback:!1,resizeDelay:10,placeholder:!0},d='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',e=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],f=a(d).data("autosize",!0)[0];f.style.lineHeight="99px","99px"===a(f).css("lineHeight")&&e.push("lineHeight"),f.style.lineHeight="",a.fn.autosize=function(d){return this.length?(d=a.extend({},c,d||{}),f.parentNode!==document.body&&a(document.body).append(f),this.each(function(){function c(){var b,c=window.getComputedStyle?window.getComputedStyle(m,null):!1;c?(b=m.getBoundingClientRect().width,0===b&&(b=parseInt(c.width,10)),a.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(a,d){b-=parseInt(c[d],10)})):b=Math.max(n.width(),0),f.style.width=b+"px"}function g(){var g={};if(b=m,f.className=d.className,j=parseInt(n.css("maxHeight"),10),a.each(e,function(a,b){g[b]=n.css(b)}),a(f).css(g),c(),window.chrome){var h=m.style.width;m.style.width="0px";{m.offsetWidth}m.style.width=h}}function h(){var e,h;b!==m?g():c(),f.value=!m.value&&d.placeholder?(a(m).attr("placeholder")||"")+d.append:m.value+d.append,f.style.overflowY=m.style.overflowY,h=parseInt(m.style.height,10),f.scrollTop=0,f.scrollTop=9e4,e=f.scrollTop,j&&e>j?(m.style.overflowY="scroll",e=j):(m.style.overflowY="hidden",k>e&&(e=k)),e+=o,h!==e&&(m.style.height=e+"px",p&&d.callback.call(m,m))}function i(){clearTimeout(l),l=setTimeout(function(){var a=n.width();a!==r&&(r=a,h())},parseInt(d.resizeDelay,10))}var j,k,l,m=this,n=a(m),o=0,p=a.isFunction(d.callback),q={height:m.style.height,overflow:m.style.overflow,overflowY:m.style.overflowY,wordWrap:m.style.wordWrap,resize:m.style.resize},r=n.width();n.data("autosize")||(n.data("autosize",!0),("border-box"===n.css("box-sizing")||"border-box"===n.css("-moz-box-sizing")||"border-box"===n.css("-webkit-box-sizing"))&&(o=n.outerHeight()-n.height()),k=Math.max(parseInt(n.css("minHeight"),10)-o||0,n.height()),n.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===n.css("resize")||"vertical"===n.css("resize")?"none":"horizontal"}),"onpropertychange"in m?"oninput"in m?n.on("input.autosize keyup.autosize",h):n.on("propertychange.autosize",function(){"value"===event.propertyName&&h()}):n.on("input.autosize",h),d.resizeDelay!==!1&&a(window).on("resize.autosize",i),n.on("autosize.resize",h),n.on("autosize.resizeIncludeStyle",function(){b=null,h()}),n.on("autosize.destroy",function(){b=null,clearTimeout(l),a(window).off("resize",i),n.off("autosize").off(".autosize").css(q).removeData("autosize")}),h())})):this}}(window.jQuery||window.$);





var Chart=function(s){function v(a,c,b){a=A((a-c.graphMin)/(c.steps*c.stepValue),1,0);return b*c.steps*a}function x(a,c,b,e){function h(){g+=f;var k=a.animation?A(d(g),null,0):1;e.clearRect(0,0,q,u);a.scaleOverlay?(b(k),c()):(c(),b(k));if(1>=g)D(h);else if("function"==typeof a.onAnimationComplete)a.onAnimationComplete()}var f=a.animation?1/A(a.animationSteps,Number.MAX_VALUE,1):1,d=B[a.animationEasing],g=a.animation?0:1;"function"!==typeof c&&(c=function(){});D(h)}function C(a,c,b,e,h,f){var d;a=
Math.floor(Math.log(e-h)/Math.LN10);h=Math.floor(h/(1*Math.pow(10,a)))*Math.pow(10,a);e=Math.ceil(e/(1*Math.pow(10,a)))*Math.pow(10,a)-h;a=Math.pow(10,a);for(d=Math.round(e/a);d<b||d>c;)a=d<b?a/2:2*a,d=Math.round(e/a);c=[];z(f,c,d,h,a);return{steps:d,stepValue:a,graphMin:h,labels:c}}function z(a,c,b,e,h){if(a)for(var f=1;f<b+1;f++)c.push(E(a,{value:(e+h*f).toFixed(0!=h%1?h.toString().split(".")[1].length:0)}))}function A(a,c,b){return!isNaN(parseFloat(c))&&isFinite(c)&&a>c?c:!isNaN(parseFloat(b))&&
isFinite(b)&&a<b?b:a}function y(a,c){var b={},e;for(e in a)b[e]=a[e];for(e in c)b[e]=c[e];return b}function E(a,c){var b=!/\W/.test(a)?F[a]=F[a]||E(document.getElementById(a).innerHTML):new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+a.replace(/[\r\t\n]/g," ").split("<%").join("\t").replace(/((^|%>)[^\t]*)'/g,"$1\r").replace(/\t=(.*?)%>/g,"',$1,'").split("\t").join("');").split("%>").join("p.push('").split("\r").join("\\'")+"');}return p.join('');");return c?
b(c):b}var r=this,B={linear:function(a){return a},easeInQuad:function(a){return a*a},easeOutQuad:function(a){return-1*a*(a-2)},easeInOutQuad:function(a){return 1>(a/=0.5)?0.5*a*a:-0.5*(--a*(a-2)-1)},easeInCubic:function(a){return a*a*a},easeOutCubic:function(a){return 1*((a=a/1-1)*a*a+1)},easeInOutCubic:function(a){return 1>(a/=0.5)?0.5*a*a*a:0.5*((a-=2)*a*a+2)},easeInQuart:function(a){return a*a*a*a},easeOutQuart:function(a){return-1*((a=a/1-1)*a*a*a-1)},easeInOutQuart:function(a){return 1>(a/=0.5)?
0.5*a*a*a*a:-0.5*((a-=2)*a*a*a-2)},easeInQuint:function(a){return 1*(a/=1)*a*a*a*a},easeOutQuint:function(a){return 1*((a=a/1-1)*a*a*a*a+1)},easeInOutQuint:function(a){return 1>(a/=0.5)?0.5*a*a*a*a*a:0.5*((a-=2)*a*a*a*a+2)},easeInSine:function(a){return-1*Math.cos(a/1*(Math.PI/2))+1},easeOutSine:function(a){return 1*Math.sin(a/1*(Math.PI/2))},easeInOutSine:function(a){return-0.5*(Math.cos(Math.PI*a/1)-1)},easeInExpo:function(a){return 0==a?1:1*Math.pow(2,10*(a/1-1))},easeOutExpo:function(a){return 1==
a?1:1*(-Math.pow(2,-10*a/1)+1)},easeInOutExpo:function(a){return 0==a?0:1==a?1:1>(a/=0.5)?0.5*Math.pow(2,10*(a-1)):0.5*(-Math.pow(2,-10*--a)+2)},easeInCirc:function(a){return 1<=a?a:-1*(Math.sqrt(1-(a/=1)*a)-1)},easeOutCirc:function(a){return 1*Math.sqrt(1-(a=a/1-1)*a)},easeInOutCirc:function(a){return 1>(a/=0.5)?-0.5*(Math.sqrt(1-a*a)-1):0.5*(Math.sqrt(1-(a-=2)*a)+1)},easeInElastic:function(a){var c=1.70158,b=0,e=1;if(0==a)return 0;if(1==(a/=1))return 1;b||(b=0.3);e<Math.abs(1)?(e=1,c=b/4):c=b/(2*
Math.PI)*Math.asin(1/e);return-(e*Math.pow(2,10*(a-=1))*Math.sin((1*a-c)*2*Math.PI/b))},easeOutElastic:function(a){var c=1.70158,b=0,e=1;if(0==a)return 0;if(1==(a/=1))return 1;b||(b=0.3);e<Math.abs(1)?(e=1,c=b/4):c=b/(2*Math.PI)*Math.asin(1/e);return e*Math.pow(2,-10*a)*Math.sin((1*a-c)*2*Math.PI/b)+1},easeInOutElastic:function(a){var c=1.70158,b=0,e=1;if(0==a)return 0;if(2==(a/=0.5))return 1;b||(b=1*0.3*1.5);e<Math.abs(1)?(e=1,c=b/4):c=b/(2*Math.PI)*Math.asin(1/e);return 1>a?-0.5*e*Math.pow(2,10*
(a-=1))*Math.sin((1*a-c)*2*Math.PI/b):0.5*e*Math.pow(2,-10*(a-=1))*Math.sin((1*a-c)*2*Math.PI/b)+1},easeInBack:function(a){return 1*(a/=1)*a*(2.70158*a-1.70158)},easeOutBack:function(a){return 1*((a=a/1-1)*a*(2.70158*a+1.70158)+1)},easeInOutBack:function(a){var c=1.70158;return 1>(a/=0.5)?0.5*a*a*(((c*=1.525)+1)*a-c):0.5*((a-=2)*a*(((c*=1.525)+1)*a+c)+2)},easeInBounce:function(a){return 1-B.easeOutBounce(1-a)},easeOutBounce:function(a){return(a/=1)<1/2.75?1*7.5625*a*a:a<2/2.75?1*(7.5625*(a-=1.5/2.75)*
a+0.75):a<2.5/2.75?1*(7.5625*(a-=2.25/2.75)*a+0.9375):1*(7.5625*(a-=2.625/2.75)*a+0.984375)},easeInOutBounce:function(a){return 0.5>a?0.5*B.easeInBounce(2*a):0.5*B.easeOutBounce(2*a-1)+0.5}},q=s.canvas.width,u=s.canvas.height;window.devicePixelRatio&&(s.canvas.style.width=q+"px",s.canvas.style.height=u+"px",s.canvas.height=u*window.devicePixelRatio,s.canvas.width=q*window.devicePixelRatio,s.scale(window.devicePixelRatio,window.devicePixelRatio));this.PolarArea=function(a,c){r.PolarArea.defaults={scaleOverlay:!0,
scaleOverride:!1,scaleSteps:null,scaleStepWidth:null,scaleStartValue:null,scaleShowLine:!0,scaleLineColor:"rgba(0,0,0,.1)",scaleLineWidth:1,scaleShowLabels:!0,scaleLabel:"<%=value%>",scaleFontFamily:"'Arial'",scaleFontSize:12,scaleFontStyle:"normal",scaleFontColor:"#666",scaleShowLabelBackdrop:!0,scaleBackdropColor:"rgba(255,255,255,0.75)",scaleBackdropPaddingY:2,scaleBackdropPaddingX:2,segmentShowStroke:!0,segmentStrokeColor:"#fff",segmentStrokeWidth:2,animation:!0,animationSteps:100,animationEasing:"easeOutBounce",
animateRotate:!0,animateScale:!1,onAnimationComplete:null};var b=c?y(r.PolarArea.defaults,c):r.PolarArea.defaults;return new G(a,b,s)};this.Radar=function(a,c){r.Radar.defaults={scaleOverlay:!1,scaleOverride:!1,scaleSteps:null,scaleStepWidth:null,scaleStartValue:null,scaleShowLine:!0,scaleLineColor:"rgba(0,0,0,.1)",scaleLineWidth:1,scaleShowLabels:!1,scaleLabel:"<%=value%>",scaleFontFamily:"'Arial'",scaleFontSize:12,scaleFontStyle:"normal",scaleFontColor:"#666",scaleShowLabelBackdrop:!0,scaleBackdropColor:"rgba(255,255,255,0.75)",
scaleBackdropPaddingY:2,scaleBackdropPaddingX:2,angleShowLineOut:!0,angleLineColor:"rgba(0,0,0,.1)",angleLineWidth:1,pointLabelFontFamily:"'Arial'",pointLabelFontStyle:"normal",pointLabelFontSize:12,pointLabelFontColor:"#666",pointDot:!0,pointDotRadius:3,pointDotStrokeWidth:1,datasetStroke:!0,datasetStrokeWidth:2,datasetFill:!0,animation:!0,animationSteps:60,animationEasing:"easeOutQuart",onAnimationComplete:null};var b=c?y(r.Radar.defaults,c):r.Radar.defaults;return new H(a,b,s)};this.Pie=function(a,
c){r.Pie.defaults={segmentShowStroke:!0,segmentStrokeColor:"#fff",segmentStrokeWidth:2,animation:!0,animationSteps:100,animationEasing:"easeOutBounce",animateRotate:!0,animateScale:!1,onAnimationComplete:null};var b=c?y(r.Pie.defaults,c):r.Pie.defaults;return new I(a,b,s)};this.Doughnut=function(a,c){r.Doughnut.defaults={segmentShowStroke:!0,segmentStrokeColor:"#fff",segmentStrokeWidth:2,percentageInnerCutout:50,animation:!0,animationSteps:100,animationEasing:"easeOutBounce",animateRotate:!0,animateScale:!1,
onAnimationComplete:null};var b=c?y(r.Doughnut.defaults,c):r.Doughnut.defaults;return new J(a,b,s)};this.Line=function(a,c){r.Line.defaults={scaleOverlay:!1,scaleOverride:!1,scaleSteps:null,scaleStepWidth:null,scaleStartValue:null,scaleLineColor:"rgba(0,0,0,.1)",scaleLineWidth:1,scaleShowLabels:!0,scaleLabel:"<%=value%>",scaleFontFamily:"'Arial'",scaleFontSize:12,scaleFontStyle:"normal",scaleFontColor:"#666",scaleShowGridLines:!0,scaleGridLineColor:"rgba(0,0,0,.05)",scaleGridLineWidth:1,bezierCurve:!0,
pointDot:!0,pointDotRadius:4,pointDotStrokeWidth:2,datasetStroke:!0,datasetStrokeWidth:2,datasetFill:!0,animation:!0,animationSteps:60,animationEasing:"easeOutQuart",onAnimationComplete:null};var b=c?y(r.Line.defaults,c):r.Line.defaults;return new K(a,b,s)};this.Bar=function(a,c){r.Bar.defaults={scaleOverlay:!1,scaleOverride:!1,scaleSteps:null,scaleStepWidth:null,scaleStartValue:null,scaleLineColor:"rgba(0,0,0,.1)",scaleLineWidth:1,scaleShowLabels:!0,scaleLabel:"<%=value%>",scaleFontFamily:"'Arial'",
scaleFontSize:12,scaleFontStyle:"normal",scaleFontColor:"#666",scaleShowGridLines:!0,scaleGridLineColor:"rgba(0,0,0,.05)",scaleGridLineWidth:1,barShowStroke:!0,barStrokeWidth:2,barValueSpacing:5,barDatasetSpacing:1,animation:!0,animationSteps:60,animationEasing:"easeOutQuart",onAnimationComplete:null};var b=c?y(r.Bar.defaults,c):r.Bar.defaults;return new L(a,b,s)};var G=function(a,c,b){var e,h,f,d,g,k,j,l,m;g=Math.min.apply(Math,[q,u])/2;g-=Math.max.apply(Math,[0.5*c.scaleFontSize,0.5*c.scaleLineWidth]);
d=2*c.scaleFontSize;c.scaleShowLabelBackdrop&&(d+=2*c.scaleBackdropPaddingY,g-=1.5*c.scaleBackdropPaddingY);l=g;d=d?d:5;e=Number.MIN_VALUE;h=Number.MAX_VALUE;for(f=0;f<a.length;f++)a[f].value>e&&(e=a[f].value),a[f].value<h&&(h=a[f].value);f=Math.floor(l/(0.66*d));d=Math.floor(0.5*(l/d));m=c.scaleShowLabels?c.scaleLabel:null;c.scaleOverride?(j={steps:c.scaleSteps,stepValue:c.scaleStepWidth,graphMin:c.scaleStartValue,labels:[]},z(m,j.labels,j.steps,c.scaleStartValue,c.scaleStepWidth)):j=C(l,f,d,e,h,
m);k=g/j.steps;x(c,function(){for(var a=0;a<j.steps;a++)if(c.scaleShowLine&&(b.beginPath(),b.arc(q/2,u/2,k*(a+1),0,2*Math.PI,!0),b.strokeStyle=c.scaleLineColor,b.lineWidth=c.scaleLineWidth,b.stroke()),c.scaleShowLabels){b.textAlign="center";b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily;var e=j.labels[a];if(c.scaleShowLabelBackdrop){var d=b.measureText(e).width;b.fillStyle=c.scaleBackdropColor;b.beginPath();b.rect(Math.round(q/2-d/2-c.scaleBackdropPaddingX),Math.round(u/2-k*(a+
1)-0.5*c.scaleFontSize-c.scaleBackdropPaddingY),Math.round(d+2*c.scaleBackdropPaddingX),Math.round(c.scaleFontSize+2*c.scaleBackdropPaddingY));b.fill()}b.textBaseline="middle";b.fillStyle=c.scaleFontColor;b.fillText(e,q/2,u/2-k*(a+1))}},function(e){var d=-Math.PI/2,g=2*Math.PI/a.length,f=1,h=1;c.animation&&(c.animateScale&&(f=e),c.animateRotate&&(h=e));for(e=0;e<a.length;e++)b.beginPath(),b.arc(q/2,u/2,f*v(a[e].value,j,k),d,d+h*g,!1),b.lineTo(q/2,u/2),b.closePath(),b.fillStyle=a[e].color,b.fill(),
c.segmentShowStroke&&(b.strokeStyle=c.segmentStrokeColor,b.lineWidth=c.segmentStrokeWidth,b.stroke()),d+=h*g},b)},H=function(a,c,b){var e,h,f,d,g,k,j,l,m;a.labels||(a.labels=[]);g=Math.min.apply(Math,[q,u])/2;d=2*c.scaleFontSize;for(e=l=0;e<a.labels.length;e++)b.font=c.pointLabelFontStyle+" "+c.pointLabelFontSize+"px "+c.pointLabelFontFamily,h=b.measureText(a.labels[e]).width,h>l&&(l=h);g-=Math.max.apply(Math,[l,1.5*(c.pointLabelFontSize/2)]);g-=c.pointLabelFontSize;l=g=A(g,null,0);d=d?d:5;e=Number.MIN_VALUE;
h=Number.MAX_VALUE;for(f=0;f<a.datasets.length;f++)for(m=0;m<a.datasets[f].data.length;m++)a.datasets[f].data[m]>e&&(e=a.datasets[f].data[m]),a.datasets[f].data[m]<h&&(h=a.datasets[f].data[m]);f=Math.floor(l/(0.66*d));d=Math.floor(0.5*(l/d));m=c.scaleShowLabels?c.scaleLabel:null;c.scaleOverride?(j={steps:c.scaleSteps,stepValue:c.scaleStepWidth,graphMin:c.scaleStartValue,labels:[]},z(m,j.labels,j.steps,c.scaleStartValue,c.scaleStepWidth)):j=C(l,f,d,e,h,m);k=g/j.steps;x(c,function(){var e=2*Math.PI/
a.datasets[0].data.length;b.save();b.translate(q/2,u/2);if(c.angleShowLineOut){b.strokeStyle=c.angleLineColor;b.lineWidth=c.angleLineWidth;for(var d=0;d<a.datasets[0].data.length;d++)b.rotate(e),b.beginPath(),b.moveTo(0,0),b.lineTo(0,-g),b.stroke()}for(d=0;d<j.steps;d++){b.beginPath();if(c.scaleShowLine){b.strokeStyle=c.scaleLineColor;b.lineWidth=c.scaleLineWidth;b.moveTo(0,-k*(d+1));for(var f=0;f<a.datasets[0].data.length;f++)b.rotate(e),b.lineTo(0,-k*(d+1));b.closePath();b.stroke()}c.scaleShowLabels&&
(b.textAlign="center",b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily,b.textBaseline="middle",c.scaleShowLabelBackdrop&&(f=b.measureText(j.labels[d]).width,b.fillStyle=c.scaleBackdropColor,b.beginPath(),b.rect(Math.round(-f/2-c.scaleBackdropPaddingX),Math.round(-k*(d+1)-0.5*c.scaleFontSize-c.scaleBackdropPaddingY),Math.round(f+2*c.scaleBackdropPaddingX),Math.round(c.scaleFontSize+2*c.scaleBackdropPaddingY)),b.fill()),b.fillStyle=c.scaleFontColor,b.fillText(j.labels[d],0,-k*(d+
1)))}for(d=0;d<a.labels.length;d++){b.font=c.pointLabelFontStyle+" "+c.pointLabelFontSize+"px "+c.pointLabelFontFamily;b.fillStyle=c.pointLabelFontColor;var f=Math.sin(e*d)*(g+c.pointLabelFontSize),h=Math.cos(e*d)*(g+c.pointLabelFontSize);b.textAlign=e*d==Math.PI||0==e*d?"center":e*d>Math.PI?"right":"left";b.textBaseline="middle";b.fillText(a.labels[d],f,-h)}b.restore()},function(d){var e=2*Math.PI/a.datasets[0].data.length;b.save();b.translate(q/2,u/2);for(var g=0;g<a.datasets.length;g++){b.beginPath();
b.moveTo(0,d*-1*v(a.datasets[g].data[0],j,k));for(var f=1;f<a.datasets[g].data.length;f++)b.rotate(e),b.lineTo(0,d*-1*v(a.datasets[g].data[f],j,k));b.closePath();b.fillStyle=a.datasets[g].fillColor;b.strokeStyle=a.datasets[g].strokeColor;b.lineWidth=c.datasetStrokeWidth;b.fill();b.stroke();if(c.pointDot){b.fillStyle=a.datasets[g].pointColor;b.strokeStyle=a.datasets[g].pointStrokeColor;b.lineWidth=c.pointDotStrokeWidth;for(f=0;f<a.datasets[g].data.length;f++)b.rotate(e),b.beginPath(),b.arc(0,d*-1*
v(a.datasets[g].data[f],j,k),c.pointDotRadius,2*Math.PI,!1),b.fill(),b.stroke()}b.rotate(e)}b.restore()},b)},I=function(a,c,b){for(var e=0,h=Math.min.apply(Math,[u/2,q/2])-5,f=0;f<a.length;f++)e+=a[f].value;x(c,null,function(d){var g=-Math.PI/2,f=1,j=1;c.animation&&(c.animateScale&&(f=d),c.animateRotate&&(j=d));for(d=0;d<a.length;d++){var l=j*a[d].value/e*2*Math.PI;b.beginPath();b.arc(q/2,u/2,f*h,g,g+l);b.lineTo(q/2,u/2);b.closePath();b.fillStyle=a[d].color;b.fill();c.segmentShowStroke&&(b.lineWidth=
c.segmentStrokeWidth,b.strokeStyle=c.segmentStrokeColor,b.stroke());g+=l}},b)},J=function(a,c,b){for(var e=0,h=Math.min.apply(Math,[u/2,q/2])-5,f=h*(c.percentageInnerCutout/100),d=0;d<a.length;d++)e+=a[d].value;x(c,null,function(d){var k=-Math.PI/2,j=1,l=1;c.animation&&(c.animateScale&&(j=d),c.animateRotate&&(l=d));for(d=0;d<a.length;d++){var m=l*a[d].value/e*2*Math.PI;b.beginPath();b.arc(q/2,u/2,j*h,k,k+m,!1);b.arc(q/2,u/2,j*f,k+m,k,!0);b.closePath();b.fillStyle=a[d].color;b.fill();c.segmentShowStroke&&
(b.lineWidth=c.segmentStrokeWidth,b.strokeStyle=c.segmentStrokeColor,b.stroke());k+=m}},b)},K=function(a,c,b){var e,h,f,d,g,k,j,l,m,t,r,n,p,s=0;g=u;b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily;t=1;for(d=0;d<a.labels.length;d++)e=b.measureText(a.labels[d]).width,t=e>t?e:t;q/a.labels.length<t?(s=45,q/a.labels.length<Math.cos(s)*t?(s=90,g-=t):g-=Math.sin(s)*t):g-=c.scaleFontSize;d=c.scaleFontSize;g=g-5-d;e=Number.MIN_VALUE;h=Number.MAX_VALUE;for(f=0;f<a.datasets.length;f++)for(l=
0;l<a.datasets[f].data.length;l++)a.datasets[f].data[l]>e&&(e=a.datasets[f].data[l]),a.datasets[f].data[l]<h&&(h=a.datasets[f].data[l]);f=Math.floor(g/(0.66*d));d=Math.floor(0.5*(g/d));l=c.scaleShowLabels?c.scaleLabel:"";c.scaleOverride?(j={steps:c.scaleSteps,stepValue:c.scaleStepWidth,graphMin:c.scaleStartValue,labels:[]},z(l,j.labels,j.steps,c.scaleStartValue,c.scaleStepWidth)):j=C(g,f,d,e,h,l);k=Math.floor(g/j.steps);d=1;if(c.scaleShowLabels){b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily;
for(e=0;e<j.labels.length;e++)h=b.measureText(j.labels[e]).width,d=h>d?h:d;d+=10}r=q-d-t;m=Math.floor(r/(a.labels.length-1));n=q-t/2-r;p=g+c.scaleFontSize/2;x(c,function(){b.lineWidth=c.scaleLineWidth;b.strokeStyle=c.scaleLineColor;b.beginPath();b.moveTo(q-t/2+5,p);b.lineTo(q-t/2-r-5,p);b.stroke();0<s?(b.save(),b.textAlign="right"):b.textAlign="center";b.fillStyle=c.scaleFontColor;for(var d=0;d<a.labels.length;d++)b.save(),0<s?(b.translate(n+d*m,p+c.scaleFontSize),b.rotate(-(s*(Math.PI/180))),b.fillText(a.labels[d],
0,0),b.restore()):b.fillText(a.labels[d],n+d*m,p+c.scaleFontSize+3),b.beginPath(),b.moveTo(n+d*m,p+3),c.scaleShowGridLines&&0<d?(b.lineWidth=c.scaleGridLineWidth,b.strokeStyle=c.scaleGridLineColor,b.lineTo(n+d*m,5)):b.lineTo(n+d*m,p+3),b.stroke();b.lineWidth=c.scaleLineWidth;b.strokeStyle=c.scaleLineColor;b.beginPath();b.moveTo(n,p+5);b.lineTo(n,5);b.stroke();b.textAlign="right";b.textBaseline="middle";for(d=0;d<j.steps;d++)b.beginPath(),b.moveTo(n-3,p-(d+1)*k),c.scaleShowGridLines?(b.lineWidth=c.scaleGridLineWidth,
b.strokeStyle=c.scaleGridLineColor,b.lineTo(n+r+5,p-(d+1)*k)):b.lineTo(n-0.5,p-(d+1)*k),b.stroke(),c.scaleShowLabels&&b.fillText(j.labels[d],n-8,p-(d+1)*k)},function(d){function e(b,c){return p-d*v(a.datasets[b].data[c],j,k)}for(var f=0;f<a.datasets.length;f++){b.strokeStyle=a.datasets[f].strokeColor;b.lineWidth=c.datasetStrokeWidth;b.beginPath();b.moveTo(n,p-d*v(a.datasets[f].data[0],j,k));for(var g=1;g<a.datasets[f].data.length;g++)c.bezierCurve?b.bezierCurveTo(n+m*(g-0.5),e(f,g-1),n+m*(g-0.5),
e(f,g),n+m*g,e(f,g)):b.lineTo(n+m*g,e(f,g));b.stroke();c.datasetFill?(b.lineTo(n+m*(a.datasets[f].data.length-1),p),b.lineTo(n,p),b.closePath(),b.fillStyle=a.datasets[f].fillColor,b.fill()):b.closePath();if(c.pointDot){b.fillStyle=a.datasets[f].pointColor;b.strokeStyle=a.datasets[f].pointStrokeColor;b.lineWidth=c.pointDotStrokeWidth;for(g=0;g<a.datasets[f].data.length;g++)b.beginPath(),b.arc(n+m*g,p-d*v(a.datasets[f].data[g],j,k),c.pointDotRadius,0,2*Math.PI,!0),b.fill(),b.stroke()}}},b)},L=function(a,
c,b){var e,h,f,d,g,k,j,l,m,t,r,n,p,s,w=0;g=u;b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily;t=1;for(d=0;d<a.labels.length;d++)e=b.measureText(a.labels[d]).width,t=e>t?e:t;q/a.labels.length<t?(w=45,q/a.labels.length<Math.cos(w)*t?(w=90,g-=t):g-=Math.sin(w)*t):g-=c.scaleFontSize;d=c.scaleFontSize;g=g-5-d;e=Number.MIN_VALUE;h=Number.MAX_VALUE;for(f=0;f<a.datasets.length;f++)for(l=0;l<a.datasets[f].data.length;l++)a.datasets[f].data[l]>e&&(e=a.datasets[f].data[l]),a.datasets[f].data[l]<
h&&(h=a.datasets[f].data[l]);f=Math.floor(g/(0.66*d));d=Math.floor(0.5*(g/d));l=c.scaleShowLabels?c.scaleLabel:"";c.scaleOverride?(j={steps:c.scaleSteps,stepValue:c.scaleStepWidth,graphMin:c.scaleStartValue,labels:[]},z(l,j.labels,j.steps,c.scaleStartValue,c.scaleStepWidth)):j=C(g,f,d,e,h,l);k=Math.floor(g/j.steps);d=1;if(c.scaleShowLabels){b.font=c.scaleFontStyle+" "+c.scaleFontSize+"px "+c.scaleFontFamily;for(e=0;e<j.labels.length;e++)h=b.measureText(j.labels[e]).width,d=h>d?h:d;d+=10}r=q-d-t;m=
Math.floor(r/a.labels.length);s=(m-2*c.scaleGridLineWidth-2*c.barValueSpacing-(c.barDatasetSpacing*a.datasets.length-1)-(c.barStrokeWidth/2*a.datasets.length-1))/a.datasets.length;n=q-t/2-r;p=g+c.scaleFontSize/2;x(c,function(){b.lineWidth=c.scaleLineWidth;b.strokeStyle=c.scaleLineColor;b.beginPath();b.moveTo(q-t/2+5,p);b.lineTo(q-t/2-r-5,p);b.stroke();0<w?(b.save(),b.textAlign="right"):b.textAlign="center";b.fillStyle=c.scaleFontColor;for(var d=0;d<a.labels.length;d++)b.save(),0<w?(b.translate(n+
d*m,p+c.scaleFontSize),b.rotate(-(w*(Math.PI/180))),b.fillText(a.labels[d],0,0),b.restore()):b.fillText(a.labels[d],n+d*m+m/2,p+c.scaleFontSize+3),b.beginPath(),b.moveTo(n+(d+1)*m,p+3),b.lineWidth=c.scaleGridLineWidth,b.strokeStyle=c.scaleGridLineColor,b.lineTo(n+(d+1)*m,5),b.stroke();b.lineWidth=c.scaleLineWidth;b.strokeStyle=c.scaleLineColor;b.beginPath();b.moveTo(n,p+5);b.lineTo(n,5);b.stroke();b.textAlign="right";b.textBaseline="middle";for(d=0;d<j.steps;d++)b.beginPath(),b.moveTo(n-3,p-(d+1)*
k),c.scaleShowGridLines?(b.lineWidth=c.scaleGridLineWidth,b.strokeStyle=c.scaleGridLineColor,b.lineTo(n+r+5,p-(d+1)*k)):b.lineTo(n-0.5,p-(d+1)*k),b.stroke(),c.scaleShowLabels&&b.fillText(j.labels[d],n-8,p-(d+1)*k)},function(d){b.lineWidth=c.barStrokeWidth;for(var e=0;e<a.datasets.length;e++){b.fillStyle=a.datasets[e].fillColor;b.strokeStyle=a.datasets[e].strokeColor;for(var f=0;f<a.datasets[e].data.length;f++){var g=n+c.barValueSpacing+m*f+s*e+c.barDatasetSpacing*e+c.barStrokeWidth*e;b.beginPath();
b.moveTo(g,p);b.lineTo(g,p-d*v(a.datasets[e].data[f],j,k)+c.barStrokeWidth/2);b.lineTo(g+s,p-d*v(a.datasets[e].data[f],j,k)+c.barStrokeWidth/2);b.lineTo(g+s,p);c.barShowStroke&&b.stroke();b.closePath();b.fill()}}},b)},D=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.oRequestAnimationFrame||window.msRequestAnimationFrame||function(a){window.setTimeout(a,1E3/60)},F={}};



/**
 * Timeago is a jQuery plugin that makes it easy to support automatically
 * updating fuzzy timestamps (e.g. "4 minutes ago" or "about 1 day ago").
 *
 * @name timeago
 * @version 1.4.0
 * @requires jQuery v1.2.3+
 * @author Ryan McGeary
 * @license MIT License - http://www.opensource.org/licenses/mit-license.php
 *
 * For usage and examples, visit:
 * http://timeago.yarp.com/
 *
 * Copyright (c) 2008-2013, Ryan McGeary (ryan -[at]- mcgeary [*dot*] org)
 */
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{a(jQuery)}}(function(d){d.timeago=function(h){if(h instanceof Date){return a(h)}else{if(typeof h==="string"){return a(d.timeago.parse(h))}else{if(typeof h==="number"){return a(new Date(h))}else{return a(d.timeago.datetime(h))}}}};var g=d.timeago;d.extend(d.timeago,{settings:{refreshMillis:60000,allowPast:true,allowFuture:false,localeTitle:false,cutoff:0,strings:{prefixAgo:null,prefixFromNow:null,suffixAgo:"ago",suffixFromNow:"from now",inPast:"any moment now",seconds:"less than a minute",minute:"about a minute",minutes:"%d minutes",hour:"about an hour",hours:"about %d hours",day:"a day",days:"%d days",month:"about a month",months:"%d months",year:"about a year",years:"%d years",wordSeparator:" ",numbers:[]}},inWords:function(n){if(!this.settings.allowPast&&!this.settings.allowFuture){throw"timeago allowPast and allowFuture settings can not both be set to false."}var o=this.settings.strings;var k=o.prefixAgo;var s=o.suffixAgo;if(this.settings.allowFuture){if(n<0){k=o.prefixFromNow;s=o.suffixFromNow}}if(!this.settings.allowPast&&n>=0){return this.settings.strings.inPast}var q=Math.abs(n)/1000;var h=q/60;var p=h/60;var r=p/24;var l=r/365;function j(t,v){var u=d.isFunction(t)?t(v,n):t;var w=(o.numbers&&o.numbers[v])||v;return u.replace(/%d/i,w)}var m=q<45&&j(o.seconds,Math.round(q))||q<90&&j(o.minute,1)||h<45&&j(o.minutes,Math.round(h))||h<90&&j(o.hour,1)||p<24&&j(o.hours,Math.round(p))||p<42&&j(o.day,1)||r<30&&j(o.days,Math.round(r))||r<45&&j(o.month,1)||r<365&&j(o.months,Math.round(r/30))||l<1.5&&j(o.year,1)||j(o.years,Math.round(l));var i=o.wordSeparator||"";if(o.wordSeparator===undefined){i=" "}return d.trim([k,m,s].join(i))},parse:function(i){var h=d.trim(i);h=h.replace(/\.\d+/,"");h=h.replace(/-/,"/").replace(/-/,"/");h=h.replace(/T/," ").replace(/Z/," UTC");h=h.replace(/([\+\-]\d\d)\:?(\d\d)/," $1$2");h=h.replace(/([\+\-]\d\d)$/," $100");return new Date(h)},datetime:function(i){var h=g.isTime(i)?d(i).attr("datetime"):d(i).attr("title");return g.parse(h)},isTime:function(h){return d(h).get(0).tagName.toLowerCase()==="time"}});var e={init:function(){var i=d.proxy(c,this);i();var h=g.settings;if(h.refreshMillis>0){this._timeagoInterval=setInterval(i,h.refreshMillis)}},update:function(h){var i=g.parse(h);d(this).data("timeago",{datetime:i});if(g.settings.localeTitle){d(this).attr("title",i.toLocaleString())}c.apply(this)},updateFromDOM:function(){d(this).data("timeago",{datetime:g.parse(g.isTime(this)?d(this).attr("datetime"):d(this).attr("title"))});c.apply(this)},dispose:function(){if(this._timeagoInterval){window.clearInterval(this._timeagoInterval);this._timeagoInterval=null}}};d.fn.timeago=function(j,h){var i=j?e[j]:e.init;if(!i){throw new Error("Unknown function name '"+j+"' for timeago")}this.each(function(){i.call(this,h)});return this};function c(){var i=b(this);var h=g.settings;if(!isNaN(i.datetime)){if(h.cutoff==0||f(i.datetime)<h.cutoff){d(this).text(a(i.datetime))}}return this}function b(h){h=d(h);if(!h.data("timeago")){h.data("timeago",{datetime:g.datetime(h)});var i=d.trim(h.text());if(g.settings.localeTitle){h.attr("title",h.data("timeago").datetime.toLocaleString())}else{if(i.length>0&&!(g.isTime(h)&&h.attr("title"))){h.attr("title",i)}}}return h.data("timeago")}function a(h){return g.inWords(f(h))}function f(h){return(new Date().getTime()-h.getTime())}document.createElement("abbr");document.createElement("time")}));



/*!
 * jQuery Cookie Plugin v1.4.1
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function(a){if(typeof define==="function"&&define.amd){define(["jquery"],a)}else{if(typeof exports==="object"){a(require("jquery"))}else{a(jQuery)}}}(function(f){var a=/\+/g;function d(i){return b.raw?i:encodeURIComponent(i)}function g(i){return b.raw?i:decodeURIComponent(i)}function h(i){return d(b.json?JSON.stringify(i):String(i))}function c(i){if(i.indexOf('"')===0){i=i.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\")}try{i=decodeURIComponent(i.replace(a," "));return b.json?JSON.parse(i):i}catch(j){}}function e(j,i){var k=b.raw?j:c(j);return f.isFunction(i)?i(k):k}var b=f.cookie=function(q,p,v){if(p!==undefined&&!f.isFunction(p)){v=f.extend({},b.defaults,v);if(typeof v.expires==="number"){var r=v.expires,u=v.expires=new Date();u.setTime(+u+r*86400000)}return(document.cookie=[d(q),"=",h(p),v.expires?"; expires="+v.expires.toUTCString():"",v.path?"; path="+v.path:"",v.domain?"; domain="+v.domain:"",v.secure?"; secure":""].join(""))}var w=q?undefined:{};var s=document.cookie?document.cookie.split("; "):[];for(var o=0,m=s.length;o<m;o++){var n=s[o].split("=");var j=g(n.shift());var k=n.join("=");if(q&&q===j){w=e(k,p);break}if(!q&&(k=e(k))!==undefined){w[j]=k}}return w};b.defaults={};f.removeCookie=function(j,i){if(f.cookie(j)===undefined){return false}f.cookie(j,"",f.extend({},i,{expires:-1}));return !f.cookie(j)}}));





































/*jslint browser:true, nomen:true */
/*global google:false */


/** @license  Geolocator Javascript Lib v.1.2
 *  (c) 2012-2014 Onur Yildirim (onur@cutepilot.com)
 *  https://github.com/onury/geolocator
 *  MIT License
 */
var geolocator = (function () {

    'use strict';

    // ---------------------------------------
    // PRIVATE PROPERTIES & FIELDS
    // ---------------------------------------

    var
        /* Storage for the callback function to be executed when the location is successfully fetched. */
        onSuccess,
        /* Storage for the callback function to be executed when the location could not be fetched due to an error. */
        onError,
        /* HTML element ID for the Google Maps. */
        mCanvasId,
        /* Google Maps URL. */
        googleLoaderURL = 'https://www.google.com/jsapi',
        /* Array of source services that provide location-by-IP information. */
        ipGeoSources = [
            {url: 'http://freegeoip.net/json/', cbParam: 'callback'}, // 0
            {url: 'http://www.geoplugin.net/json.gp', cbParam: 'jsoncallback'}, // 1
            {url: 'http://geoiplookup.wikimedia.org/', cbParam: ''} // 2
            //,{url: 'http://j.maxmind.com/app/geoip.js', cbParam: ''} // Not implemented. Requires attribution. See http://dev.maxmind.com/geoip/javascript
        ],
        /* The index of the current IP source service. */
        ipGeoSourceIndex = 0; // default (freegeoip)

    // ---------------------------------------
    // PRIVATE METHODS
    // ---------------------------------------

    /** Non-blocking method for loading scripts dynamically.
     */
    function loadScript(url, callback, type) {
        var script = document.createElement('script');
        script.type = (type === undefined) ? 'text/javascript' : type;

        if (typeof callback === 'function') {
            if (script.readyState) {
                script.onreadystatechange = function () {
                    if (script.readyState === 'loaded' || script.readyState === 'complete') {
                        script.onreadystatechange = null;
                        callback();
                    }
                };
            } else {
                script.onload = function () { callback(); };
            }
        }

        script.src = url;
        //document.body.appendChild(script);
        document.getElementsByTagName('head')[0].appendChild(script);
    }

    /** Loads Google Maps API and executes the callback function when done.
     */
    function loadGoogleMaps(callback) {
        function loadMaps() {
            if (geolocator.__glcb) { delete geolocator.__glcb; }
            google.load('maps', '3.15', {other_params: 'sensor=false', callback: callback});
        }
        if (window.google !== undefined && google.maps !== undefined) {
            if (callback) { callback(); }
        } else {
            if (window.google !== undefined && google.loader !== undefined) {
                loadMaps();
            } else {
                geolocator.__glcb = loadMaps;
                loadScript(googleLoaderURL + '?callback=geolocator.__glcb');
            }
        }
    }

    /** Draws the map from the fetched geo information.
     */
    function drawMap(elemId, mapOptions, infoContent) {
        var map, marker, infowindow,
            elem = document.getElementById(elemId);
        if (elem) {
            map = new google.maps.Map(elem, mapOptions);
            marker = new google.maps.Marker({
                position: mapOptions.center,
                map: map
            });
            infowindow = new google.maps.InfoWindow();
            infowindow.setContent(infoContent);
            //infowindow.open(map, marker);
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });
            geolocator.location.map = {
                canvas: elem,
                map: map,
                options: mapOptions,
                marker: marker,
                infoWindow: infowindow
            };
        } else {
            geolocator.location.map = null;
        }
    }

    /** Runs a reverse-geo lookup for the specified lat-lon coords.
     */
    function reverseGeoLookup(latlng, callback) {
        var geocoder = new google.maps.Geocoder();
        function onReverseGeo(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (callback) { callback(results); }
            }
        }
        geocoder.geocode({'latLng': latlng}, onReverseGeo);
    }

    /** Fetches additional details (from the reverse-geo result) for the address property of the location object.
     */
    function fetchDetailsFromLookup(data) {
        if (data && data.length > 0) {
            var i, c, o = {},
                comps = data[0].address_components;
            for (i = 0; i < comps.length; i += 1) {
                c = comps[i];
                if (c.types && c.types.length > 0) {
                    o[c.types[0]] = c.long_name;
                    o[c.types[0] + '_s'] = c.short_name;
                }
            }
            geolocator.location.formattedAddress = data[0].formatted_address;
            geolocator.location.address = {
                street: o.route || '',
                neighborhood: o.neighborhood || '',
                town: o.sublocality || '',
                city: o.locality || '',
                region: o.administrative_area_level_1 || '',
                country: o.country || '',
                countryCode: o.country_s || '',
                postalCode: o.postal_code || '',
                streetNumber: o.street_number || ''
            };
        }
    }

    /** Finalizes the location object via reverse-geocoding and draws the map (if required).
     */
    function finalize(coords) {
        var latlng = new google.maps.LatLng(coords.latitude, coords.longitude);
        function onGeoLookup(data) {
            fetchDetailsFromLookup(data);
            var zoom = geolocator.location.ipGeoSource === null ? 14 : 7, //zoom out if we got the lcoation from IP.
                mapOptions = {
                    zoom: zoom,
                    center: latlng,
                    mapTypeId: 'roadmap'
                };
            // drawMap(mCanvasId, mapOptions, data[0].formatted_address);
            if (onSuccess) { onSuccess.call(null, geolocator.location); }
        }
        reverseGeoLookup(latlng, onGeoLookup);
    }

    /** Gets the geo-position via HTML5 geolocation (if supported).
     */
    function getPosition(fallbackToIP, html5Options) {
        geolocator.location = null;

        function fallback(errMsg) {
            var ipsIndex = fallbackToIP === true ? 0 : (typeof fallbackToIP === 'number' ? fallbackToIP : -1);
            if (ipsIndex >= 0) {
                geolocator.locateByIP(onSuccess, onError, ipsIndex, mCanvasId);
            } else {
                if (onError) { onError.call(null, errMsg); }
            }
        }

        function geoSuccess(position) {
            geolocator.location = {
                ipGeoSource: null,
                coords: position.coords,
                timestamp: (new Date()).getTime() //overwrite timestamp (Safari-Mac and iOS devices use different epoch; so better use this).
            };
            finalize(geolocator.location.coords);
        }

        function geoError(error) {
            fallback(error.message);
        }

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(geoSuccess, geoError, html5Options);
        } else { // not supported
            fallback('geolocation is not supported.');
        }
    }

    /** Builds the location object from the source data.
     */
    function buildLocation(sourceIndex, data) {
        switch (sourceIndex) {
        case 0: // freegeoip
            geolocator.location = {
                coords: {
                    latitude: data.latitude,
                    longitude: data.longitude
                },
                address: {
                    city: data.city,
                    country: data.country_name,
                    countryCode: data.country_code,
                    region: data.region_name
                }
            };
            break;
        case 1: // geoplugin
            geolocator.location = {
                coords: {
                    latitude: data.geoplugin_latitude,
                    longitude: data.geoplugin_longitude
                },
                address: {
                    city: data.geoplugin_city,
                    country: data.geoplugin_countryName,
                    countryCode: data.geoplugin_countryCode,
                    region: data.geoplugin_regionName
                }
            };
            break;
        case 2: // Wikimedia
            geolocator.location = {
                coords: {
                    latitude: data.lat,
                    longitude: data.lon
                },
                address: {
                    city: data.city,
                    country: '',
                    countryCode: data.country,
                    region: ''
                }
            };
            break;
        }
        if (geolocator.location) {
            geolocator.location.coords.accuracy = null;
            geolocator.location.coords.altitude = null;
            geolocator.location.coords.altitudeAccuracy = null;
            geolocator.location.coords.heading = null;
            geolocator.location.coords.speed = null;
            geolocator.location.timestamp = new Date().getTime();
            geolocator.location.ipGeoSource = ipGeoSources[sourceIndex];
            geolocator.location.ipGeoSource.data = data;
        }
    }

    /** The callback that is executed when the location data is fetched from the source.
     */
    function onGeoSourceCallback(data) {
        var initialized = false;
        geolocator.location = null;
        delete geolocator.__ipscb;

        function gLoadCallback() {
            if (ipGeoSourceIndex === 2) { // Wikimedia
                if (window.Geo !== undefined) {
                    buildLocation(ipGeoSourceIndex, window.Geo);
                    delete window.Geo;
                    initialized = true;
                }
            } else {
                if (data !== undefined) {
                    buildLocation(ipGeoSourceIndex, data);
                    initialized = true;
                }
            }

            if (initialized === true) {
                finalize(geolocator.location.coords);
            } else {
                if (onError) { onError('Could not get location.'); }
            }
        }

        loadGoogleMaps(gLoadCallback);
    }

    /** Loads the (jsonp) source. If the source does not support json-callbacks;
     *  the callback is executed dynamically when the source is loaded completely.
     */
    function loadIpGeoSource(source) {
        if (source.cbParam === undefined || source.cbParam === null || source.cbParam === '') {
            loadScript(source.url, onGeoSourceCallback);
        } else {
            loadScript(source.url + '?' + source.cbParam + '=geolocator.__ipscb'); //ip source callback
        }
    }

    return {

        // ---------------------------------------
        // PUBLIC PROPERTIES
        // ---------------------------------------

        /** The recent location information fetched as an object.
         */
        location: null,

        // ---------------------------------------
        // PUBLIC METHODS
        // ---------------------------------------

        /** Gets the geo-location by requesting user's permission.
         */
        locate: function (successCallback, errorCallback, fallbackToIP, html5Options, mapCanvasId) {
            onSuccess = successCallback;
            onError = errorCallback;
            mCanvasId = mapCanvasId;
            function gLoadCallback() { getPosition(fallbackToIP, html5Options); }
            loadGoogleMaps(gLoadCallback);
        },

        /** Gets the geo-location from the user's IP.
         */
        locateByIP: function (successCallback, errorCallback, sourceIndex, mapCanvasId) {
            ipGeoSourceIndex = (sourceIndex === undefined ||
                (sourceIndex < 0 || sourceIndex >= ipGeoSources.length)) ? 0 : sourceIndex;
            onSuccess = successCallback;
            onError = errorCallback;
            mCanvasId = mapCanvasId;
            geolocator.__ipscb = onGeoSourceCallback;
            loadIpGeoSource(ipGeoSources[ipGeoSourceIndex]);
        }
    };
}());