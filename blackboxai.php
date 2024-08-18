<?php

// Function to convert Ethiopian year to Gregorian year
function ethiopianToGregorian($ethiopianYear)
{
    $gregorianYear = $ethiopianYear + 8 + (int)($ethiopianYear / 4);
    return $gregorianYear;
}

// Function to convert Gregorian year to Ethiopian year
function gregorianToEthiopian($gregorianYear)
{
    $ethiopianYear = $gregorianYear - 8 - (int)($gregorianYear / 4);
    return $ethiopianYear;
}

// Function to get the number of days excluding Sundays in Ethiopian calendar
function getEthiopianDaysExcludingSundays($ethiopianYear)
{
    $ethiopianYearLength = 365;
    if (($ethiopianYear % 4) === 0) {
        $ethiopianYearLength = 366;
    }
    return $ethiopianYearLength - ($ethiopianYearLength / 7);
}

// Function to get the number of days excluding Sundays in Gregorian calendar
function getGregorianDaysExcludingSundays($gregorianYear)
{
    $gregorianYearLength = 365;
    if ((($gregorianYear % 4) === 0 && ($gregorianYear % 100) !== 0) || ($gregorianYear % 400) === 0) {
        $gregorianYearLength = 366;
    }
    return $gregorianYearLength - ($gregorianYearLength / 7);
}

// Convert Ethiopian date to Gregorian date
function convertEthiopianToGregorian($ethiopianYear, $ethiopianMonth, $ethiopianDay)
{
    $gregorianYear = ethiopianToGregorian($ethiopianYear);
    $gregorianMonth = $ethiopianMonth + 9;
    if ($gregorianMonth > 12) {
        $gregorianYear++;
        $gregorianMonth -= 12;
    }
    $gregorianDay = $ethiopianDay + 2;
    if ($gregorianMonth === 13 && $gregorianDay > 6) {
        $gregorianMonth = 1;
        $gregorianDay -= 7;
    }
    return [$gregorianYear, $gregorianMonth, $gregorianDay];
}

// Convert Gregorian date to Ethiopian date
function convertGregorianToEthiopian($gregorianYear, $gregorianMonth, $gregorianDay)
{
    $ethiopianYear = gregorianToEthiopian($gregorianYear);
    $ethiopianMonth = $gregorianMonth - 9;
    if ($ethiopianMonth <= 0) {
        $ethiopianYear--;
        $ethiopianMonth += 12;
    }
    $ethiopianDay = $gregorianDay - 2;
    if ($ethiopianMonth === 13 && $ethiopianDay <= 0) {
        $ethiopianMonth = 1;
        $ethiopianDay += 7;
    }
    return [$ethiopianYear, $ethiopianMonth, $ethiopianDay];
}

// Example usage

$ethiopianYear = 2014;
$ethiopianMonth = 4;
$ethiopianDay = 30;

// Convert Ethiopian date to Gregorian date
[$gregorianYear, $gregorianMonth, $gregorianDay] = convertEthiopianToGregorian($ethiopianYear, $ethiopianMonth, $ethiopianDay);
echo "Ethiopian date: $ethiopianYear/$ethiopianMonth/$ethiopianDay\n";
echo "Gregorian date: $gregorianYear/$gregorianMonth/$gregorianDay\n";

// Convert Gregorian date to Ethiopian date
[$ethiopianYear, $ethiopianMonth, $ethiopianDay] = convertGregorianToEthiopian($gregorianYear, $gregorianMonth, $gregorianDay);
echo "Gregorian date: $gregorianYear/$gregorianMonth/$gregorianDay\n";
echo "Ethiopian date: $ethiopianYear/$ethiopianMonth/$ethiopianDay\n";

// Get the number of days excluding Sundays in Ethiopian calendar
$ethiopianYear = 2014;
$ethiopianDaysExcludingSundays = getEthiopianDaysExcludingSundays($ethiopianYear);
echo "Number of days excluding Sundays in Ethiopian calendar: $ethiopianDaysExcludingSundays\n";

// Get the number of days excluding Sundays in Gregorian calendar
//$gregorianYear = 2024Apologies for the incomplete response. Here's the complete code for getting the number of days excluding Sundays in the Gregorian calendar:


// Get the number of days excluding Sundays in Gregorian calendar
$gregorianYear = 2024;
$gregorianDaysExcludingSundays = getGregorianDaysExcludingSundays($gregorianYear);
echo "Number of days excluding Sundays in Gregorian calendar: $gregorianDaysExcludingSundays\n";