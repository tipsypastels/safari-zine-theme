<?php

function copyright($name = "Safari Zone") {
  $starting_year = 2018;
  $current_year = date('Y');

  $str = $starting_year == $current_year ?
         $starting_year :
         "$starting_year - $current_year";

  echo fa('copyright') . " $str $name"; 
}

function fa($icon) {
  echo ifa($icon);
}

function ifa($icon) {
  $icon = preg_replace('/fa-/', '', $icon, 1);
  return "<i class='fa fa-$icon'></i>";
}

function button($icon, $text, $href, $class, $blank = true) {
  if ($blank) {
    $target = "target='_blank'";
  } else {
    $target = "";
  } ?>

  <a class="button <?php echo $class ?>" href="<?php echo $href ?>" <?php echo $target ?>>
    <?php 
      echo ifa($icon);
      echo $text;
    ?>
  </a>
<?php }

function button_group($class, $buttons) { ?>
  <div class="button-group <?php echo $class ?>"> <?php
    foreach($buttons as $button): ?>
      <a class="button <?php echo $button['class'] ?>"
         href="<?php echo $button['href'] ?>"
      >
        <?php if ($button['icon']) fa($button['icon']) ?>
        <?php echo $button['text'] ?>
      </a>
    <?php endforeach; ?>
  </div> <?php  
}

?>