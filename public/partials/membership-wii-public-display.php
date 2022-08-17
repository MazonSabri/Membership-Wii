<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://mostaql.com/u/mazonsabri
 * @since      1.0.0
 *
 * @package    Membership_Wii
 * @subpackage Membership_Wii/public/partials
 */

if(! $result){
  echo "<span class='styled-table' style='color: red'>Sorry, The user is not found.</span>";
  die();
}

$currentday = date('Y-m-d');
$startedAt = date('Y-m-d', strtotime($result->started_at));
$endingAt = date('Y-m-d', strtotime($startedAt . $result->ending_period));

$output .= '<table class="styled-table">';
$output .= '<thead><tr><th>Title</th><th>Value</th></tr></thead><tbody>';
$output .= '<tr><td>رقم العضوية</td><td>'. $result->member_id .'</td></tr>';
$output .= '<tr class="active-row"><td>الإسم</td><td>'. $result->name .'</td></tr>';
$output .= '<tr><td>الحالة</td><td>'. ($endingAt > $currentday ? "نشط" : "غير نشط") .'</td></tr>';
$output .= '<tr class="active-row"><td>تاريخ البدء</td><td>'. $startedAt .'</td></tr>';
$output .= '<tr><td>تاريخ الإنتهاء</td><td>'. $endingAt .'</td></tr>';
$output .= '<tr class="active-row"><td>رقم الهاتف</td><td>'. $result->phone_number .'</td></tr>';
$output .= '</tbody></table>';

echo $output;
die();
?>
