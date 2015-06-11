<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Input;
use Request;
use File;
use League\Csv\Reader;


class ArticleController extends Controller {


    public function index(){
        return view('articles.create');
    }


    public function create(){
        return view('articles.create');
    }


    public function listout(){

        $all = Input::all();
//        var_dump($all);

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

            $tagClodes1 = false ;
            $tagClodes2 = false ;
            $tagClodes3 = false ;
            $tagClodes4 = false ;

//            var_dump($getAllData);

            $html = "<ul>";
//            for($i = 0; $i< count($getAllData); $i++) {

                for ($j = 1; $j < count($getAllData); $j++) {
//                    $html .= "<li class='li-style-li'>";
                    if (empty($getAllData[$j][0])) {

                        if (empty($getAllData[$j][3])) {


                            if (empty($getAllData[$j][6])) {

                                if (!empty($getAllData[$j][9]))
                                    $html .= "<li><input type='checkbox' value='".$getAllData[$j][9]."'/>"
                                                        . $getAllData[$j][9] . "</li>";


                            } else {
                                $html .= "</ul></li>";
                                $html .= "<li><input type='checkbox' value='".$getAllData[$j][6]."'/>"
                                    .$getAllData[$j][6];

                                if (empty($getAllData[$j][9])) {

                                } else {
                                    $html .= '<ul>';
                                    $html .= "<li><input type='checkbox' value='".$getAllData[$j][9]."'/>"
                                        . $getAllData[$j][9] . "</li>";
                                }
                            }


//                            $html .= "<li>" . $getAllData[$j][2] . "</li>";

                        } else {
                            $html .= "</ul></li></ul></li>";
                            $html .= "<li>" . $getAllData[$j][3];

                            if (empty($getAllData[$j][6])) {

                            } else {
                                $html .= '<ul>';
                                $html .= "<li><input type='checkbox' value='".$getAllData[$j][6]."'/>"
                                    .$getAllData[$j][6];
                                }

                            if (empty($getAllData[$j][9])) {

                            } else {
                                $html .= '<ul>';
                                $html .= "<li><input type='checkbox' value='".$getAllData[$j][9]."'/>"
                                    . $getAllData[$j][9];
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

                             $html .= "<li>".$getAllData[$j][0];//=> <li>L


                         }
                         //todo end ========


                         if (empty($getAllData[$j][3])) {//0 not emp so 1 is not emp

//                             $html .= "<li>" . $getAllData[$j][2] . "</li>";


                         } else {
                             if (empty($getAllData[$j][0])) {
                                 $html .= "</ul></li>";
                             }
                             else if (!empty($getAllData[$j][0]))//ul deleted
                                $html .= "<ul><li>" . $getAllData[$j][3];

                             if (empty($getAllData[$j][6])) {

                             } else {


                                 $html .= '<ul>';
                                 $html .= "<li><input type='checkbox' value='".$getAllData[$j][6]."'/>"
                                     . $getAllData[$j][6];
                             }
                             if (empty($getAllData[$j][9])) {

                             } else {


                                 $html .= '<ul>';
                                 $html .= "<li><input type='checkbox' value='".$getAllData[$j][9]."'/>"
                                     . $getAllData[$j][9]."</li>";
                             }


                         }


                         //=================================

                       //old

                    }

                }
                }
//            $html .= "</ul>";
//            }

//            echo "here======";
//
//                    var_dump($html);
//            echo "here======";
            return view('articles.show_csv_options')->with('allCsvData',$html);
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