<?php

function map_dex_query_params($hash, $joiner = "=") {
  return array_map(function($value, $key) use ($joiner) {
    if ($value && $key) {
      return $key . $joiner . $value;
    }
  }, $hash, array_keys($hash));
}

function search_bar_default_value() {
  return implode(' ', map_dex_query_params($_GET));
}

function get_dex_query_link($hash) {
  $query = implode("&", map_dex_query_params($hash));
  return get_post_type_archive_link('dex') . "?" . $query;
}

function generate_search_data_fields($name, $type1, $type2, $region) {
  $fields = [
    $name,
    "type=$type1",
    "type=$type2",
    "type1=$type1",
    "type2=$type2",
    "region=$region"
  ];

  return strtolower(implode(' ', $fields));
}

?>