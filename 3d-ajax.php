<?php
/*invalid ajax*/
if ( !isset( $_POST[ 'req' ] ) ) {
  die( "INVALID REQUEST" );
}
require "2-cal-core.php";
switch ( $_POST[ 'req' ] ) {
  /*draw calendar*/
  case "draw":
    /*date*/
    $daysInMonth = cal_days_in_month( CAL_GREGORIAN, $_POST[ 'month' ], $_POST[ 'year' ] );
    /*first/last day of the month*/
    $dateFirst = "{$_POST['year']}-{$_POST['month']}-01";
    $dateLast = "{$_POST['year']}-{$_POST['month']}-{$daysInMonth}";
    /*days of the week*/
    $dayFirst = ( new DateTime( $dateFirst ) )->format( "w" );
    $dayLast = ( new DateTime( $dateLast ) )->format( "w" );

    /*day names*/
    $sunFirst = true;
    $days = [ "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ];
    if ( $sunFirst ) {
      array_unshift( $days, "Sun" );
    } else {
      $days[] = "Sun";
    }
    foreach ( $days as $d ) {
      echo "<div class='calsq head'>$d</div>";
    }
    unset( $days );

    /*pad empty sqaures at the end of the month*/
    if ( $sunFirst ) {
      $pad = $dayFirst;
    } else {
      $pad = $dayFirst == 0 ? 6 : $dayFirst - 1;
    }
    for ( $i = 0; $i < $pad; $i++ ) {
      echo "<div class='calsq blank'></div>";
    }

    /*drawing days of the month*/
    $events = $CAL->get( $_POST[ 'month' ], $_POST[ 'year' ] );
    $nowMonth = date( "n" );
    $nowYear = date( "Y" );
    $nowDay = ( $nowMonth == $_POST[ 'month' ] && $nowYear == $_POST[ 'year' ] ) ? date( "j" ) : 0;
    for ( $day = 1; $day <= $daysInMonth; $day++ ) {
      ?>
<div class="calsq day<?=$day==$nowDay?" today":""?>" data-day="<?=$day?>">
  <div class="calnum">
    <?=$day?>
  </div>
  <?php if (isset($events['d'][$day])) { foreach ($events['d'][$day] as $eid) { ?>
  <div class="calevt" data-eid="<?=$eid?>"
             style="background:<?=$events['e'][$eid]['evt_color']?>">
    <?=$events['e'][$eid]['evt_text']?>
  </div>
  <?php
  if ( $day == $events[ 'e' ][ $eid ][ 'first' ] ) {
    echo "<div id='evt$eid' class='calninja'>" . json_encode( $events[ 'e' ][ $eid ] ) . "</div>";
  }
  }
  }
  ?>
</div>
<?php
}

/*padding empty squares*/
if ( $sunFirst ) {
  $pad = $dayLast == 0 ? 6 : 6 - $dayLast;
} else {
  $pad = $dayLast == 0 ? 0 : 7 - $dayLast;
}
for ( $i = 0; $i < $pad; $i++ ) {
  echo "<div class='calsq blank'></div>";
}
break;

/*save event*/
case "save":
  echo $CAL->save(
    $_POST[ 'start' ], $_POST[ 'end' ], $_POST[ 'txt' ], $_POST[ 'color' ], $_POST[ 'time' ],
    isset( $_POST[ 'eid' ] ) ? $_POST[ 'eid' ] : null
  ) ? "OK" : $CAL->error;
  break;

  /*delete event*/
case "del":
  echo $CAL->del( $_POST[ 'eid' ] ) ? "OK" : $CAL->error;
  break;
  }
