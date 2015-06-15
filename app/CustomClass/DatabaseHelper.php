<?php  namespace App\CustomClass;

/**
 * Created by PhpStorm.
 * User: Mhr
 * Date: 6/15/2015
 * Time: 12:22 AM
 */



use App;



class DatabaseHelper{
    public function saveCSVToDatabase($getAllData)
    {


        $itr = 1;

        for (; $itr < count($getAllData); $itr++) {


            $csvTableRow = new App\CsvValue();

            if (!empty($getAllData[$itr][0]))
                $csvTableRow->industry_name = trim($getAllData[$itr][0]);
            else
                $csvTableRow->industry_name = "";


            if (!empty($getAllData[$itr][1]))
                $csvTableRow->industry_description = trim($getAllData[$itr][1]);

            else
                $csvTableRow->industry_description = "";

            if (!empty($getAllData[$itr][2]))
                $csvTableRow->industry_tag = trim($getAllData[$itr][2]);
            else
                $csvTableRow->industry_tag = "";


            if (!empty($getAllData[$itr][3]))
                $csvTableRow->trade_name = trim($getAllData[$itr][3]);
            else
                $csvTableRow->trade_name = "";


            if (!empty($getAllData[$itr][4]))
                $csvTableRow->trade_description = trim($getAllData[$itr][4]);
            else
                $csvTableRow->trade_description = "";


            if (!empty($getAllData[$itr][5]))
                $csvTableRow->trade_tag = trim($getAllData[$itr][5]);
            else
                $csvTableRow->trade_tag = "";


            if (!empty($getAllData[$itr][6]))
                $csvTableRow->process_name = trim($getAllData[$itr][6]);
            else
                $csvTableRow->process_name = "";


            if (!empty($getAllData[$itr][7]))
                $csvTableRow->process_description = trim($getAllData[$itr][7]);
            else
                $csvTableRow->process_description = "";


            if (!empty($getAllData[$itr][8]))
                $csvTableRow->process_tag = trim($getAllData[$itr][8]);
            else
                $csvTableRow->process_tag = "";

            if (!empty($getAllData[$itr][9]))
                $csvTableRow->work_activity_name = trim($getAllData[$itr][9]);
            else
                $csvTableRow->work_activity_name = "";


            if (!empty($getAllData[$itr][10]))
                $csvTableRow->work_activity_description = trim($getAllData[$itr][10]);
            else
                $csvTableRow->work_activity_description = "";

            if (!empty($getAllData[$itr][11]))
                $csvTableRow->work_activity_tag = trim($getAllData[$itr][11]);
            else
                $csvTableRow->work_activity_tag = "";


            $csvTableRow->save();

        }


    }




    }