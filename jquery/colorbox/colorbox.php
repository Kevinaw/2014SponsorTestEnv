<?php
//// Tell the browser that this is CSS instead of HTML
//header("Content-type: text/css");
//
//// Get the color generating code
////include_once("../../func_include/csscolor.php");
////include_once("../../config_include/eventColours.php");
//
//// Set the error handing for csscolor.
//// If an error occurs, print the error
//// within a CSS comment so we can see
//// it in the CSS file.
//PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'errorHandler');
//function errorHandler($err) {
//    echo("/* ERROR " . $err->getMessage() . " */");
//}
//
//
//// Trigger an error just to see what happens
//// $trigger = new CSS_Color('');
?>
/*
ColorBox Core Style:
The following CSS is consistent between example themes and should not be altered.
*/
#colorbox, #cboxOverlay, #cboxWrapper{position:absolute; top:0; left:0; z-index:9999; overflow:hidden;}
#cboxOverlay{
position:fixed;
width:100%;
height:100%;
}
#cboxMiddleLeft, #cboxBottomLeft{clear:left;}
#cboxContent{position:relative;}
#cboxLoadedContent{overflow:auto;}
#cboxTitle{margin:0;}
#cboxLoadingOverlay, #cboxLoadingGraphic{position:absolute; top:0; left:0; width:100%;}
#cboxPrevious, #cboxNext, #cboxClose, #cboxSlideshow{cursor:pointer;}
.cboxPhoto{float:left; margin:auto; border:0; display:block;}
.cboxIframe{width:100%; height:100%; display:block; border:0;}

/* 
User Style:
Change the following styles to modify the appearance of ColorBox.  They are
ordered & tabbed in a way that represents the nesting of the generated HTML.
*/
#cboxOverlay{background:#999999}
#colorbox{}
#cboxTopLeft{width:25px; height:25px; background:url(images/border1.png) no-repeat 0 0;}
#cboxTopCenter{height:25px; background:url(images/border1.png) repeat-x 0 -50px;}
#cboxTopRight{width:25px; height:25px; background:url(images/border1.png) no-repeat -25px 0;}
#cboxBottomLeft{width:25px; height:25px; background:url(images/border1.png) no-repeat 0 -25px;}
#cboxBottomCenter{height:25px; background:url(images/border1.png) repeat-x 0 -75px;}
#cboxBottomRight{width:25px; height:25px; background:url(images/border1.png) no-repeat -25px -25px;}
#cboxMiddleLeft{width:25px; background:url(images/border2.png) repeat-y 0 0;}
#cboxMiddleRight{width:25px; background:url(images/border2.png) repeat-y -25px 0;}
#cboxContent{background:#ffffff; overflow:hidden;}
#cboxError{padding:50px; border:1px solid #666666;}
#cboxLoadedContent{margin-top:20px;}
#cboxTitle{position:absolute; top:0px; left:0; text-align:left; width:100%; color:#ffffff; font-weight: bold; padding: 3px; background-color: #666666;}
#cboxCurrent{position:absolute; bottom:0px; left:100px; border: 3px solid #ffffff;}
#cboxSlideshow{position:absolute; bottom:0px; right:42px; color:#666666;}
#cboxPrevious{position:absolute; bottom:0px; left:0; color:#666666;}
#cboxNext{position:absolute; bottom:0px; left:63px; color:#666666;}
#cboxLoadingOverlay{background:#ffffff url(images/loading.gif) no-repeat 5px 5px;}
#cboxClose{ position:absolute; top:0; right:0; display:block; color:#666666;background-color: #ffffff; font-size:70%; border: 1px solid #999999; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; padding: 2px 4px 2px 4px; margin: 3px 4px 0px 0px; }
#cboxClose:hover{color:#ffffff; background: #666666; }

/*
The following fixes a problem where IE7 and IE8 replace a PNG's alpha transparency with a black fill
when an alpha filter (opacity change) is set on the element or ancestor element.  This style is not applied to IE9.
*/
.cboxIE #cboxTopLeft,
.cboxIE #cboxTopCenter,
.cboxIE #cboxTopRight,
.cboxIE #cboxBottomLeft,
.cboxIE #cboxBottomCenter,
.cboxIE #cboxBottomRight,
.cboxIE #cboxMiddleLeft,
.cboxIE #cboxMiddleRight {
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF);
}

/*
The following provides PNG transparency support for IE6
*/
.cboxIE6 #cboxTopLeft{background:url(images/ie6/borderTopLeft.png);}
.cboxIE6 #cboxTopCenter{background:url(images/ie6/borderTopCenter.png);}
.cboxIE6 #cboxTopRight{background:url(images/ie6/borderTopRight.png);}
.cboxIE6 #cboxBottomLeft{background:url(images/ie6/borderBottomLeft.png);}
.cboxIE6 #cboxBottomCenter{background:url(images/ie6/borderBottomCenter.png);}
.cboxIE6 #cboxBottomRight{background:url(images/ie6/borderBottomRight.png);}
.cboxIE6 #cboxMiddleLeft{background:url(images/ie6/borderMiddleLeft.png);}
.cboxIE6 #cboxMiddleRight{background:url(images/ie6/borderMiddleRight.png);}

.cboxIE6 #cboxTopLeft,
.cboxIE6 #cboxTopCenter,
.cboxIE6 #cboxTopRight,
.cboxIE6 #cboxBottomLeft,
.cboxIE6 #cboxBottomCenter,
.cboxIE6 #cboxBottomRight,
.cboxIE6 #cboxMiddleLeft,
.cboxIE6 #cboxMiddleRight {
_behavior: expression(this.src = this.src ? this.src : this.currentStyle.backgroundImage.split('"')[1], this.style.background = "none", this.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=" + this.src + ", sizingMethod='scale')");
}
