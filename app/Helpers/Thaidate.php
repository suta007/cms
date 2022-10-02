<?php
if (!function_exists('toSqlDate')) {
    function toSqlDate($thaiDate)
    {
        if (empty($thaiDate)) {
            return null;
        } else {
            $list = explode("/", $thaiDate);
            $sqlDate = ((int) $list[2] - 543) . "-" . $list[1] . "-" . $list[0];
            return $sqlDate;
        }
    }
}

if (!function_exists('toThaiDate')) {
    function toThaiDate($sqlDate)
    {
        $month = array(
            "01" => "มกราคม",
            "02" => "กุมภาพันธ์",
            "03" => "มีนาคม",
            "04" => "เมษายน",
            "05" => "พฤษภาคม",
            "06" => "มิถุนายน",
            "07" => "กรกฎาคม",
            "08" => "สิงหาคม",
            "09" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม",
        );
        $list = explode("-", $sqlDate);
        $thaiDate = (int) $list[2] . " " . $month[$list[1]] . " " . ((int) $list[0] + 543);
        return $thaiDate;
    }
}

if (!function_exists('toShortDate')) {
    function toShortDate($sqlDate)
    {
        $month = array(
            "01" => "ม.ค.",
            "02" => "ก.พ.",
            "03" => "มี.ค.",
            "04" => "เม.ย.",
            "05" => "พ.ค.",
            "06" => "มิ.ย.",
            "07" => "ก.ค.",
            "08" => "ส.ค.",
            "09" => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค.",
        );
        $list = explode("-", $sqlDate);
        $thaiDate = (int) $list[2] . " " . $month[$list[1]] . " " . ((int) $list[0] + 43 - 2000);
        return $thaiDate;
    }
}

if (!function_exists('ShortDateTime')) {
    function ShortDateTime($sqlDate)
    {
        $month = array(
            "01" => "ม.ค.",
            "02" => "ก.พ.",
            "03" => "มี.ค.",
            "04" => "เม.ย.",
            "05" => "พ.ค.",
            "06" => "มิ.ย.",
            "07" => "ก.ค.",
            "08" => "ส.ค.",
            "09" => "ก.ย.",
            "10" => "ต.ค.",
            "11" => "พ.ย.",
            "12" => "ธ.ค.",
        );
        if (!empty($sqlDate)) {
            $timestamp = strtotime($sqlDate);
            $thaiDate = date("j", $timestamp);
            $thaiDate .= " " . $month[date("m", $timestamp)];
            $thaiDate .= " " . date("y", $timestamp) + 43;
            $thaiDate .= " " . date("H:i:s", $timestamp);
            return $thaiDate;
        } else {
            return null;
        }
    }
}

if (!function_exists('toInputDate')) {
    function toInputDate($sqlDate)
    {
        $list = explode("-", $sqlDate);
        $thaiDate = $list[2] . "/" . $list[1] . "/" . ((int) $list[0] + 543);
        return $thaiDate;
    }
}

if (!function_exists('thisYear')) {
    function thisYear()
    {
        $year = date('Y') + 543;
        if (date('n') > 9) {
            $year += 1;
        }
        return $year;
    }
}
