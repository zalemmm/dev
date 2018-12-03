


window['paper3dStyle'] = function(elem, s, fontSize)
{
	innerShadow(s, elem, fontSize, {shadowColor:"#fff", blur:1, x:2, y:2, opacity:.5})
	longShadow(s, elem, fontSize, {iterations:10, over:.5, down:1, color:"#000", startingOpacity:.05, endingOpacity:0})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['shortShadowStyle'] = function(elem, s, fontSize)
{

	var ratio = fontSize/100;
	innerShadow(s, elem, fontSize, {x:1, y:2, shadowColor:"#fff", opacity:.6});
	longShadow(s, elem, fontSize, {iterations:8, over:1, down:1, color:"#000", opacity:.5})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['isometric3dStyle'] = function(elem, s, fontSize)
{

	innerShadow(s, elem, fontSize, {x:1, y:2, shadowColor:"#fff", opacity:.6});
	var last3d = longShadow(s, elem, fontSize, {iterations:10, over:-1, down:1, color:"#333", color2:"#666"});
	var shadow = longShadow(s, last3d.elem, fontSize, {iterations:20, over:1, down:1, color:"#000", startingOpacity:.05, endingOpacity:0});
	dropShadow(s, last3d.elem, fontSize, {x:0, y:0, blur:5, color:"#000", opacity:.5})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['isometric3dRightStyle'] = function(elem, s, fontSize)
{

	innerShadow(s, elem, fontSize, {x:-1, y:2, shadowColor:"#fff", opacity:.6});
	var last3d = longShadow(s, elem, fontSize, {iterations:10, over:1, down:1, color:"#333", color2:"#666"});
	var shadow = longShadow(s, last3d.elem, fontSize, {iterations:20, over:-1, down:1, color:"#000", startingOpacity:.05, endingOpacity:0});
	dropShadow(s, last3d.elem, fontSize, {x:0, y:0, blur:5, color:"#000", opacity:.5})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['isometric3dStraightStyle'] = function(elem, s, fontSize)
{

	innerShadow(s, elem, fontSize, {x:1, y:2, shadowColor:"#fff", opacity:.6});
	var last3d = longShadow(s, elem, fontSize, {iterations:10, over:0, down:1, color:"#333"});
	var shadow = longShadow(s, last3d.elem, fontSize, {iterations:20, over:1, down:1, color:"#000", startingOpacity:.1, endingOpacity:0});
	dropShadow(s, last3d.elem, fontSize, {x:0, y:0, blur:5, color:"#000", opacity:.5})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['longShadowStyle'] = function(elem, s, fontSize)
{

	innerShadow(s, elem, fontSize, {x:2, y:2, shadowColor:"#fff", opacity:.5});
	longShadow(s, elem, fontSize, {iterations:25, over:1, down:1, color:"#000", opacity:.5})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}


window['layeredStyle'] = function(elem, s, fontSize)
{

	innerShadow(s, elem, fontSize, {x:1, y:2, shadowColor:"#fff", opacity:.6});
	var layer1 = longShadow(s, elem, fontSize, {iterations:3, over:-1, down:1, color:"#444"});
	var layer2 = longShadow(s, layer1.elem, fontSize, {iterations:3, over:-1, down:1, color:"#666"});
	var layer3 = longShadow(s, layer2.elem, fontSize, {iterations:3, over:-1, down:1, color:"#444"});
	longShadow(s, layer3.elem, fontSize, {iterations:10, over:1, down:1, color:"#000", startingOpacity:.05, endingOpacity:0});

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);

}

window['indentStyle'] = function(elem, s, fontSize)
{
	innerShadow(s, elem, fontSize, {y:2, blur:2, shadowColor:"#000", opacity:.7});
	dropShadow(s, elem, fontSize, {x:2, y:2, blur:2, color:"#fff", opacity:.3})


	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);
}

window['deepIndentStyle'] = function(elem, s, fontSize)
{
	innerShadow(s, elem, fontSize, {y:6, blur:3, shadowColor:"#000", opacity:.5});
	dropShadow(s, elem, fontSize, {x:2, y:2, blur:2, color:"#fff", opacity:.4})

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);
}

window['perspective3dStyle'] = function(elem, s, fontSize)
{
	innerShadow(s, elem, fontSize, {x:1, y:2, shadowColor:"#fff", opacity:.5});
	innerShadow(s, elem, fontSize, {x:-1, y:-1, shadowColor:"#000", opacity:.1});
	var last3d = longShadow(s, elem, fontSize, {iterations:10, over:2, down:1.1, perspective:true, color:"#444"});
	longShadow(s, last3d.elem, fontSize, {iterations:20, over:1, down:1, color:"#000", startingOpacity:.05, endingOpacity:0});
	dropShadow(s, last3d.elem, fontSize, {x:0, y:0, blur:5, color:"#000", opacity:.5});

	var newColor = ColorLuminance(elem, -.2);
	makeLink(s, elem, fontSize, 100, [
		{toAnimate:elem, color:newColor}
	]);
}
