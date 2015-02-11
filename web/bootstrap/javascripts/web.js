$( document ).ready(function() {
    jumbotronBackground();

    var bi = $("#homepage .background").css("background-image").replace(/1/, Math.round((Math.random() * 3) + 1));
    $("#homepage .background").css("background-image", bi);
});
$( window ).resize(function() {
    jumbotronBackground();
});

var jumbotronBackground = function() {
    var p = $("#homepage .jumbotron");
    var position = p.position();
    var height = p.outerHeight();
    var h = height + position.top + 20;
    $(".background").css("height", h + "px");
}
