<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Input;
use Request;
use File;
use League\Csv\Reader;
use App;
use App\CustomClass\DatabaseHelper;
use App\CustomClass\HtmlGenerator;


class ArticleController extends Controller
{


    public function index()
    {
        return view('articles.create');
    }


    public function create()
    {
        return view('articles.create');
    }


    public function searchDescription()
    {
        $textData = array();


        $getData = Input::get('search_tree');




        $i = 0;

        foreach($getData as $data){
            if(!empty($data))
            $textData[$i++] = trim($data);
            else
                $textData[$i++] = "";
        }



        $retString = "";
        $ret="";

        if(!empty($textData[3])){
            $ret = App\CsvValue::select('work_activity_description')->where('industry_name',($textData[3]))
                ->where('trade_name',($textData[2]))->where('process_name',($textData[1]))
                ->where('work_activity_name',($textData[0]))->first();


            $retString = $ret['work_activity_description'];

        }
        else if(!empty($textData[2])){
            $ret = App\CsvValue::select('process_description')->where('industry_name',($textData[2]))
                ->where('trade_name',($textData[1]))->where('process_name',($textData[0]))
                ->first();


            $retString = $ret['process_description'];
        }
        else if(!empty($textData[1])){

            $ret = App\CsvValue::select('trade_description')->where('industry_name',($textData[1]))
                ->where('trade_name',($textData[0]))->first();
            $retString = $ret['trade_description'];
        }
        else if(!empty($textData[0])){

            $ret = App\CsvValue::select('industry_description')->where('industry_name',($textData[0]))
                ->first();

            $retString = $ret['industry_description'];
        }





    $retString = "<fieldset><legend>Description</legend>".$retString."</fieldset>";


        return $retString;
    }





    public function showListFromDBAjaxCall()
    {

        $listName = Input::get('list_name');


        $value = App\ProcessList::where('list_name', $listName)->distinct()->get(array('process'))->toArray();

        $generatedHtml = new App\CustomClass\HtmlGenerator();
        $html = $generatedHtml->htmlFromDatabaseFor_Test_RouteInArticleController($value);



        return $html;


    }


    public function listNameCheck(){

        $listNameForCheck = Input::get('list_name');
        $ifExists = App\ProcessList::select('list_name')->where('list_name',$listNameForCheck)->first();


        if(empty($ifExists)){

            return "true";
        }

        return "false";

    }



    public function listout()
    {



        $all = Input::all();

        $this->saveNewList($all);
        $html2 = $this->showListHtmlCreator($all);




        return view('articles.showList')->with('html2' , $html2);

    }


    public function saveNewList($all){
        $html = "";
        $booleanData = true;
        $if_the_first_one = true;


        $indexForOnlyCheckBox = 0;
        $totalDataElements = count($all) - 2;//for token and listname


        $listName = $all['__form_generated_name__'];
        $oldParent = "";

        foreach ($all as $key => $data) {

            $newList = new App\ProcessList();

            $getParent = explode('_', $key);



            if (!empty($getParent[1]))
            {
                $oldParent = $data;
            }
            else {

                $newList->process = $oldParent;
                $newList->work_activity = $data;
                $newList->list_name = $listName;
                $newList->save();
            }


            if (++$indexForOnlyCheckBox > $totalDataElements)
                break;


        }

    }



    public function showListHtmlCreator($all)
    {

        $getListNames =App\ProcessList::distinct()->get(array('list_name'))->toArray();

        $generatedHtml = new App\CustomClass\HtmlGenerator();
        $html2 = $generatedHtml->htmlFromDatabaseFor_listout_RouteInArticleController($getListNames);

    return $html2;
    }






    public function uploadFile()
    {


        if(Request::isMethod('post')) {

            $uploadedFile = Input::file('csvfile');
            $fileUploadPath = 'uploads/csv/';
            $tempUploadedFileName = 'tmp.csv';


            if ($uploadedFile->isValid() &&
                ($uploadedFile->getClientOriginalExtension() == 'CSV' ||
                    $uploadedFile->getClientOriginalExtension() == 'csv')
            ) {


                $uploadedFile->move($fileUploadPath, $tempUploadedFileName);


                $fullPath = $fileUploadPath . $tempUploadedFileName;

                $csvReader = Reader::createFromPath($fullPath);
                $getAllData = $csvReader->fetchAll();


                $databaseHelper = new App\CustomClass\DatabaseHelper();
                $getHtmlFromGenerator = new App\CustomClass\HtmlGenerator();


                $databaseHelper->saveCSVToDatabase($getAllData);



                $html5 = $getHtmlFromGenerator->htmlFromDatabaseForDataTab();

                return view('articles.show_data')->with('allCsvData', $html5);
            }
        }



        $html5 = $this->showOldDataList();
        return view('articles.show_data')->with('allCsvData', $html5);


    }


    public function showOldDataList()
    {
        $fileUploadPath = 'uploads/csv/';
        $tempUploadedFileName = 'tmp.csv';
        $fullPath = $fileUploadPath . $tempUploadedFileName;

        $getHtmlFromGenerator = new App\CustomClass\HtmlGenerator();


        $html5 = $getHtmlFromGenerator->htmlFromDatabaseForDataTab();

        return $html5;
    }



    


    public function showOnlyList()
    {


        $getListNames =App\ProcessList::distinct()->get(array('list_name'))->toArray();

        $generatedHtml = new App\CustomClass\HtmlGenerator();
        $html2 = $generatedHtml->htmlFromDatabaseFor_showOnlyList_RouteInArticleController($getListNames);




        return view('articles.showList')->with('html2' , $html2);

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