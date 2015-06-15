<?php  namespace App\CustomClass;
/**
 * Created by PhpStorm.
 * User: Mhr
 * Date: 6/15/2015
 * Time: 2:09 PM
 */


use App;

class HtmlGenerator{






    public function htmlFromDatabaseForDataTab()
    {

        $html5 = "<ul>";
        $inputCheckBoxName = 0;

        $industryCol = App\CsvValue::select('industry_name')->distinct()->get()->toArray();

        foreach ($industryCol as $industry) {

            $tradeCol = App\CsvValue::select('trade_name')
                ->where('industry_name', $industry['industry_name'])->distinct()->get()->toArray();


            $html5 .= "<li><a href='#div-right-descriptio'>" . $industry['industry_name'] . "</a><ul>";

            foreach ($tradeCol as $trade) {
                $processCol = App\CsvValue::select('process_name')
                    ->where('industry_name', $industry['industry_name'])
                    ->where('trade_name', $trade['trade_name'])
                    ->distinct()->get()->toArray();

                $html5 .= "<li><a href='#div-right-descriptio'>" . $trade['trade_name'] . "</a><ul>";
                foreach ($processCol as $process) {
                    $workCol = App\CsvValue::select('work_activity_name')
                        ->where('industry_name', $industry['industry_name'])
                        ->where('trade_name', $trade['trade_name'])
                        ->where('process_name', $process['process_name'])
                        ->distinct()->get()->toArray();

                    $html5 .= "<li><a href='#div-right-descriptio'><input name='" . $inputCheckBoxName++ . "_parent' type='checkbox' value='"
                        . $process['process_name'] . "'>" . $process['process_name'] . "</a><ul>";

                    foreach ($workCol as $work) {
                        $html5 .= "<li><a href='#div-right-descriptio'><input name='" . $inputCheckBoxName++ . "' type='checkbox' value='"
                            . $work['work_activity_name'] . "'/>" . $work['work_activity_name'] . "</a></li>";
                    }
                    $html5 .= "</ul></li>";

                }
                $html5 .= "</ul></li>";


            }
            $html5 .= "</ul></li>";


        }
        $html5 .= "</ul>";

        return $html5;
    }




    public function htmlFromDatabaseFor_Test_RouteInArticleController($value){
        $html = "";

        foreach ($value as $k => $v) {

            $colls = App\ProcessList::where('process', $v['process'])->distinct()->get(array('work_activity'))->toArray();

            $html .= "<li class='list-arrow'>" . $v['process'] . "<ul>";
            foreach ($colls as $coll) {

                $html .= "<li>" . $coll['work_activity'] . "</li>";

            }
            $html .= "</ul></li>";

        }
    return $html;
    }



    public function htmlFromDatabaseFor_listout_RouteInArticleController($getListNames){
        $html2 = "<ul>";

        foreach ($getListNames as $listName) {
            $html2 .= "<li>" . $listName['list_name'] . "</li>";
        }

        $html2 .= "</ul>";

    return $html2;
    }


    public function htmlFromDatabaseFor_showOnlyList_RouteInArticleController($getListNames){
        $html2 = "<ul>";

        foreach ($getListNames as $listName) {
            $html2 .= "<li>" . $listName['list_name'] . "</li>";
        }

        $html2 .= "</ul>";
        return $html2;
    }

}