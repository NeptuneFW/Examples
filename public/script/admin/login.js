/**
 * Created by Peker on 23.04.2017.
 */
$("document").ready(function () {

    $("span.submit").click(function () {
        var val1 = $("input.email").val();
        var val2 = $("input.password").val();
        if(val1 != "" && val2 != "")
        {
            $("form#login").submit();
        }
    });

});