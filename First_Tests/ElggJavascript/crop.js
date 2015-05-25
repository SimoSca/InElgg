// script in versione AMD compatibile.

(function (root, factory) {

    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define([], factory);
    } else if (typeof exports === 'object') {
        // Node. Does not work with strict CommonJS, but
        // only CommonJS-like environments that support module.exports,
        // like Node.
        module.exports = factory();
    } else {
        // Browser globals (root is window)
        root.returnExports = factory();
  }
}(this, function () {

$('body').css("background-color",'red');
    var elgg = require("elgg");
    var $ = require("jquery");
    // $('body').append(elgg.echo('hello ziooo world'));	
	
	$('body').css('background-color', 'red');
	  var canvas = document.getElementById('myCanvas');
	  var context = canvas.getContext('2d');
	  var imageObj = new Image();
	  imageObj.src = document.getElementById('sorgente').getAttribute("src");

	  imageObj.onload = function() {

	  	console.log(this);
	  	console.log(canvas.width);
	    context.drawImage(imageObj, 0, 0, canvas.width, canvas.height);
	  };

	  canvas.onclick = function(){
	  	context.drawImage(imageObj, 0, 0, canvas.width/2, canvas.height/2);
	  }    

    return  {

    };
}));