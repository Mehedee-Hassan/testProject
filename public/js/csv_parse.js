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

            $('#__form_generated_name__').attr("value",listName);


            var postData = $(this).serializeArray();
            var formURL = $("#checboxlist-form").attr("action");

            //$(".button-submit").on("click",function () {
            var allVals = [];
            //$('input[type=checkbox]:checked').each(function () {
            //    allVals.push($(this).val());
            //});

            //alert(allVals + "===" + formURL);
            //});

        if(allVals != "" && (text != null || text == true)) {

            $(".div-right-form").html(allVals);

        }


    });

    $(".show-csv-button-section").on("click",".button-cancel",function(){
        $(".div-right-form-list input[type=checkbox]").prop('checked', false);
    });


    $("#button-data").on("click",function(){

        $(".div-right-form").html(fullHTML)
        location.reload();
    });

        //$("input[type='checkbox']").change(function(){
        //
        //   if(this.checked){
        //       alert(aa);
        //   }
        //    alert("checke");
        //});



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



                //alert(ar[0]);
                //}/
            });

    //$('.div-right-form-list').find('a').on("click",function (e) {
    //
    //    if(e.target != this) return;
    //        e.preventDefault();
    //
    //});







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



function search2(find,bigdata){
    var findDesCount = 0;
    var booleanflag = false;

    //alert("got == "+find);

    for(var i = 1 ; i < bigdata.length ; i++){


        booleanflag = false;

            //alert(bigdata[i][1]);
            //$(".div-right-description").html(bigdata[i][1]);



        if( bigdata[i][0] != '') {

            if(find == findDesCount){
                //alert("found ="+find+" "+findDesCount);

                $(".div-right-description").html(bigdata[i][1]);
            break;
            }
           findDesCount++;
        }


        if(bigdata[i][3] != '') {

            //alert("found =" + find + " " + findDesCount);
            if(find == findDesCount){

                //alert("found ="+find+" "+findDesCount);

                $(".div-right-description").html(bigdata[i][4]);
                break;
               }
            findDesCount++;
        }


        if(bigdata[i][6] != "") {

            if(find == findDesCount) {

                //alert("found =" + find + " " + findDesCount);

                $(".div-right-description").html(bigdata[i][7]);
            break;
            }


            findDesCount++;
        }

        if(bigdata[i][9] != "") {


            if(find == findDesCount) {

                //alert("found =" + find + " " + findDesCount);
                $(".div-right-description").html(bigdata[i][10]);
            break;
            }
            findDesCount++;
        }

        if(findDesCount == true){

        }
    }


}




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





function showOnlyList(){
    //$("#hidden_list input[type=submit]");
}






//
//
//
//
//
//
//
//
//
//
//
//function processData(data,wantTosearch){
//
//    var result = $.csv.toArrays(data);
//    var newObjectRes = $.toJSON($.csv.toObjects(data));
//
//    alert(newObjectRes);
//
//
//
//        //$("div-right-description").html("");
//        //$(".div-right-description").append(s);
//
//
//}
//
//function matchUntil(data,j){
//
//    for(var i = 0 ; i < data.lengh ; i ++){
//        for(var j = 0 ; j < dara[i].length ; j ++){
//
//        }
//    }
//
//
//}
//
//function searchIn(result){
//
//    //demo function
//    //todo need update
//
//
//    var sFor;
//
//    for(var i = 0 ; i < result.length ; i++) {
//
//        if(result[i][0] == sFor[0] &&
//            result[i][1] == sFor[1])
//        {
//            $("#right-description").html('');
//            $("#right-description").html(result[i][2]);
//        }
//
//    }
//
//
//
//}
//
//
//
//function makeList(result){
//    //todo
//    $("#result1").html();
//
//}
//
//
//function papaParseEx(data){
//
//        alert('true'+data);
//        var result = Papa.parse(data, {
//
//        });
//
//    alert(result.data);
//
//
//
//}