function getWindowHeight(){
	return window.innerHeight ? window.innerHeight : jQuery(window).height();
}
function getWindowWidth(){
	return window.innerWidth ? window.innerWidth : jQuery(window).width();
}
function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
var $zoomItemSelector=jQuery(".photos .photo a");
jQuery(document).ready(function(){
	jQueryAddressChangeEnabled=true;
	$zoomItemSelector=jQuery(".photos .photo a");
	$zoomItemSelector.click(function(e){
		jQueryAddressChangeEnabled=false;
		e.preventDefault();
		var lookId=$zoomItemSelector.index(this)+1;
		window.location.hash='look'+lookId;

		var attributes={
			index:lookId,
			image:jQuery(this).attr("href"),
			description:jQuery(this).parents("span").siblings(".imgCaption").children("span").html(),
			_this:jQuery(this)
		};
		jQuery(".imgCaption").css({"visibility":"hidden"});

		uz_zoom(attributes);
		jQueryAddressChangeEnabled=true;
	});

	jQuery.address.change(function(event){
		var baseLook="/look";
		if(jQueryAddressChangeEnabled && event.path.indexOf("/look")==0 && jQuery(".uz").length==0){
			var lookId=event.path.substring(baseLook.length,event.path.length)-1;
			if(isNumeric(lookId)){
				if(lookId>=0 && lookId<$zoomItemSelector.length){
					jQuery($zoomItemSelector.get(lookId)).click();
				}
			}
		}
	});
});
var slideLeftToRight=false;
function uz_zoom(attributes){
	var $container=jQuery("<div />"),
	    $containerBackground=jQuery("<div />");
	    $imageContainer=jQuery("<div />"),
	    $controlsContainer=jQuery("<div />"),
	    $closeControl=jQuery("<span>X</span>"),
	    img=new Image(),
	    $img=jQuery(img);

	var $scrollControlsContainer=jQuery("<div />"),
	    $scrollLeft=jQuery("<div />");
	    $scrollRight=jQuery("<div />");

	var $addThis=jQuery("<div />"),
	    $addThisTitle=jQuery("<div />"),
	    addThisIcon='<span class="icon"></span>';
	    $addThisSocial={Facebook:jQuery("<a />"),
			    Twitter:jQuery("<a />"),
			    Pinterest:jQuery('<a href="http://pinterest.com/pin/create/button/?url='+window.location.href+'&media=http://www.urbanzen.com'+attributes.image+'&description='+attributes.description+'" class="pin-it-button pinit" count-layout="horizontal">Pin It</a>'),
			    Tumblr:jQuery("<a />")},
	    addthisprefix="addthis_button_";

	var $pageTitle=jQuery("<div />"),
	    $itemText=jQuery("<div />"),
	    $itemDetails=jQuery("<div />");

	var $purchaseControlContainer=jQuery("<div />"),
	    $purchaseTitle=jQuery("<div />"),
	    $purchaseEmail=jQuery("<div />"),
	    $purchaseCall=jQuery("<div />");

	var $siteIcon=jQuery("<div />");

	var resizeSmoothZoomSize=function(){
		$imageContainer.height("100%");
		$imageContainer.css('width',getWindowWidth());//-$controlsContainer.outerWidth());

	};

	// Creating elements
	$container.html($containerBackground).append($imageContainer);
	$imageContainer.html($controlsContainer);
	$controlsContainer.html($closeControl).append($scrollControlsContainer);
	$scrollControlsContainer.append($scrollLeft).append($scrollRight);

	jQuery("body").append($container);

	$controlsContainer.append($pageTitle).append($itemText).append($addThis).append($itemDetails).append($purchaseControlContainer).append($siteIcon);

	$addThis.html($addThisTitle);

	for(key in $addThisSocial){
		$addThis.append($addThisSocial[key].html(addThisIcon).append("<label>"+key+"</label>"));
		$addThisSocial[key].attr("addthis:url",window.location.href).attr("addthis:description",attributes.description);
	}
	$addThisSocial.Pinterest.attr("target","_blank");

	$addThisTitle.html(jQuery("img",attributes._this).attr("title"));

	$purchaseControlContainer.html($purchaseTitle).append($purchaseEmail).append($purchaseCall);

	$container.addClass("uz");
	$containerBackground.addClass("background");
	$imageContainer.addClass("image");
	$controlsContainer.addClass("controls");
	$closeControl.addClass("close");

	$imageContainer.addClass("loading");

	$addThisTitle.addClass("title");
	$addThis.addClass("addthis_toolbox addthis_default_style control");
	$addThisSocial.Facebook.addClass(addthisprefix+"facebook facebook social");
	$addThisSocial.Twitter.addClass(addthisprefix+"twitter twitter social");
	$addThisSocial.Pinterest.addClass("pinit social");
	$addThisSocial.Tumblr.addClass(addthisprefix+"tumblr tumblr social");
	$addThis=jQuery("<div />");

	$scrollControlsContainer.addClass("scroll");
	$scrollLeft.addClass("control left horizontal");
	$scrollRight.addClass("control right horizontal");

	addthis.toolbox(".addthis_toolbox");

	$pageTitle.addClass("page-title");
	$pageTitle.text(jQuery("title").text());
	$itemText.addClass("pagination");
	$itemText.text("Look " + attributes.index + " / "+$zoomItemSelector.length);
	$itemDetails.addClass("details");
	$itemDetails.html(attributes.description);

	$purchaseControlContainer.addClass("purchase");
	$purchaseTitle.addClass("title");
	$purchaseEmail.addClass("email"),
	$purchaseCall.addClass("call");

	$purchaseTitle.text('To Make a Purchase');
	$purchaseEmail.html('<a href="mailto:lisa@urbanzen.com">Email Us: lisa@urbanzen.com</a><br/>');
	$purchaseCall.text("or call 212.206.3999");

	$siteIcon.addClass("icon");

	//$controlsContainer.css("padding-left",$controlsContainer.width());
	if(jQuery(".uz").length==1){
		$controlsContainer.css({"right":-(getWindowWidth()-$controlsContainer.outerWidth())});//-$controlsContainer.outerWidth()});
		$controlsContainer.animate({
			"right":"0"
		},{
			duration:400,
			complete:function(){

			}
		});
	}else{
		$controlsContainer.children().not($closeControl).not($scrollControlsContainer).hide().delay(300).fadeIn(400);
	}
	$img.load(function(){
		var minInitZoom=$img.height()/getWindowHeight()*100;//(getWindowWidth()-$controlsContainer.width())/$img.width()*100;//$img.height()/getWindowHeight()*100;

		//$imageContainer.css('width',-$controlsContainer.outerWidth());
		$imageContainer.css('width',getWindowWidth());//-$controlsContainer.outerWidth());
		

		$imageContainer.removeClass("loading").append(this);

		$img.smoothZoom({
			width: '100%',
			height: '100%',
			zoom_BUTTONS_SHOW : 'NO',
			pan_BUTTONS_SHOW : 'NO',
			pan_LIMIT_BOUNDARY : 'YES',
			zoom_MAX:'450',
			zoom_MIN:minInitZoom,
			responsive: true,
			responsive_maintain_ratio: true,
			initial_ZOOM:(getWindowWidth()-$controlsContainer.outerWidth())/$img.width()*100,
			background_COLOR:'transparent',
			initial_POSITION:'0 0'
		}).parents("div:first")
			.addClass("smoothZoomContainer")
			.css("left",(slideLeftToRight?1:-1) *(getWindowWidth()-$controlsContainer.outerWidth()))
			.delay(50)
			.animate({
				"left":0
			},{
				duration:400
			});

	}).error(function(){
		//show error
	}).attr('src',attributes.image);

	var closeCommon=function(slideRight,comp){
		$img.parents("div:first").animate({
			"left":(slideRight?getWindowWidth():-(getWindowWidth()-$controlsContainer.outerWidth()))
		},{
			duration:400,
			complete:comp
		});
		jQuery(window).unbind("resize",resizeSmoothZoomSize);
	};

	$scrollLeft.click(function(e){
		$container.data("closeWithoutAnimation",true);
		slideLeftToRight=false;
		var item=attributes.index-2;
		if(item<0){
			item=$zoomItemSelector.length-1;
		}
		var $fadeControls=$controlsContainer.children().not($closeControl).not($scrollControlsContainer),
		    fadeLength=$fadeControls.length,
		    i=0;
		$fadeControls.fadeOut(400,function(){
			i++;
			if(i==fadeLength){
				closeCommon(true,function(){$containerBackground.hide();jQuery($zoomItemSelector.get(item)).click();$container.remove();});
			}
		});
		$scrollRight.unbind("click");
		$scrollLeft.unbind("click");
		$closeControl.unbind("click");
	});
	$scrollRight.click(function(e){
		$container.data("closeWithoutAnimation",true);
		slideLeftToRight=true;
		var item=attributes.index;
		if(item>=$zoomItemSelector.length){
			item=0;
		}
		var $fadeControls=$controlsContainer.children().not($closeControl).not($scrollControlsContainer),
		    fadeLength=$fadeControls.length,
		    i=0;
		$fadeControls.fadeOut(400,function(){
			i++;
			if(i==fadeLength){
				closeCommon(false,function(){$containerBackground.hide();jQuery($zoomItemSelector.get(item)).click();$container.remove();});
			}
		});
		$scrollRight.unbind("click");
		$scrollLeft.unbind("click");
		$closeControl.unbind("click");
	});
	jQuery(window).resize(resizeSmoothZoomSize);

	if (window.addthis){
		window.addthis.ost = 0;
		window.addthis.ready();
	}
	$closeControl.click(function(){
		slideLeftToRight=true;
		$controlsContainer.animate({
			"right":($container.data("closeWithoutAnimation")?0:-$controlsContainer.outerWidth())
		},{
			duration:400,
			complete:function(){
				$container.remove();
			}
		});
		window.location.hash='';
		closeCommon();
	});
	$controlsContainer.bind("mousewheel DOMMouseScroll touchmove gesturechange",function(e){
		e.preventDefault();
	});
/* Preload Next and Prev Images */
	var imgNextPre=new Image(),
	    imgPrevPre=new Image();

	imgNextPre.src=jQuery($zoomItemSelector.get(attributes.index==$zoomItemSelector.length?0:attributes.index)).attr("href");
	imgPrevPre.src=jQuery($zoomItemSelector.get(attributes.index-2<0?$zoomItemSelector.length-1:attributes.index-2)).attr("href");

}
