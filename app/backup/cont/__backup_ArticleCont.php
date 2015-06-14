<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Input;
use Request;
use File;
use League\Csv\Reader;
use App;


class ArticleController extends Controller {


    public function index(){
        return view('articles.create');
    }


    public function create(){
        return view('articles.create');
    }


    public function test1(){
        //todo delete

    }

    //todo rename
    public function test(){

        $listName = Input::get('list_name');


        $value = App\ProcessList::where('list_name',$listName)->distinct()->get(array('process'))->toArray();

        $html ="";

        // echo "list =====".$listName."||";
        foreach($value as $k => $v){

            echo($v['process']);

            $subList ="";
            $colls = App\ProcessList::where('process',$v['process'])->distinct()->get(array('work_activity'))->toArray();

            $html .="<li class='list-arrow'>".$v['process']."<ul>";
            foreach($colls as $coll){

//                var_dump($coll['work_activity']);
                $html .= "<li>".$coll['work_activity']."</li>";

            }
            $html .="</ul></li>";

        }
//        $value = $table->find('process')->where('list_name',$listName);
//$value = "asd";

        return "test data = ".$html;



    }


    public function listout(){

        $all = Input::all();
//        var_dump($all);


        $html = "";
        $booleanData = true;
        $if_the_first_one = true;


        $indexForOnlyCheckBox = 0;
        $totalDataElements = count($all) - 2;//for token and listname



        $listName = $all['__form_generated_name__'];



        foreach($all as $key => $data){

            $newList = new App\ProcessList();

            $getParent = explode('_',$key);

            //$oldParent = "";


            if(!empty($getParent[1])){


                //database interaction
                    $oldParent = $data;
                //====================

                if($if_the_first_one == true){

                    $if_the_first_one = false;
                }
                else{
                    $html .= "</ul></li>";
                }

                $html .= "<li>$data<ul>";
                $getParent =false;
                }
                else{

                    if($booleanData ==false){
                        $html .= "</ul>";
                        $getParent = true;
                    }



                //database interaction
                    $newList->process = $oldParent;
                    $newList->work_activity = $data;
                //====================

                $html .= "<li>$data</li>";


                    $newList->list_name = $listName;

//todo open save
//                    $newList->save();
             }



            if(++$indexForOnlyCheckBox > $totalDataElements)
                break;



        }



        echo $html;
        echo "here is list= ".$listName;



        $sendData = App\ProcessList::all()->toArray();





        //experi=========================
        $listName = 'abc';
        $value = App\ProcessList::where('list_name','cde')->distinct()->get(array('process'))->toArray();

        $html ="";

       // echo "list =====".$listName."||";
        foreach($value as $k => $v){

            echo($v['process']);

            $subList ="";
                $colls = App\ProcessList::where('process',$v['process'])->distinct()->get(array('work_activity'))->toArray();

            $html .="<li>".$v['process']."<ul>";
                foreach($colls as $coll){

//                    var_dump($coll['work_activity']);
                    $html .= "<li>".$coll['work_activity']."</li>";

                }
            $html .="</ul></li>";

        }
        //====================================



//        var_dump($html);


        //todo make final //code experiment

        $getListNames = App\ProcessList::distinct()->get(array('list_name'))->toArray();


        $html2 ="<ul>";

        foreach($getListNames as $listName){
            $html2 .= "<li>".$listName['list_name']."</li>";
        }

        $html2 .= "</ul>";


//        var_dump("080382==============".$html2);



        return view('articles.showList')->with(['data'=>$sendData ,'html2'=> $html2]);
//        return view('articles.list');
    }









    public function uploadFile()
    {

//        $allInput = Request::get('title');


//        $getFile = Request::get('csvfile');

        $uploadedFile = Input::file('csvfile');
        $fileUploadPath = 'uploads/csv/';
        $tempUploadedFileName = 'tmp.csv';


        if($uploadedFile->isValid() &&
            ($uploadedFile->getClientOriginalExtension() == 'CSV'||
                $uploadedFile->getClientOriginalExtension() == 'csv')) {


            $uploadedFile->move($fileUploadPath , $tempUploadedFileName);




            $fileInfo['extension'] = $uploadedFile->getClientOriginalExtension();
            $fileInfo['name'] = $uploadedFile->getFilename();
            $fileInfo['size'] = $uploadedFile->getClientSize();
            $fileInfo['path'] = $uploadedFile;


//            echo 'Title :'.$allInput.'\n';

            $fullPath = $fileUploadPath.$tempUploadedFileName;

            $csvReader = Reader::createFromPath($fullPath);
            $getAllData = $csvReader->fetchAll();

            $csvTwoDArray = $getAllData;

            //saving to database
//            saveCSVToHtml($getAllData);
//            htmlFromDatabase();

            //todo edit ===============

            var_dump($csvTwoDArray);

            foreach($csvTwoDArray as $csvRow){


                $csvTableRow = new App\CsvValue();

                if(!empty($csvRow[0]))
                $csvTableRow->industry_name = $csvRow[0];
                else
                    $csvTableRow->industry_name = "";



                if(!empty($csvRow[1]))
                $csvTableRow->industry_description = $csvRow[1];

                else
                    $csvTableRow->industry_description = "";

                if(!empty($csvRow[2]))
                $csvTableRow->industry_tag =$csvRow[2];
                else
                    $csvTableRow->industry_tag ="";


                if(!empty($csvRow[3]))
                $csvTableRow->trade_name =$csvRow[3];
                else
                $csvTableRow->trade_name ="";



                if(!empty($csvRow[4]))
                $csvTableRow->trade_description =$csvRow[4];
                else
                    $csvTableRow->trade_description ="";


                if(!empty($csvRow[5]))
                $csvTableRow->trade_tag =$csvRow[5];
                else
                    $csvTableRow->trade_tag ="";


                if(!empty($csvRow[6]))
                $csvTableRow->process_name =$csvRow[6];
                else
                    $csvTableRow->process_name ="";


                if(!empty($csvRow[7]))
                $csvTableRow->process_description =$csvRow[7];
                else
                    $csvTableRow->process_description ="";


                if(!empty($csvRow[8]))
                $csvTableRow->process_tag =$csvRow[8];
                else
                    $csvTableRow->process_tag ="";

                if(!empty($csvRow[9]))
                $csvTableRow->work_activity_name =$csvRow[9];
                else
                    $csvTableRow->work_activity_name ="";


                if(!empty($csvRow[10]))
                $csvTableRow->work_activity_description =$csvRow[10];
                else
                    $csvTableRow->work_activity_description ="";

                if(!empty($csvRow[11]))
                    $csvTableRow->work_activity_tag =$csvRow[11];
                   else
                       $csvTableRow->work_activity_tag ="";


                $csvTableRow->save();

            }


            $html5 = "";

            $industryCol = App\CsvValue::select('industry_name')->distinct()->get()->toArray();
//        $tradeCol = App\CsvValue::select('trade_name')->distinct()->get()->toArray();
//        $processCol = App\CsvValue::select('process_name')->distinct()->get()->toArray();
//        $workCol = App\CsvValue::select('work_activity_name')->distinct()->get()->toArray();


            foreach($industryCol as $industry){

                $tradeCol = App\CsvValue::select('trade_name')
                    ->where('industry_name',$industry['industry_name'])->distinct()->get()->toArray();


                $html5 .="<li>".$industry['industry_name']."<ul>";

                foreach($tradeCol as $trade){
                    $processCol = App\CsvValue::select('process_name')
                        ->where('trade_name',$trade['trade_name'])->distinct()->get()->toArray();

                    $html5 .="<li>".$trade['trade_name']."<ul>";
                    foreach($processCol as $process){
                        $workCol = App\CsvValue::select('work_activity_name')
                            ->where('process_name',$process['process_name'])->distinct()->get()->toArray();

                        $html5 .="<li>".$process['process_name']."<ul>";
                        foreach($workCol as $work){
                            $html5 .= "<li>".$work['work_activity_name']."</li>";
                        }
                        $html5 .="</ul></li>";

                    }
                    $html5 .="</ul></li>";


                }
                $html5 .="</ul></li>";



            }





            var_dump("csv from database =---- ".$html5);
            //todo edit end============

            //===================

            $tagClodes1 = false ;
            $tagClodes2 = false ;
            $tagClodes3 = false ;
            $tagClodes4 = false ;

//            var_dump($getAllData);

            $inputCheckBoxName = 0;

            $html = "<ul>";
//            for($i = 0; $i< count($getAllData); $i++) {

                for ($j = 1; $j < count($getAllData); $j++) {
//                    $html .= "<li class='li-style-li'>";
                    if (empty($getAllData[$j][0])) {

                        if (empty($getAllData[$j][3])) {


                            if (empty($getAllData[$j][6])) {

                                if (!empty($getAllData[$j][9]))
                                    $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."' type='checkbox' value='".$getAllData[$j][9]."'/>"
                                                        . $getAllData[$j][9] . "</a></li>";


                            } else {
                                $html .= "</ul></li>";
                                $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."_parent' type='checkbox' value='".$getAllData[$j][6]."'/>"
                                    .$getAllData[$j][6]."</a>";

                                if (empty($getAllData[$j][9])) {

                                } else {
                                    $html .= '<ul>';
                                    $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."' type='checkbox' value='".$getAllData[$j][9]."'/>"
                                        . $getAllData[$j][9] . "</a></li>";
                                }
                            }


//                            $html .= "<li>" . $getAllData[$j][2] . "</li>";

                        } else {
                            $html .= "</ul></li></ul></li>";
                            $html .= "<li><a href='#'>" . $getAllData[$j][3]."</a>";

                            if (empty($getAllData[$j][6])) {

                            } else {
                                $html .= '<ul>';
                                $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."_parent' type='checkbox' value='".$getAllData[$j][6]."'/>"
                                    .$getAllData[$j][6]."</a>";
                                }

                            if (empty($getAllData[$j][9])) {

                            } else {
                                $html .= '<ul>';
                                $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."' type='checkbox' value='".$getAllData[$j][9]."'/>"
                                    . $getAllData[$j][9]."</a>";
                            }


                            }
                        }
                     else {

                        //new if 0 not empty close tags
                         //todo change logic to if($j != 0)

                         if (!empty($getAllData[$j][0])) {

//old logic

                             if($j != 1)
                                 $html .= "</ul></li></ul></li></ul></li>";

                             $html .= "<li><a href='#'>".$getAllData[$j][0]."</a>";//=> <li>L


                         }
                         //todo end ========


                         if (empty($getAllData[$j][3])) {//0 not emp so 1 is not emp

//                             $html .= "<li>" . $getAllData[$j][2] . "</li>";


                         } else {
                             if (empty($getAllData[$j][0])) {
                                 $html .= "</ul></li>";
                             }
                             else if (!empty($getAllData[$j][0]))//ul deleted
                                $html .= "<ul><li><a href='#'>" . $getAllData[$j][3]."</a>";

                             if (empty($getAllData[$j][6])) {

                             } else {


                                 $html .= '<ul>';
                                 $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."_parent' type='checkbox' value='".$getAllData[$j][6]."'/>"
                                     . $getAllData[$j][6]."</a>";
                             }
                             if (empty($getAllData[$j][9])) {

                             } else {


                                 $html .= '<ul>';
                                 $html .= "<li><a href='#'><input name='".$inputCheckBoxName++."' type='checkbox' value='".$getAllData[$j][9]."'/>"
                                     . $getAllData[$j][9]."</a></li>";
                             }


                         }


                         //=================================

                       //old

                    }

                }


//                $html .="<input type='submit' class='button-submit-one' value='up'/>";

                }
//            $html .= "</ul>";
//            }

//            echo "here======";
//
//                    var_dump($html);
//            echo "here======";

            $html.="</ul>";


//            var_dump($html);
            return view('articles.show_csv_options')->with('allCsvData',$html);
            }






    public function htmlFromDatabase(){

        $html5 = "";

        $industryCol = App\CsvValue::select('industry_name')->distinct()->get()->toArray();
//        $tradeCol = App\CsvValue::select('trade_name')->distinct()->get()->toArray();
//        $processCol = App\CsvValue::select('process_name')->distinct()->get()->toArray();
//        $workCol = App\CsvValue::select('work_activity_name')->distinct()->get()->toArray();


        foreach($industryCol as $industry){

            $tradeCol = App\CsvValue::select('trade_name')
                ->where('industry_name',$industry['industry_name'])->distinct()->get()->toArray();


            $html5 .="<li>".$industry['industry_name']."<ul>";

            foreach($tradeCol as $trade){
                $processCol = App\CsvValue::select('process_name')
                    ->where('trade_name',$trade['trade_name'])->distinct()->get()->toArray();

                $html5 .="<li>".$trade['trade_name']."<ul>";
                foreach($processCol as $process){
                    $workCol = App\CsvValue::select('work_activity_name')
                        ->where('process_name',$process['process_name'])->distinct()->get()->toArray();

                    $html5 .="<li>".$process['process_name']."<ul>";
                    foreach($workCol as $work){
                        $html5 .= "<li>".$work['work_activity_name']."</li>";
                    }
                    $html5 .="</ul></li>";

                }
                $html5 .="</ul></li>";


            }
            $html5 .="</ul></li>";



        }





        var_dump("csv from database =---- ".$html);
//        return $html;
    }






    public function saveCSVToHtml($csvTwoDArray){


        foreach($csvTwoDArray as $csvRow){


            $csvTableRow = new App\CsvValue();

            $csvTableRow->industry_name = $csvRow[0];
            $csvTableRow->industry_description = $csvRow[1];
            $csvTableRow->industry_tag =$csvRow[2];
            $csvTableRow->trade_name =$csvRow[3];
            $csvTableRow->trade_description =$csvRow[4];
            $csvTableRow->trade_tag =$csvRow[5];
            $csvTableRow->process_name =$csvRow[6];
            $csvTableRow->process_description =$csvRow[7];
            $csvTableRow->process_tag =$csvRow[8];
            $csvTableRow->work_activity_name =$csvRow[9];
            $csvTableRow->work_activity_description =$csvRow[10];

            if(!empty($csvRow[11]))
                $csvTableRow->work_activity_tag =$csvRow[11];


            $csvTableRow-save();

        }






//        $table->increments('id');
//        $table->text('industry_name');
//        $table->text('industry_description');
//        $table->text('industry_tag')->nullable();
//        $table->text('trade_name');
//        $table->text('trade_description');
//        $table->text('trade_tag')->nullable();
//        $table->text('process_name');
//        $table->text('process_description');
//        $table->text('process_tag')->nullable();
//        $table->text('work_activity_name');
//        $table->text('work_activity_description');
//        $table->text('work_activity_tag')->nullable();
//        $table->timestamps();


    }
    
    
    
    
    }















































//dummy test;

//    public function about(){
//        // return 'about page';
//
//        $name = "Mehedee <span style=\'color:red\'>Hassan</span>";
//
//        return view('pages.about')->with('name',$name);
//    }
//
//
//
//
//
//    public function contact(){
//
//        // $names = ['mehedee','raif','hafsa'];
//        $names = [];
//
//        return view('pages.contact')->with('names',$names);
//
//
//    }


//
//for ($j = 0; $j < count($getAllData); $j++) {
//    $html .= "<li>";
//    if(empty($getAllData[$j][0])) {
//        if(!empty($getAllData[$j-1][0]) && $j != 0){
//            $html .="<ul>";
//        }
//        if(empty($getAllData[$j][1])){
//            if(empty($getAllData[$j][2])){
//                if(!empty($getAllData[$j][3]))
//                    $html.= $html."<div id='3'>".$getAllData[$j][3]."</div>";
//            }else{
//                for($k = 2; $k< count($getAllData[$j]); $k++) {
//                    $html.="<div id='2$k'>".$getAllData[$j][$k]."</div>";
//                }
//            }
//
//        }
//        else{
//            for($k = 1; $k< count($getAllData[$j]); $k++) {
//                $html.="<div id='1$k'>".$getAllData[$j][$k]."</div>";
//            }
//        }
//        $html.="</li>";
//    }
//    else {
//        $html.="</li>";
//    }
//}



////old
//if (empty($getAllData[$j][1])) {
//    $html .= "<ul>";
//
//    if (empty($getAllData[$j][1]))
//        $html .= "<li>" . $getAllData[$j][2] . "</li>";
//    else break;
//
//
//    $html .= "</ul>";
//
//} else if (!empty($getAllData[$j][0])) {
//    $html .= "";//</ul></li>
//} else {
//    //todo
//    $html .= '<ul>';
//    $html .= '<li>' . $getAllData[$j][2];
//}
//
//
//if (empty($getAllData[$j][2])) {
//
//} else {
//    //todo
//    $html .= '<ul>';
//
////                        for($k = $j ; $k < $getAllData ; $k++)
//    {
//        if (empty($getAllData[$j][1]))
//            $html .= "<li>" . $getAllData[$j][2] . "</li>";
//        else {
//            $tagclosed4 = true;
//            $html .= '</ul></li>';
//
////                                break;
//        }
//    }


//old logic


//                             if (empty($getAllData[$j - 1][1]) && $j != 0) {
//                                 $html .= "</ul></li>";
//                             }
//                             else if(!empty($getAllData[$j - 1][1]) && $j != 0) {
//                                 $html .= "</ul></li>";
//                             }
//                             if (empty($getAllData[$j - 1][0]) && $j != 0) {
//                                 $html .= "</ul></li>";
//                             }
//                             else if (!empty($getAllData[$j - 1][0]) && $j != 0){
//                                 $html .= "</ul></li>";
//                             }

?>