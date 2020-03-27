$(function(){

  $("#buttonNav").click(function showNav() {
    if ($("nav").css("left") === "-242px") {
        $("nav").animate({
            left: "0px"
        }, 100);
    } else {
        $("nav").animate({
            left: "-242px"
        }, 100);
    }
})

});

