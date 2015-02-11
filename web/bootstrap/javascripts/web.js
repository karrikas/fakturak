$( document ).ready(function() {
    jumbotronBackground();

    var bi = $(".background").css("background-image").replace(/1/, Math.round((Math.random() * 3) + 1));
    $(".background").css("background-image", bi);
});
$( window ).resize(function() {
    jumbotronBackground();
});

var jumbotronBackground = function() {
    var p = $("#homepage .jumbotron");
    if (p.length == 0) {
        return;
    }
    var position = p.position();
    var height = p.outerHeight();
    var h = height + position.top + 20;
    $(".background").css("height", h + "px");
}
