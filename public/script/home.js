/**
 * Created by Peker on 11.04.2017.
 */

$("document").ready(function () {
    $(".articleContiune").mouseover(function () {
        console.log($(this).parent().find(".mdl-card__title").html());
        $(this).parent().find(".mdl-card__title>h4>span").stop().animate({
            overflow : 'visible',
            maxHeight : '999'
        }, 1000);
    });
    $(".demo-card-event").mouseleave(function () {
        $(this).find(".mdl-card__title>h4>span").stop().animate({
            overflow : 'visible',
            maxHeight : '200'
        }, 1000, 'swing');
    })
});