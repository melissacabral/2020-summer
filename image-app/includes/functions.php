<?php 
//Convert DATETIME to a human-friendly format
function nice_date( $ugly_date ){
	$date = new DateTime( $ugly_date );
	//desired format: Tuesday, July 21
	echo $date->format( 'l, F j' );
}

//Convert a DATETIME to "time ago" as in "2 weeks ago"
//https://stackoverflow.com/a/18602474
function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    echo $string ? implode(', ', $string) . ' ago' : 'just now';
}
