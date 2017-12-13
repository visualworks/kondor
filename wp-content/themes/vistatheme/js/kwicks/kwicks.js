(function($) {

$.fn.accordion = function( parameters){

	

	var width = 800;

	var height = 800;

	var barSize = 60;

	var cover = false;

	var coverAlpha = 0.7;

	var shadow = false;

	var shadowAlpha = 1;

	var border = true;

	var borderSize = 1;

	var borderColor = "#ffffff";

	var transitionTime = 300;

	var autoplay = false;

	var autoplayTime = 3000;

	var changeType = "over";

	var buttons = false;

	var previousBtn = undefined;

	var nextBtn = undefined;

	

	//PARSE PARAMETERS

	if ( parameters.width != undefined )

		width = parameters.width;

	if ( parameters.height != undefined ) 

		height = parameters.height;

	if ( parameters.barSize != undefined )

		barSize = parameters.barSize;

	if ( parameters.cover != undefined )

		cover = parameters.cover;

	if ( parameters.coverAlpha != undefined )

		coverAlpha = parameters.coverAlpha;

	if ( parameters.shadow != undefined )

		shadow = parameters.shadow;

	if ( parameters.shadowAlpha != undefined )

		shadowAlpha = parameters.shadowAlpha;

	if ( parameters.border != undefined )

		border = parameters.border;

	if ( parameters.borderSize != undefined )

		borderSize = parameters.borderSize;

	if ( parameters.borderColor != undefined )

		borderColor = parameters.borderColor;

	if ( parameters.transitionTime != undefined ){

		transitionTime = parameters.transitionTime;

		transitionTime*=1000;

	}

	if ( parameters.autoplay != undefined )

		autoplay = parameters.autoplay;

	if ( parameters.autoplayTime != undefined ){

		autoplayTime = parameters.autoplayTime;

		autoplayTime*=1000;

	}

	if ( parameters.changeType != undefined )

		changeType = parameters.changeType;

	if ( parameters.previousBtn != undefined && parameters.nextBtn != undefined){

		buttons = true;

		previousBtn = parameters.previousBtn;

		nextBtn = parameters.nextBtn;

	}

	

	var $root = $(this);

	var $blocks = $(".block", this);

	

	var numBlocks = $blocks.size();

	

	var size = width - barSize*(numBlocks-1);

	var currentOpened = 0;

	var clickTypeTimeOut;

	

	$(".holder", $root).css("width", width*2+"px");

	

	$blocks.css("width", width*2+"px");

	$blocks.css("height", height+"px");

	

	$root.css("width", width);

	$root.css("height", height+borderSize*2);

	

	$(".holder .content", $root).css("opacity", 0);

	

	if(border){

		$blocks.css("border", "solid");

		$blocks.css("border-width", borderSize+"px");

		$blocks.css("border-color", borderColor);

		

		$root.css("border-right", "solid");

		$root.css("border-right-width", borderSize+"px");

		$root.css("border-right-color", borderColor);

	}

	

	var i= 0;

	$blocks.each(function(){

		var $currentBlock = $(this);

		$currentBlock.css("left", (i*(width/numBlocks))+"px");	

		$currentBlock.attr("rel", i);

		i++;

		$currentBlock.append('');

	});

	

	//OVER A BLOCK

	var overBlock = function(num){

		

		var $thisBlock = $($blocks[num]);

		

		if(!$thisBlock.hasClass("locked")){

			currentOpened = num;

			

			$thisBlock.addClass("locked");

			

			$thisBlock.stop().animate({

			   left: barSize*num

			}, transitionTime );

			

			

			$(".content_holder", $thisBlock).stop().animate({

				left: (-$thisBlock.width()/2+size/2)	

			}, transitionTime );

			

			if(shadow)

				$(".shadow", $thisBlock).stop().animate({

				   width: size

				}, transitionTime );

			

			var left=true;

			for(var i=0; i<numBlocks; i++){

				var $block = $($blocks[i]);

				

				if(i==num){

					left=false;

					if(cover)

						$(".content_holder .cover", $block).stop().fadeTo(transitionTime, 0);	

				}

				else{

					if(left){

						$block.stop().animate({

						   left: barSize*i

						}, transitionTime );

					}

					else{

						$block.stop().animate({

						   left: width-barSize*(numBlocks-i)

						}, transitionTime );

					}

					$(".content_holder", $block).stop().animate({

						left: (-$(".content_holder", $block).width()/2+barSize/2)	

					}, transitionTime );

					

					if(cover)

						$(".content_holder .cover", $block).stop().fadeTo(transitionTime, coverAlpha);

						

					if(shadow)

						$(".shadow", $block).stop().animate({

						   width: barSize

						}, transitionTime );

				}

			}

			

			$(".content", $thisBlock).each(function(){

				var $this = $(this);

				

				$this.clearQueue();

				var type = $this.attr("transitionType");

				var alignV = "top";

				var alignH = "left";

				var delay = 0;

				var distance = 30;

				var transitionTimeContent = 500;

				var left = 0;

				var top = 0;

				

				//READ ATTRIBUTES

				if($this.attr("alignV") !=  undefined)

					alignV = $this.attr("alignV");

					

				if($this.attr("alignH") != undefined)

					alignH = $this.attr("alignH");

				

				if($this.attr("delay") != undefined)

				   delay = parseFloat($this.attr("delay"), 10)*1000;

				   

				if($this.attr("distance") != undefined)

				   distance = parseInt($this.attr("distance"), 10);

				   

				if($this.attr("transitionTime") != undefined)

				   transitionTimeContent =  parseFloat($this.attr("transitionTime"), 10)*1000;

				   

				if($this.attr("x") != undefined)

				   left =  parseInt($this.attr("x"), 10);

				 

				if($this.attr("y") != undefined)

				   top =  parseInt($this.attr("y"), 10);

				

			

				if(alignV=="bottom"){

					top = height-$this.height()-top;

				}

				if(alignH=="right"){

					left = size-$this.width()-left;

				}

			

				$this.css("left", left+'px');

				$this.css("top", top+'px');

				

				

				if(type=="left")

					$this.css("left", (left-distance)+'px');

				else if(type=="right")

					$this.css("left", (left+distance)+'px');

				else if(type=="top")

					$this.css("top", (top-distance)+'px');

				else if(type=="bottom")

					$this.css("top", (top+distance)+'px');

						

					

				$this.stop().delay(transitionTime+delay).animate({

					left: left,

					top: top,

					opacity: 1

				}, transitionTimeContent );

			});

			

			if(changeType=="click"){

				clearTimeout(clickTypeTimeOut);

				clickTypeTimeOut = setTimeout(function(){ 

					outBlock(currentOpened);

					if(currentOpened<(numBlocks-1))

						currentOpened++;

					else

						currentOpened = 0;

					overBlock(currentOpened); }, autoplayTime);

			}

		}

	}

	

	

	var outBlockContent = function(num){

		var $thisBlock = $($blocks[num]);

		

		$(".content", $thisBlock).each(function(){

			var $this = $(this);

			

			$this.clearQueue();

			

			var type = $this.attr("transitionType");

			var alignV = "top";

			var alignH = "left";

			var distance = 30;

			var left = 0;

			var top = 0;

			var transitionTimeContent = 500;

			

			//READ ATTRIBUTES

			if($this.attr("alignV") !=  undefined)

				alignV = $this.attr("alignV");

				

			if($this.attr("alignH") != undefined)

				alignH = $this.attr("alignH");

			   

			if($this.attr("distance") != undefined)

			   distance = parseInt($this.attr("distance"), 10);

			   

			if($this.attr("transitionTime") != undefined)

			   transitionTimeContent =  parseFloat($this.attr("transitionTime"), 10)*1000;

			   

			if($this.attr("x") != undefined)

			   left =  parseInt($this.attr("x"), 10);

			 

			if($this.attr("y") != undefined)

			   top =  parseInt($this.attr("y"), 10);

		

			if(alignV=="bottom")

				top = height-$this.height()-top;

			if(alignH=="right")

				left = size-$this.width()-left;

			

			

			

			if(type=="left")

				left-=distance;

			else if(type=="right")

				left+=distance;

			else if(type=="top")

				top-=distance;

			else if(type=="bottom")

				top+=distance;

					

				

			$this.stop().animate({

				left: left,

				top: top,

				opacity: 0

			}, transitionTime );

		});

	}

	

	//OUT OF A BLOCK

	var outBlock = function(num){

		var $thisBlock = $($blocks[num]);

		

		$thisBlock.removeClass("locked");

		

		outBlockContent(num);

		

		for(var i=0; i<numBlocks; i++){

			var $block = $($blocks[i]);

		

			$block.stop().animate({

			   left: (i*(width/numBlocks))

			}, 300 );

			

			$(".content_holder", $block).stop().animate({

				left: (-$(".content_holder", $block).width()/2+(width/numBlocks)/2)

			}, 300 );

			

			if(cover)

				$(".content_holder .cover", $block).stop().fadeTo(transitionTime, 0);

			

			if(shadow)

				$(".shadow", $block).stop().animate({

				   width: (width/numBlocks)

				}, transitionTime );

		}

	}

	

	//INITIAL IMAGES LOAD

	var loadImage = function(num){

		var $block = $($blocks[num]);

		

		//create image

		var img = new Image();

		img.onload = function() {

			

			$(img).css("opacity" , 0);

			

			var maxWidth =  size;

			var maxHeight = height;

			

			var ratio = 1;

				

			if( img.width > maxWidth )

				ratio = img.width / maxWidth;

				

			if( ratio > (img.height/maxHeight))

				ratio = img.height / maxHeight;

				

			img.width /= ratio;				

			img.height /= ratio;

			

			var imgWidth = img.width;

			var imgHeight = img.height;

			

			$block.css("width", imgWidth+"px");

			

			$(".content_holder", $block).css("width", imgWidth+"px");

			$(".content_holder", $block).css("left", (-imgWidth/2+(width/numBlocks)/2)+"px");



			$(".content_holder .image", $block).append( img );

				

			$(".content", $block).css("padding-left", (imgWidth-size)/2+"px");

			$(".content", $block).css("padding-right", (imgWidth-size)/2+"px");

				

			if(cover){

				var $cover = $(".content_holder .cover", $block);

				

				$(".content_holder", $block).append( '<div class="cover"></div>' );

				

				$cover.css("width", imgWidth+"px");

				$cover.css("height", imgHeight+"px");

				$cover.css("opacity", 0);

			}

			

			if(shadow && num<numBlocks){

				var $shadow = $(".shadow", $block);

				

				$block.append( '<div class="shadow"></div>' );

				

				$shadow.css("width", (width/numBlocks)+"px");

				$shadow.css("height", imgHeight+"px");

				$shadow.css("opacity", shadowAlpha);

			}

			

			if(changeType=="click"){

				$block.click(	function(){

									    if(currentOpened != parseInt($(this).attr("rel"), 10))

									    		outBlock(currentOpened);

										overBlock(parseInt($(this).attr("rel"), 10));});

				$block.css("cursor", "pointer");

			}

			else

				$block.hover(	function(){ if(currentOpened != parseInt($(this).attr("rel")))

									    		outBlock(currentOpened);

										overBlock(parseInt($(this).attr("rel"), 10));}, 

								function(){outBlock(parseInt($(this).attr("rel"), 10));});

				

				

			$( img ).fadeTo( 500 , 1);

			

			if(num < numBlocks){

				num++

				loadImage(num);

			}

			else

				clickTypeTimeOut = setTimeout(function(){ 

					overBlock(currentOpened); }, autoplayTime);

			

		}

			

		img.src = $(".content_holder", $block).attr("src");

	}

	loadImage(0);

	

	if(buttons){

		previousBtn.click(function(){

				outBlock(currentOpened);

				if(currentOpened>0)

					currentOpened--;

				else

					currentOpened = numBlocks-1;

				overBlock(currentOpened); 			  

							  });

		nextBtn.click(function(){

				outBlock(currentOpened);

				if(currentOpened<(numBlocks-1))

					currentOpened++;

				else

					currentOpened = 0;

				overBlock(currentOpened); 

							  });

	}

	

};

}( jQuery ));