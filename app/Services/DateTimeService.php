<?php
/**
 * Created by PhpStorm.
 * User: 김대훈
 * Date: 2018-09-07
 * Time: 오전 8:46
 */

namespace App\Services;


use DateTime;

/**
 * Class DateTimeService
 * @package App\Service
 *
 * @method string getDateTime()
 * @method string getYear()
 * @method string getMonth()
 * @method string getDay()
 * @method string getHour()
 * @method string getMinute()
 * @method string getSecond()
 */
class DateTimeService
{
    use \GetSetGo\SetterGetter;

    const DATE_TIME_FORMAT = 'Y-m-d H:i:s';
    /**
     * @var DateTime
     * @setter false
     */
    protected $dateTime;

    /**
     * @var string
     * @setter false
     */
    protected $year;

    /**
     * @var string
     * @setter false
     */
    protected $month;

    /**
     * @var string
     * @setter false
     */
    protected $day;

    /**
     * @var string
     * @setter false
     */
    protected $hour;

    /**
     * @var string
     * @setter false
     */
    protected $minute;

    /**
     * @var string
     * @setter false
     */
    protected $second;

    /**
     * @param string $timeString
     * @return DateTimeService
     */
    public function init(string $timeString = ''): DateTimeService
    {
        if (empty($timeString))
            $timeString = 'now';
        $this->dateTime = new DateTime($timeString, new \DateTimeZone("Asia/Seoul"));
        $this->year = $this->dateTime->format('Y');
        $this->month = $this->dateTime->format('n'); // leading zeros : m
        $this->day = $this->dateTime->format('j'); // leading zeros : d

        $this->hour = $this->dateTime->format('H');
        $this->minute = $this->dateTime->format('i');
        $this->second = $this->dateTime->format('s');

        return $this;
    }

    /**
     * @param string $format
     * @return string
     */
    public function toString(string $format = ''): string
    {
        if (empty($format))
            $format = self::DATE_TIME_FORMAT;
        return $this->dateTime->format($format);
    }
}