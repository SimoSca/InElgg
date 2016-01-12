// questo script utilizza anche un modulo esterno, teoricamente salvato in 
// foowd_utility/views/default/js/foowd_utility/crop.js


define(function(require) {
    var $ = require("jquery");
    var hello = require("foowd_utility/crop");
    ('#sorgente').cropper({
  aspectratio: 16 / 9,
  crop: function(data) {
    // Output the result data for cropping image.
  }
});
$('body').css("background-color",'red');
alert('lol');
    $('body').append('lol');
});