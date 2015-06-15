$(window).load(function(){



var globalDescriptionData = '';
var bigData;




    var searchTree = "";
    var  fullHTML =  $(".div-right-form").html();




    $('#button-list').on("click",function(){

        //alert('list');
        //showOnlyList();
    });



//==ajax form submit
    $(".button-submit").on("click",function(e)
    {
        //e.preventDefault();

            var listName = prompt("Name:", "");

            if(listName == null)
                e.preventDefault();
            else if(listName == ""){

                alert("\t\tSorry !!\n\n List Name Required.");
                e.preventDefault();

            }

          while(checkIfListNameExists(listName) == true){



                   e.preventDefault();


                   alert('sorry!! list name exists\n\t  try new one');

                   listName = prompt("Name:", "");



                   if(listName == null){

                          e.preventDefault();
                            break;
                      }
                      else if(listName == ""){

                          alert("\t\tSorry !!\n\n List Name Required.");
                          e.preventDefault();
                          break;
                      }


            }







            $('#__form_generated_name__').attr("value",listName);


            var postData = $(this).serializeArray();
            var formURL = $("#checboxlist-form").attr("action");

            var allVals = [];


        if(allVals != "" && (text != null || text == true)) {

            $(".div-right-form").html(allVals);

        }


    });

    $(".show-csv-button-section").on("click",".button-cancel",function(){

        $confirmVal = confirm("Deselect All !!!")
        if($confirmVal)
            $(".div-right-form-list input[type=checkbox]").prop('checked', false);

    });


    $("#button-data").on("click",function(){

        $(".div-right-form").html(fullHTML)
        location.reload();
    });




        $('li')
            .click(function(e){



                //
                //if(this == e.taget){
                var obj = $(this).text();
                var ar = $.makeArray(obj);
                e.stopPropagation();
                var getLitindex= $(this).index('li');




                var searchTree1=($(this).find('a:first').text());

                var searchTree2=($(this).closest('li').parent().closest('li').find('a:first').text());
                var searchTree3=($(this).closest('li').parent().closest('li')
                    .closest('li').parent().closest('li')
                    .find('a:first').text());

                var searchTree4 = ($(this).closest('li').parent().closest('li')
                    .closest('li').parent().closest('li')
                    .closest('li').parent().closest('li')
                    .find('a:first').text());



                var searchTree = [searchTree1,searchTree2,searchTree3,searchTree4];

                search(searchTree);








                $(".div-right-form-list").find('a').css("background-color","white");
                $(this).find('a:first').css("background-color","#00b3ee");



            });






    $('input[type=checkbox]').on("change",function (e) {
        //alert("here");

        if(e.target != this){
            return;
        }
        if(e.target == $(this).parent()){
            return;
        }




        $(this).parent().parent().find('input:not(:first)').prop("checked",$(this).prop("checked"));

        //console.log($(this).parent().parent().not(":has('li')").parent().parent().html());

        console.log($(this).parent().parent().not(":has('li')").parent().parent().html());

        $(this).parent().parent().not(":has('li')").parent().parent().find('ul li').each(function(index){

                if($(this).find('input').prop("checked")==true){

                    console.log("get ==" +$(this).html());
                    $(this).parent().parent().find('input:first').prop("checked",true);
                    console.log("_>");
                    return false;
                }else{
                    $(this).parent().parent().find('input:first').prop("checked",false);
                }

                console.log('no'+$(this).html());
            //return true;


            });

            //.find('input:first').prop("checked",$(this).prop("checked"));



        //$(this).parent().parent().parent().parent().find('input:first').prop("checked",$(this).prop("checked"));
        //.attr("checked",true)


    });

    //$('li:has(ul) ')
    //    .click(function(event){
    //        if (this == event.target) {
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
    //
    //
    //$('li:not(:has(ul))').css({cursor:'pointer', 'list-style-image':'none'});

    //});

});





function search(searchTree){


//alert(searchTree);

    var returnData = '';

    $.ajax({
        type: "post",
        url: "/articles/searchDescription/",
        data : { 'search_tree' : searchTree},

        success: function (data) {
            //alert('success me==='+data);

            $(".div-right-description").html(data);

        },
        error: function () {
            alert('error file couldn\'t found');
        }
    });



return returnData;
}




function checkIfListNameExists(listName){


    var ret ="false";

    $.ajax({
        type: "get",
        url: "/articles/list_name_check/",
        data : { 'list_name' : listName},
        async: false,
        success: function (data) {

            //alert("|"+data+"|"+typeof(data));

            ret = data.toString();


        },
        error: function () {
            alert('Database connection error !!');
        }
    });


    if(ret == "false")
        return true;
    else
        return false;
}




function showOnlyList(){
    //$("#hidden_list input[type=submit]");
}



