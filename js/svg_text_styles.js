var allSs = [];
var txtWs = [];
var svgClasses;
var loaded = 0;
var pageLoaded;
var fontsToLoad = [];
var ratios = [];
var patternPath = "svgTextures/";
var allGs = [];



//check to see if page and all Google fonts loaded
function allLoaded()
{
	loaded++;

	if(loaded == fontsToLoad.length + 1){
		//make them visible, style them
		svgClasses = document.getElementsByClassName("svgTxt");
		for (var i = 0; i < svgClasses.length; i++) {

			styleTxt(svgClasses[i], i);
		};
		//make sure it's positioned right based on screen size
		wResized();
	}
}


function styleTxt(htmlElem, ind)
{

	//create snap element for each text
	//htmlElem.style.opacity = 1;
	var s = Snap(htmlElem);


	allSs.push(s);
	var theTxt = s.select("text");//select the SVG text


	//makeLink(theTxt, htmlElem);

	//s.animate({opacity: 1}, 500);
	htmlElem.style.opacity = 1;
	//var thisG = s.g(theTxt)//add it to a group so it's easier to manage the duplicates
	var thisG = s.select("g");
	allGs.push(thisG);

	var txtClass = theTxt.attr("class");//determine the class from the SVG
	//figure out text width and font size
	txtWs[ind] = theTxt.getBBox().width;
	var thisClass = window.getComputedStyle(htmlElem.getElementsByClassNam(txtClass)[0]);
	var fontSize = parseInt(thisClass.getPropertyValue('font-size'));

	//position the text based on height
	theTxt.attr({
		fill:thisClass.getPropertyValue('fill'),
		y:fontSize,
		x:0
	})

	//position the snap element based on the width
	var elemW = theTxt.getBBox().width;
	var elemH = theTxt.getBBox().height;
	s.attr({
		width:elemW
	})


	if(s.select("a")){//determine if it's a link
		var hitRect = s.rect(-elemH*.2, 0, elemW + elemH*.4, elemH).attr({
			fill:"#000000",
			opacity:0
		})
		hitRect.insertBefore(thisG)
	}
	//call the specific style
	window[txtClass](theTxt, s, fontSize);



}

(function(d,g){d[g]||(d[g]=function(g){return this.querySelectorAll("."+g)},Element.prototype[g]=d[g])})(document,"getElementsByClassNam");

//sees the parameter as a string ans splits out what it needs
function GetParameter(str, before, after, defaultVal)
{

	var indexOfBefore = str.indexOf(before);
	if(indexOfBefore == -1)
		return defaultVal;

	var beforeLength = before.length;
	var firstLetter = indexOfBefore + beforeLength;
	var indexOfLast = str.indexOf(after, firstLetter);
	var thisParam = str.substring(firstLetter, indexOfLast);

	if(thisParam == "true"){
		return true;
	}else if(thisParam == "false"){
		return false;
	}

	return thisParam;
}

//create an extrusion with just 1 line of code

function longShadow(s, elem, fontSize, attrs)
{
	var ratio = fontSize/100;
	var elemX = parseInt(elem.attr("x"));
	var elemY = parseInt(elem.attr("y"));
	if(attrs.x)elemX+=attrs.x;
	if(attrs.y)elemY+=attrs.y;

	if(!attrs.startingOpacity)attrs.startingOpacity = 1;
	if(attrs.endingOpacity == undefined)attrs.endingOpacity = 1;
	if(!attrs.over)attrs.over = 0;
	if(!attrs.down)attrs.down = 0;
	if(!attrs.opacity)attrs.opacity = 1;

	var prevElem = elem;
	iterations = Math.ceil(attrs.iterations *ratio);


	if(attrs.perspective){
		var toShrinkEach = ((attrs.over * attrs.iterations * 2)/attrs.iterations)/elem.getBBox().width;
		var currScaleX = 1;
	}

	var g = s.g();
	g.insertBefore(elem)

	var offset = [1,1];
	if(attrs.color2){
		var colors = [attrs.color, attrs.color2];
		iterations *=2;
	}


	for (var i = 0; i < iterations; i++) {

		if(attrs.color2){
			attrs.color = colors[i%2];
			if(i%2){
				offset = [1,0];
			}else{
				offset = [0, 1]
			}
		}

		var newElem = elem.clone().insertBefore(prevElem);
		if(i == 0)g.add(newElem);

		if(attrs.perspective && i > 0){
			var myMatrix = new Snap.Matrix();
			var newScale = currScaleX-=toShrinkEach;
			myMatrix.scale(newScale,newScale);
			newElem.attr({
				transform:myMatrix
			});
		}

		if(newElem.attr("stroke") != "none")
			newElem.attr({stroke:attrs.color})

		if(!attrs.color)
			attrs.color = newElem.attr("fill")

		newElem.attr({
			// x:elemX + (attrs.over  *i),
			// y:elemY + (attrs.down *i),
			x: parseFloat(prevElem.attr("x")) + attrs.over * offset[0],
			y: parseFloat(prevElem.attr("y")) + attrs.down * offset[1],
			fill:attrs.color,
			opacity:attrs.startingOpacity - (attrs.startingOpacity-attrs.endingOpacity)/iterations * i
		})


		prevElem = newElem;

	};



	g.attr({
		opacity:attrs.opacity
	})

	var returns = {elem:newElem, group:g};
	return returns;

}

//create an inner shadow with 1 line of code
//function innerShadow(s, elem, fontSize, posX, posY, blurX, blurY, elemColor, shadowColor)
function innerShadow(s, elem, fontSize, attrs)
{

	if(!attrs.shadowColor)
	  	attrs.shadowColor = elem.attr("#000");

	if(!attrs.x)attrs.x = 0;
	if(!attrs.y)attrs.y = 0;
	if(!attrs.opacity)attrs.opacity = 1;
	var ratio = fontSize/100;

	// if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1)
	// {
	//     attrs.blur = 0;
	// }

	var elemX = parseInt(elem.attr("x"));
	var elemY = parseInt(elem.attr("y"));



	var maskClone2 = elem.clone();
	maskClone2.attr({
		fill:"#000",
		x:elemX + attrs.x*ratio,
		y:elemY + attrs.y*ratio
	});

	if(attrs.blur && navigator.userAgent.toLowerCase().indexOf('firefox') == -1){
	 	var blur = s.filter(Snap.filter.blur(attrs.blur*ratio, attrs.blur*ratio));
		blur.attr({
			"color-interpolation-filters":"sRGB"
		})
		maskClone2.attr({filter:blur})
	 }

	var maskClone1 = elem.clone();
	maskClone1.attr({fill:"#fff"});

	var maskG = s.g(maskClone1, maskClone2);

	var shadowClone = elem.clone();
	shadowClone.attr({
		fill:attrs.shadowColor,
		mask:maskG,
		opacity:attrs.opacity
	})

}

function addSVGStroke(elem, fontSize, attrs)
{
	var ratio = fontSize/100;
	if(!attrs.opacity)attrs.opacity = 1;
	if(!attrs.stroke)attrs.stroke = elem.attr("fill");
	elem.attr({
		strokeWidth:attrs.strokeWidth*ratio,
		stroke:attrs.stroke,
		opacity:attrs.opacity
	})
	return elem;
}

function dropShadow(s, elem, fontSize, attrs)
{

	if(!attrs.x)attrs.x = 0;
	if(!attrs.y)attrs.y = 0;
	if(!attrs.opacity)attrs.opacity = 1;

	var ratio = fontSize/100;
	var shadow = s.filter(Snap.filter.shadow(attrs.x*ratio, attrs.y*ratio, attrs.blur*ratio, attrs.color, attrs.opacity));
	elem.attr({
    	filter:shadow
	})
}

function newShape(elem, fontSize, attrs)
{

	var ratio = fontSize/100;
 	var thisClone = elem.clone();
 	if(!attrs.addInFront)
 		thisClone.insertBefore(elem);

	if(attrs.color){
		thisClone.attr({
			fill:attrs.color
		})
	}

	if(attrs.x){
		thisClone.attr({
			x:attrs.x*ratio
		})
	}

	if(attrs.opacity){
		thisClone.attr({
			opacity:attrs.opacity
		})
	}

	if(attrs.y){
		thisClone.attr({
			y:attrs.y*ratio+fontSize
		})
	}

	if(attrs.strokeWidth && attrs.stroke)
		addSVGStroke(thisClone, fontSize, attrs);


	return thisClone;
}

function addPattern(s, elem, fontSize, attrs)
{

	var ratio = 1;
	if(!attrs.strokeWidth)attrs.strokeWidth = 1;
	if(attrs.scale){
		attrs.scaleX = attrs.scale;
		attrs.scaleY = attrs.scale;
	}
	if(attrs.clone == true)
		elem = elem.clone();

	if(attrs.opacity){
		elem.attr({
			opacity:attrs.opacity
		})
	}

	var newPattern = s.image(patternPath + attrs.pattern, 0, 0, attrs.scaleX*ratio, attrs.scaleY*ratio)
		.pattern(0, 0, attrs.scaleX*ratio, attrs.scaleY*ratio);

	if(attrs.stroke)
		addSVGStroke(elem, fontSize, attrs);

	elem.attr({
		fill:newPattern
	})

	return elem;

}

function makeShadowLink(s, elem, fontSize, shadowGroup, time)
{

	//var prevElem = shadowElements[0];


	// for (var i = 1; i < shadowElements.length; i++) {

	// 	var thisElem = shadowElements[i];
	if(s.select("a")){//determine if it's a link

		var shadowElements = shadowGroup.selectAll("text");
		var eLength = shadowElements.length;
		var lastE = eLength - 1;
		var startingPos = parseFloat(shadowElements[lastE].attr("x"));
		var overAmount = shadowElements[lastE-1].attr("x") - startingPos;

		s.hover(function hoverIn(f)
		{
			for (var i = 0; i < eLength; i++) {

				var thisElem = shadowElements[lastE - i];
				thisElem.animate({
					x: -overAmount * i + startingPos
				}, time);

			};
		}, function hoverOut()
		{
			for (var i = 0; i < eLength; i++) {

				var thisElem = shadowElements[lastE - i];
				thisElem.animate({
					x: overAmount * i + startingPos
				}, time);

			};
		});
	}


		//var prevElem = shadowElements[i];

	//};
}

function makeLink(s, elem, fontSize, time, attrs)
{

	if(s.select("a")){//determine if it's a link

		var ratio = fontSize/100;
		var startingAttrs = [];

		//s.style.cursor="poniter";

		for (var ix = 0; ix < attrs.length; ix++) {

			var thisStartingAttrs = attrs[ix];
			var startingElem = thisStartingAttrs.toAnimate;
			startingAttrs[ix] = {
				startingX:parseInt(startingElem.attr("x")),
				startingY:parseInt(startingElem.attr("y")),
				startingStroke:startingElem.attr("stroke"),
				startingstrokeWidth:startingElem.attr("strokeWidth"),
				startingColor:startingElem.attr("fill")
			}
		};

		s.hover(function hoverIn()
		{

			for (var i = 0; i < attrs.length; i++) {

				var thisAttrs = attrs[i];
				var thisElem = thisAttrs.toAnimate;
				var startingX = startingAttrs[i].startingX;
			 	var startingY = startingAttrs[i].startingY;

				if(!thisAttrs.x)thisAttrs.x = 0;
				if(!thisAttrs.y)thisAttrs.y = 0;

				if(thisElem.attr("stroke") == "none"){
					thisAttrs.strokeWidth = 0;
				}else{
					if(!thisAttrs.stroke)thisAttrs.stroke = thisElem.attr("stroke");
					if(!thisAttrs.strokeWidth)thisAttrs.strokeWidth = thisElem.attr("strokeWidth");
				}
				thisElem.animate({
		        	x:startingX + thisAttrs.x*ratio,
		        	y:startingY + thisAttrs.y*ratio,
		        	stroke:thisAttrs.stroke,
		        	strokeWidth:thisAttrs.strokeWidth*ratio,
		        }, time);

		        if(thisAttrs.color){
		        	thisElem.animate({
		        		fill:thisAttrs.color
		        	}, time);
		        };



			}

		},
		function hoverOut()
		{

			for (var j = 0; j < attrs.length; j++) {

				var thisAttrs = attrs[j];
				var thisElem = thisAttrs.toAnimate;
				thisElem.animate({
	           		x:startingAttrs[j].startingX,
	           		y:startingAttrs[j].startingY,
	           		stroke:startingAttrs[j].startingStroke,
	           		strokeWidth:startingAttrs[j].startingstrokeWidth,
	           	}, time);

				if(thisAttrs.color){
		        	thisElem.animate({
		        		fill:startingAttrs[j].startingColor
		        	}, time);
		        };

			}


		});

	}

}




//reposition and resize text based on parent width
function wResized(){
	for (var i = 0; i < svgClasses.length; i++) {


		var txtW = allSs[i].getBBox().width;
		var parW = svgClasses[i].parentNode.offsetWidth;


		if(txtWs[i] > parW){
			var ratio = parW/txtWs[i];
			var t = new Snap.matrix();
			t.scale(ratio);
			allGs[i].transform(t);
		}else if(parW >= txtWs[i] ){
			var t1 = new Snap.matrix();
			var ratio = parW/txtWs[i];
			if(ratio > 1)ratio = 1;
			t1.scale(ratio);
			allGs[i].transform(t1);
		}

		var txtH = allSs[i].getBBox().height;
		if(txtH < 110)txtH = 110;
		allSs[i].attr({
			height:txtH
		})
	};
}

function ColorLuminance(elem, lum) {

	var colorElem = Snap.getRGB(elem.attr("fill"));

	var hex = rgbToHex(colorElem.r, colorElem.g, colorElem.b);


	//var hex = rgbToHex(rbg)
	// validate hex string
	hex = String(hex).replace(/[^0-9a-f]/gi, '');
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	lum = lum || 0;

	// convert to decimal and change luminosity
	var rgb = "#", c, i;
	for (i = 0; i < 3; i++) {
		c = parseInt(hex.substr(i*2,2), 16);
		c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
		rgb += ("00"+c).substr(c.length);
	}

	return rgb;
}

function rgbToHex(r, g, b) {
    return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
}

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}
