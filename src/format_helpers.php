<?php

use Stormmore\Framework\Internationalization\I18n;

function format_date($date, $format = null): string
{
    return _format_date($date, false, $format);
}

function format_datetime($date, $format = null): string
{
    return _format_date($date, true, $format);
}

function format_js_datetime($date): string
{
    if (!$date) return '';
    try {
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }
        return $date->format('Y-m-d H:i:s O');
    } catch (Exception) {
        return "";
    }
}

function _format_date($date, $includeTime = false, $format = null): string
{
    if (!$date) return '';
    if (!is_object($date)) {
        $date = new DateTime($date);
    }

    $i18n = di(I18n::class);
    $date->setTimezone($i18n->culture->timeZone);
    if ($format == null) {
        $format = $includeTime ? $i18n->culture->dateTimeFormat : $i18n->culture->dateFormat;
    }

    return $date->format($format);
}

function format_money($value, $currency = null): string
{
    $i18n = di(I18n::class);
    if (!$currency)
        $currency = $i18n->culture->currency;
    $fmt = numfmt_create($i18n->culture->locale, NumberFormatter::CURRENCY);
    return numfmt_format_currency($fmt, $value, $currency);
}