(function(a){a.fn.aToolTip=function(b){var d={closeTipBtn:"aToolTipCloseBtn",toolTipId:"aToolTip",fixed:false,clickIt:false,inSpeed:200,outSpeed:100,tipContent:"",toolTipClass:"defaultTheme",xOffset:5,yOffset:5,onShow:null,onHide:null},c=a.extend({},d,b);return this.each(function(){var i=a(this);if(i.attr("title")){var h=i.attr("title")}else{var h=c.tipContent}var e=function(){a("body").append("<div id='"+c.toolTipId+"' class='"+c.toolTipClass+"'><p class='aToolTipContent'>"+h+"</p></div>");if(h&&c.clickIt){a("#"+c.toolTipId+" p.aToolTipContent").append("<a id='"+c.closeTipBtn+"' href='#' alt='close'>close</a>")}},f=function(){a("#"+c.toolTipId).css({top:(i.offset().top-a("#"+c.toolTipId).outerHeight()-c.yOffset)+"px",left:(i.offset().left+i.outerWidth()+c.xOffset)+"px"}).stop().fadeIn(c.inSpeed,function(){if(a.isFunction(c.onShow)){c.onShow(i)}})},g=function(){a("#"+c.toolTipId).stop().fadeOut(c.outSpeed,function(){a(this).remove();if(a.isFunction(c.onHide)){c.onHide(i)}})};if(h&&!c.clickIt){i.hover(function(){a("#"+c.toolTipId).remove();i.attr({title:""});e();f()},function(){g()})}if(h&&c.clickIt){i.click(function(j){a("#"+c.toolTipId).remove();i.attr({title:""});e();f();a("#"+c.closeTipBtn).click(function(){g();return false});return false})}if(!c.fixed&&!c.clickIt){i.mousemove(function(j){a("#"+c.toolTipId).css({top:(j.pageY-a("#"+c.toolTipId).outerHeight()-c.yOffset),left:(j.pageX+c.xOffset)})})}})}})(jQuery);


$(document).ready(function() {

	// TOOLTIP
	$("*[title]").aToolTip({
		xOffset: 5,
		yOffset: -50
	});

});