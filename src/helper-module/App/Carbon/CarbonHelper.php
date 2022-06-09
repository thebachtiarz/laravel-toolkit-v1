<?php

namespace TheBachtiarz\Toolkit\Helper\App\Carbon;

use Illuminate\Support\Carbon;
use TheBachtiarz\Toolkit\Helper\App\Interfaces\CarbonInterface;

trait CarbonHelper
{
    // ? Date Format
    /**
     * Init new self carbon.
     * For customize the carbon it self.
     *
     * @return Carbon
     */
    private static function Carbon(): Carbon
    {
        return new Carbon;
    }

    /**
     * Get full date time now.
     * For human.
     *
     * @param string $dateStart default: now()
     * @return string
     */
    private static function humanFullDateTimeNow(string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))
            ->setTimezone(tbtoolkitconfig('app_timezone'))
            ->isoFormat(CarbonInterface::CARBON_FULL_HUMAN_DATE_FORMAT);
    }

    /**
     * Get date time now in timezone
     *
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbDateTimeNowTimezone(string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->setTimezone(tbtoolkitconfig('app_timezone'));
    }

    /**
     * Parse date time.
     * For human.
     *
     * @param string $datetime default: now()
     * @param string $split split only: date or time
     * @return string
     */
    private static function humanDateTime(string $datetime = "", string $split = ''): string
    {
        $datetime = Carbon::parse($datetime);

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_HUMAN_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_HUMAN_SIMPLE_DATE_FORMAT);
    }

    /**
     * Parse date time.
     * For database.
     *
     * @param string $datetime default: now()
     * @param string $split split only: date or time
     * @return string
     */
    private static function dbDateTime(string $datetime = "", string $split = ''): string
    {
        $datetime = Carbon::parse($datetime);

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_DB_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_DB_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_DB_SIMPLE_DATE_FORMAT);
    }

    /**
     * Get interval date created from date updated
     *
     * @param string $date_created
     * @param string $date_updated
     * @return string
     */
    private static function humanIntervalCreateUpdate(string $date_created, string $date_updated): string
    {
        return self::anyConvDateToTimestamp($date_updated) > self::anyConvDateToTimestamp($date_created) ? self::humanIntervalDateTime($date_updated) : '-';
    }

    /**
     * Convert date time to timestamp
     *
     * @param string $datetime default: now()
     * @return string
     */
    private static function anyConvDateToTimestamp(string $datetime = "", bool $withMilli = false): string
    {
        $_format = "U";

        if ($withMilli)
            $_format .= "u";

        return Carbon::parse((iconv_strlen($datetime) ? $datetime : now()))->format($_format);
    }

    /**
     * Convert timestamp to date time
     *
     * @param string $timestamp default: now()
     * @return string
     */
    private static function dbTimestampToDateTime(string $timestamp = ""): string
    {
        if (iconv_strlen($timestamp))
            return Carbon::createFromFormat('U', $timestamp)->format(CarbonInterface::CARBON_DB_SIMPLE_DATE_FORMAT);
        else
            return self::dbDateTime();
    }

    /**
     * Convert date time to interval time from now.
     * For Human.
     *
     * @param string $datetime date from_
     * @return string
     */
    private static function humanIntervalDateTime(string $datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }

    /**
     * Get date time by specific add years from now.
     * For database.
     *
     * @param integer $years default: 1 year
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddYears(int $years = 1, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addYears($years);
    }

    /**
     * Get date time by specific add months from now.
     * For database.
     *
     * @param integer $months default: 6 months
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddMonths(int $months = 6, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addMonths($months);
    }

    /**
     * Get date time by specific add weeks from now.
     * For database.
     *
     * @param integer $weeks default: 1 week
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddWeeks(int $weeks = 1, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addWeeks($weeks);
    }

    /**
     * Get date time by specific add days from now.
     * For database.
     *
     * @param integer $days default: 30 days
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddDays(int $days = 30, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addDays($days);
    }

    /**
     * Get date time by specific add hours from now.
     * For database.
     *
     * @param integer $hours default: 24 hours
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddHours(int $hours = 24, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addHours($hours);
    }

    /**
     * Get date time by specific add minutes from now.
     * For database.
     *
     * @param integer $minutes default: 60 minutes
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddMinutes(int $minutes = 60, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addMinutes($minutes);
    }

    /**
     * Get date time by specific add seconds from now.
     * For database.
     *
     * @param integer $seconds default: 60 seconds
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateAddSeconds(int $seconds = 60, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->addSeconds($seconds);
    }

    /**
     * Get date time by specific sub years from now.
     * For database.
     *
     * @param integer $years default: 1 year
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubYears(int $years = 1, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subYears($years);
    }

    /**
     * Get date time by specific sub months from now.
     * For database.
     *
     * @param integer $months default: 6 months
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubMonths(int $months = 6, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subMonths($months);
    }

    /**
     * Get date time by specific sub weeks from now.
     * For database.
     *
     * @param integer $weeks default: 1 week
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubWeeks(int $weeks = 1, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subWeeks($weeks);
    }

    /**
     * Get date time by specific sub days from now.
     * For database.
     *
     * @param integer $days default: 30 days
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubDays(int $days = 30, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subDays($days);
    }

    /**
     * Get date time by specific sub hours from now.
     * For database.
     *
     * @param integer $hours default: 24 hours
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubHours(int $hours = 24, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subHours($hours);
    }

    /**
     * Get date time by specific sub minutes from now.
     * For database.
     *
     * @param integer $minutes default: 60 minutes
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubMinutes(int $minutes = 60, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subMinutes($minutes);
    }

    /**
     * Get date time by specific sub seconds from now.
     * For database.
     *
     * @param integer $seconds default: 60 seconds
     * @param string $dateStart default: now()
     * @return string
     */
    private static function dbGetFullDateSubSeconds(int $seconds = 60, string $dateStart = ""): string
    {
        return Carbon::parse((iconv_strlen($dateStart) ? $dateStart : now()))->subSeconds($seconds);
    }

    /**
     * Check is date given is equal with format given
     *
     * @param string $date
     * @param string $format
     * @return boolean
     */
    private static function isFormatEqual(string $date, string $format): bool
    {
        return Carbon::hasFormat($date, $format);
    }

    // ? End of Date Format

    // ? Person
    /**
     * Convert date time to person age
     *
     * @param string $datetime human date of birth
     * @return string
     */
    private static function humanGetPersonAge(string $datetime): string
    {
        return Carbon::parse($datetime)->age;
    }

    /**
     * Convert date time to person born date full
     *
     * @param string $datetime human date of birth
     * @return array
     */
    private static function humanGetPersonBornDateFull(string $datetime): array
    {
        $born = Carbon::parse($datetime);

        $date = $born->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        $age = (string) $born->age;

        return compact(['date', 'age']);
    }

    /**
     * Check is person birthday today
     *
     * @param string $datetime human date of birth
     * @return boolean
     */
    private static function isPersonBirthdayToday(string $datetime): bool
    {
        $born = Carbon::parse($datetime);

        return $born->isBirthday();
    }
    // ? End of Person
}
