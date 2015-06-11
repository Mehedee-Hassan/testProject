
$(window).load(function(){

var bigData;

    $.ajax({
        type: "GET",
        url: "/uploads/csv/tmp.csv",
        dataType: "text",
        success: function(data) {
            //alert('success');

            bigData = $.csv.toArrays(data);
            search(0,bigData);
            //alert(bigData);
            //papaParseEx(data);
            //processData(data,false);


        },
        error: function(){
            alert('error file couldn\'t found');
        }
    });




var  fullHTML =  $(".div-right-form").html();



//==ajax form submit
    $(".button-submit").on("click",function(e)
    {
        e.preventDefault();

        var text = prompt("Name:", "");


            var postData = $(this).serializeArray();
            var formURL = $("#checboxlist-form").attr("action");

            //$(".button-submit").on("click",function () {
            var allVals = [];
            $('input[type=checkbox]:checked').each(function () {
                allVals.push($(this).val());
            });

            alert(allVals + "===" + formURL);
            //});

        if(allVals != "" && (text != null || text == true)) {

            $(".div-right-form").html(allVals);

        }


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

                //$(this).hover(function() {
                //    $(this).css("color","blue")
                //});
                //$(this).children(".children").toggle();
//                alert (getLitindex);

                search(getLitindex,bigData);


                //alert(ar[0]);
                //}/
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



function search(find,bigdata){
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