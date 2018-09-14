<?php

function pad_number($num, $length = 3) {
  $str = (string) $num;
  $cur_len = strlen($str);

  if ($cur_len >= $length) return $str;

  $repeats = $length - $cur_len;
  return str_repeat('0', $repeats) . $str;
}

function pp($arr) {
  echo '<br><br><pre>';
  var_dump($arr);
  echo '</pre><br><br>';
}

?>