<?php

namespace TheBachtiarz\Toolkit\Helper\App\Carbon;

use Illuminate\Support\Carbon;
use TheBachtiarz\Toolkit\Helper\App\Interfaces\CarbonInterface;

trait CarbonHelper
{
    // ? Date Format
    /**
     * get full date time now
     * for human
     *
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function humanFullDateTimeNow($dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))
            ->setTimezone(tbtoolkitconfig('app_timezone'))
            ->isoFormat(CarbonInterface::CARBON_FULL_HUMAN_DATE_FORMAT);
    }

    /**
     * get date time now in timezone
     *
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbDateTimeNowTimezone($dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->setTimezone(tbtoolkitconfig('app_timezone'));
    }

    /**
     * parse date time
     * for human
     *
     * @param datetime $datetime
     * @param string $split split only: date or time
     * @return string
     */
    public static function humanDateTime($datetime, string $split = ''): string
    {
        $datetime = Carbon::parse($datetime);

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_HUMAN_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_HUMAN_SIMPLE_DATE_FORMAT);
    }

    /**
     * parse date time
     * for database
     *
     * @param datetime $datetime
     * @param string $split split only: date or time
     * @return string
     */
    public static function dbDateTime($datetime, string $split = ''): string
    {
        $datetime = Carbon::parse($datetime);

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_DB_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_DB_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_DB_SIMPLE_DATE_FORMAT);
    }

    /**
     * get interval date created from date updated
     *
     * @param datetime $date_created
     * @param datetime $date_updated
     * @return string
     */
    public static function humanIntervalCreateUpdate($date_created, $date_updated): string
    {
        return self::anyConvDateToTimestamp($date_updated) > self::anyConvDateToTimestamp($date_created) ? self::humanIntervalDateTime($date_updated) : '-';
    }

    /**
     * convert date time to timestamp
     *
     * @param datetime $datetime
     * @return string
     */
    public static function anyConvDateToTimestamp($datetime): string
    {
        return Carbon::parse($datetime)->timestamp;
    }

    /**
     * convert date time to interval time from now
     * for Human
     *
     * @param datetime $datetime
     * @return string
     */
    public static function humanIntervalDateTime($datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }

    /**
     * get date time by specific add years from now
     * for database
     *
     * @param integer $years default: 1 year
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddYears(int $years = 1, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addYears($years);
    }

    /**
     * get date time by specific add months from now
     * for database
     *
     * @param integer $months default: 6 months
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddMonths(int $months = 6, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addMonths($months);
    }

    /**
     * get date time by specific add weeks from now
     * for database
     *
     * @param integer $weeks default: 1 week
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddWeeks(int $weeks = 1, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addWeeks($weeks);
    }

    /**
     * get date time by specific add days from now
     * for database
     *
     * @param integer $days default: 30 days
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddDays(int $days = 30, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addDays($days);
    }

    /**
     * get date time by specific add hours from now
     * for database
     *
     * @param integer $hours default: 24 hours
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddHours(int $hours = 24, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addHours($hours);
    }

    /**
     * get date time by specific add minutes from now
     * for database
     *
     * @param integer $minutes default: 60 minutes
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddMinutes(int $minutes = 60, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addMinutes($minutes);
    }

    /**
     * get date time by specific add seconds from now
     * for database
     *
     * @param integer $seconds default: 60 seconds
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateAddSeconds(int $seconds = 60, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addSeconds($seconds);
    }

    /**
     * get date time by specific sub years from now
     * for database
     *
     * @param integer $years default: 1 year
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubYears(int $years = 1, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subYears($years);
    }

    /**
     * get date time by specific sub months from now
     * for database
     *
     * @param integer $months default: 6 months
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubMonths(int $months = 6, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subMonths($months);
    }

    /**
     * get date time by specific sub weeks from now
     * for database
     *
     * @param integer $weeks default: 1 week
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubWeeks(int $weeks = 1, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subWeeks($weeks);
    }

    /**
     * get date time by specific sub days from now
     * for database
     *
     * @param integer $days default: 30 days
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubDays(int $days = 30, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subDays($days);
    }

    /**
     * get date time by specific sub hours from now
     * for database
     *
     * @param integer $hours default: 24 hours
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubHours(int $hours = 24, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subHours($hours);
    }

    /**
     * get date time by specific sub minutes from now
     * for database
     *
     * @param integer $minutes default: 60 minutes
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubMinutes(int $minutes = 60, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subMinutes($minutes);
    }

    /**
     * get date time by specific sub seconds from now
     * for database
     *
     * @param integer $seconds default: 60 seconds
     * @param datetime $dateStart default: now()
     * @return string
     */
    public static function dbGetFullDateSubSeconds(int $seconds = 60, $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subSeconds($seconds);
    }
    // ? End of Date Format

    // ? Person
    /**
     * convert date time to person age
     *
     * @param datetime $datetime
     * @return string
     */
    public static function humanGetPersonAge($datetime): string
    {
        return Carbon::parse($datetime)->age;
    }

    /**
     * convert date time to person born date full
     *
     * @param datetime $datetime
     * @return array
     */
    public static function humanGetPersonBornDateFull($datetime): array
    {
        $born = Carbon::parse($datetime);

        $date = $born->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        $age = (string) $born->age;

        return compact(['date', 'age']);
    }

    /**
     * check is person birthday today
     *
     * @param datetime $datetime
     * @return boolean
     */
    public static function isPersonBirthdayToday($datetime): bool
    {
        $born = Carbon::parse($datetime);

        return $born->isBirthday();
    }
    // ? End of Person
}
