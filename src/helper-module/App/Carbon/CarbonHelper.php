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
     * @return string
     */
    public static function humanFullDateTimeNow(): string
    {
        return Carbon::now()->isoFormat(CarbonInterface::CARBON_FULL_HUMAN_DATE_FORMAT);
    }

    /**
     * parse date time
     * for human
     *
     * @param datetime $datetime
     * @param string $split
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
     * @param string $split
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
     * get date time by specific sub days from now
     * for database
     * default = 30 days
     *
     * @param integer $days
     * @return string
     */
    public static function dbGetFullDateSubDays(int $days = 30): string
    {
        return Carbon::now()->subDays($days);
    }

    /**
     * get date time by specific sub seconds from now
     * for database
     * default = 1 second
     *
     * @param integer $seconds
     * @return string
     */
    public static function dbGetFullDateSubSeconds(int $seconds = 1): string
    {
        return Carbon::now()->subSeconds($seconds);
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
