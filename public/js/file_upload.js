
$(document).ready(function(){




    $(" .button-browse").click(function(){
        $(".file-browse").click();
    });

    $(".file-browse").on('change', function () {

        var filepath = $(".file-browse").val().split('\\').pop();;
        $(".file-path").html( filepath);

    });

    $(".button-cancel").click(function(){
        var filepath = $(".file-browse").val('');
        $(".file-path").html( filepath);

    });


});



