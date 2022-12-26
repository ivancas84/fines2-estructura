<?
function getSemester(DateTime $date = null) {
    $date = $date || new DateTime();
    return (intval($date.format("m")) < 6) ? 1 : 2;
}