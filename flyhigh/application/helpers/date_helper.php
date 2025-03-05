<?php

function iso8601_to_Ymd_date($date){
    $formated_date=DateTime::createFromFormat('Y-m-d\TH:i:s',$date)->format('M d, Y');
    return $formated_date;
}

function iso8601_to_HI_time($time){
  $formated_time=DateTime::createFromFormat('Y-m-d\TH:i:s',$time)->format('H:i');
  return $formated_time;
}

function iso8601ToDuration($iso8601) {
    $duration = new DateInterval($iso8601);
  
    $hours = $duration->format('%h');
    $minutes = $duration->format('%i');
    $seconds = $duration->format('%s');
  
    $durationString = '';
    
    if ($hours > 0) {
      $durationString .= $hours . 'h ';
    } 
    if ($minutes > 0) {
      $durationString .= $minutes . 'm ';
    } 
    if ($seconds > 0){
      $durationString .= $seconds . 's ';
    }
  
    return $durationString;
  }