<?php

if (!function_exists('formatDateRange')) {
    function formatDateRange($start_date, $end_date)
    {
        return date('M d, Y', strtotime($start_date)) . ' - ' . date('M d, Y', strtotime($end_date));
    }
}


if (!function_exists('calculateAttendancePercentage')) {
    function calculateAttendancePercentage($presentDays, $totalDays)
    {
        return $totalDays > 0 ? round(($presentDays / $totalDays) * 100, 2) : 0;
    }
}
