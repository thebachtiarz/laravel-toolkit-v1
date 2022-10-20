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
     * @param Carbon|null $dateStart default: now()
     * @return string
     */
    private static function humanFullDateTimeNow(?Carbon $dateStart = null): string
    {
        return Carbon::parse($dateStart ?? Carbon::now())
            ->setTimezone(tbtoolkitconfig('app_timezone'))
            ->isoFormat(CarbonInterface::CARBON_FULL_HUMAN_DATE_FORMAT);
    }

    /**
     * Get date time now in timezone
     *
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbDateTimeNowTimezone(?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->setTimezone(tbtoolkitconfig('app_timezone'));
    }

    /**
     * Parse date time.
     * For human.
     *
     * @param Carbon $datetime default: now()
     * @param string $split split only: date or time
     * @return string
     */
    private static function humanDateTime(?Carbon $datetime = null, string $split = ''): string
    {
        $datetime = Carbon::parse($datetime ?? Carbon::now());

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_HUMAN_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_HUMAN_SIMPLE_DATE_FORMAT);
    }

    /**
     * Parse date time.
     * For database.
     *
     * @param Carbon $datetime default: now()
     * @param string $split split only: date or time
     * @return string
     */
    private static function dbDateTime(?Carbon $datetime = null, string $split = ''): string
    {
        $datetime = Carbon::parse($datetime ?? Carbon::now());

        if ($split == 'date') return $datetime->format(CarbonInterface::CARBON_DB_DATE_FORMAT);

        if ($split == 'time') return $datetime->format(CarbonInterface::CARBON_DB_TIME_FORMAT);

        return $datetime->format(CarbonInterface::CARBON_DB_SIMPLE_DATE_FORMAT);
    }

    /**
     * Get interval date created from date updated
     *
     * @param Carbon $date_created
     * @param Carbon $date_updated
     * @return string
     */
    private static function humanIntervalCreateUpdate(Carbon $date_created, Carbon $date_updated): string
    {
        return self::anyConvDateToTimestamp($date_updated) > self::anyConvDateToTimestamp($date_created) ? self::humanIntervalDateTime($date_updated) : '-';
    }

    /**
     * Convert date time to timestamp
     *
     * @param Carbon $datetime default: now()
     * @return string
     */
    private static function anyConvDateToTimestamp(?Carbon $datetime = null, bool $withMilli = false): string
    {
        $_format = "U";

        if ($withMilli)
            $_format .= "u";

        return Carbon::parse($datetime ?? Carbon::now())->format($_format);
    }

    /**
     * Convert timestamp to date time
     *
     * @param string $timestamp default: now()
     * @return string
     */
    private static function dbTimestampToDateTime(string $timestamp = ""): string
    {
        return iconv_strlen($timestamp)
            ? Carbon::createFromFormat('U', $timestamp)->format(CarbonInterface::CARBON_DB_SIMPLE_DATE_FORMAT)
            : self::dbDateTime();
    }

    /**
     * Convert date time to interval time from now.
     * For Human.
     *
     * @param Carbon $datetime date from_
     * @return string
     */
    private static function humanIntervalDateTime(Carbon $datetime): string
    {
        return Carbon::parse($datetime)->diffForHumans();
    }

    /**
     * Get date time by specific add years from now.
     * For database.
     *
     * @param integer $years default: 1 year
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddYears(int $years = 1, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addYears($years);
    }

    /**
     * Get date time by specific add months from now.
     * For database.
     *
     * @param integer $months default: 6 months
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddMonths(int $months = 6, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addMonths($months);
    }

    /**
     * Get date time by specific add weeks from now.
     * For database.
     *
     * @param integer $weeks default: 1 week
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddWeeks(int $weeks = 1, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addWeeks($weeks);
    }

    /**
     * Get date time by specific add days from now.
     * For database.
     *
     * @param integer $days default: 30 days
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddDays(int $days = 30, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addDays($days);
    }

    /**
     * Get date time by specific add hours from now.
     * For database.
     *
     * @param integer $hours default: 24 hours
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddHours(int $hours = 24, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addHours($hours);
    }

    /**
     * Get date time by specific add minutes from now.
     * For database.
     *
     * @param integer $minutes default: 60 minutes
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddMinutes(int $minutes = 60, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addMinutes($minutes);
    }

    /**
     * Get date time by specific add seconds from now.
     * For database.
     *
     * @param integer $seconds default: 60 seconds
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateAddSeconds(int $seconds = 60, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->addSeconds($seconds);
    }

    /**
     * Get date time by specific sub years from now.
     * For database.
     *
     * @param integer $years default: 1 year
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubYears(int $years = 1, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subYears($years);
    }

    /**
     * Get date time by specific sub months from now.
     * For database.
     *
     * @param integer $months default: 6 months
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubMonths(int $months = 6, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subMonths($months);
    }

    /**
     * Get date time by specific sub weeks from now.
     * For database.
     *
     * @param integer $weeks default: 1 week
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubWeeks(int $weeks = 1, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subWeeks($weeks);
    }

    /**
     * Get date time by specific sub days from now.
     * For database.
     *
     * @param integer $days default: 30 days
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubDays(int $days = 30, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subDays($days);
    }

    /**
     * Get date time by specific sub hours from now.
     * For database.
     *
     * @param integer $hours default: 24 hours
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubHours(int $hours = 24, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subHours($hours);
    }

    /**
     * Get date time by specific sub minutes from now.
     * For database.
     *
     * @param integer $minutes default: 60 minutes
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubMinutes(int $minutes = 60, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subMinutes($minutes);
    }

    /**
     * Get date time by specific sub seconds from now.
     * For database.
     *
     * @param integer $seconds default: 60 seconds
     * @param Carbon|null $dateStart default: now()
     * @return Carbon
     */
    private static function dbGetFullDateSubSeconds(int $seconds = 60, ?Carbon $dateStart = null): Carbon
    {
        return Carbon::parse($dateStart ?? Carbon::now())->subSeconds($seconds);
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
     * @param Carbon $datetime human date of birth
     * @return integer
     */
    private static function humanGetPersonAge(Carbon $datetime): int
    {
        return Carbon::parse($datetime)->age;
    }

    /**
     * Convert date time to person born date full
     *
     * @param Carbon $datetime human date of birth
     * @return array
     */
    private static function humanGetPersonBornDateFull(Carbon $datetime): array
    {
        $born = Carbon::parse($datetime);

        $date = $born->format(CarbonInterface::CARBON_HUMAN_DATE_FORMAT);

        $age = (string) $born->age;

        return compact(['date', 'age']);
    }

    /**
     * Check is person birthday today
     *
     * @param Carbon $datetime human date of birth
     * @return boolean
     */
    private static function isPersonBirthdayToday(Carbon $datetime): bool
    {
        $born = Carbon::parse($datetime);

        return $born->isBirthday();
    }
    // ? End of Person
}
