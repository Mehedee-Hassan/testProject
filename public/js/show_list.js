$(document).ready(function() {

var _CSRFToken = $('meta[name="_token"]').attr('content');




    $(".list-details-change-parent").on("click","li",function(){

        //alert($(this).text());
    //});
    //
    //
    //$('.list-details').on("click", function () {


        var datatosend= $(this).text();

        //alert("token"+ _CSRFToken);

        var listDetailsParentHtml =  $(".list-details-change-parent").html();

        $.ajax({
            type: "post",
            url: "/articles/test/",
            data : { 'list_name' : datatosend},

            success: function (data) {
                //alert('success '+data);





                $('.list-details-change-parent').html("");
                $('.list-details-change').html(data);
                $('.show-all-list h3').html(datatosend);
                $("#button-section-details-list input").css("display","block");

            },
            error: function () {
                alert('error file couldn\'t found');
            }
        });




        $("#button-section-details-list input").on("click",function(e){



            //alert("asd");
            $(".list-details-change").html("");
            $(".list-details-change-parent").html(listDetailsParentHtml);
            $('.show-all-list h3').html("Name");
            $("#button-section-details-list input").css("display", "none");

            e.stopPropagation();

            //todo
            //input event triggering multiple time why??

        });

        //$('.list-details-change').html();
        //$('.list-details-change').html();




    });


    $('.list-details-change').on("click","li,span",function(e) {


                    if (this == e.target) {


                        $(this).find('ul').attr('class','arrow-down');
                        //alert($(this).text());
                        $(this).find('ul').toggle('slow');
                        //$("li").not(this).children('li  ul').hide('slow');
                    }

                    return false;
                })
                .css({cursor:'pointer', 'list-style-image':'url(assets/images/arrow1.png)'})
                .children().hide();



    //
    //$('.final-list-box').find('li:has(ul)').on("click" ,function(event){
    //
    //        alert("sdf");
    //        if (this == event.target) {
    //
    //
    //
    //            alert("sdf");
    //
    //            //alert($(this).text());
    //            $(this).find('ul').toggle('slow');
    //            //$("li").not(this).children('li  ul').hide('slow');
    //
    //
    //
    //        }
    //
    //        return false;
    //    })
    //    .css({cursor:'pointer', 'list-style-image':'url(plusbox.gif)'})
    //    .children().hide();

});

