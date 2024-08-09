<?php

$ui = [
    'O ',
    '|',
    '/',
    "\\",
];

$uiStep1 = $ui[0];
$uiStep2 = $ui[2] . $ui[1] . $ui[3];
$uiStep3 = $ui[1];
$uiStep4 = $ui[2] .' '. $ui[3];

$format = "
    ---------
       |    |
       %s   |
      %s   |
       %s    |
      %s   |
-------------
";

echo sprintf($format, $uiStep1, $uiStep2, $uiStep3, $uiStep4);