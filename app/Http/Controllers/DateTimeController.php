<?php
/**
 * Created by PhpStorm.
 * User: 김대훈
 * Date: 2018-09-07
 * Time: 오후 12:51
 */

namespace App\Http\Controllers;


use App\Services\DateTimeService;

class DateTimeController extends Controller
{
    public function getMonth()
    {
        $dateTimeService = new DateTimeService();
        $month = $dateTimeService->init()->getMonth();
        $data = array(
            'month' => $month
        );
        return $this->toJson($data);
    }
}