<?php
$FILENAME = "C:\Users\Axion\OneDrive\Desktop\AdventOfCode\\report.txt";
$report = fopen($FILENAME, "r") or die("Unable to open file!");
$reportArray = [];

while (($line = fgets($report)) !== false) {
    $data = preg_replace("/\r|\n/", "", $line);
    $trim = trim($data);
    array_push($reportArray, $trim);
}

fclose($report);

$lineLength = strlen($reportArray[0]);

$oxygen = $reportArray;
$co2 = $reportArray;

for ($i=0; $i<$lineLength; $i++) {
    $one = 0;
    $zero = 0;
    foreach ($oxygen as $number) {
        $digit = (int)($number[$i]);
        if ($digit == 0) {
          $zero++;
        } else {
          $one++;
        }
    }

    for ($j=0; $j<(count($reportArray)); $j++) {
        if (count($oxygen) > 1 && (isset($oxygen[$j]))) {
            $digit = (int)(($oxygen[$j])[$i]);
            if ($zero > $one) {
                if ($digit == 1) {
                unset($oxygen[$j]);
                }
            } else if ($one > $zero) {
                if ($digit == 0) {
                    unset($oxygen[$j]);
                }
            } else if ($zero == $one) {
                if ($digit == 0) {
                    unset($oxygen[$j]);
                }
            }
        }        
    }
}

for ($i=0; $i<$lineLength; $i++) {
  $one = 0;
  $zero = 0;
  foreach ($co2 as $number) {
    $digit = (int)($number[$i]);
    if ($digit == 0) {
      $zero++;
    } else {
      $one++;
    }
  }

  for ($j=0; $j<(count($reportArray)); $j++) {
    if (count($co2) > 1 && (isset($co2[$j]))) {
      $digit = (int)(($co2[$j])[$i]);

      if ($zero > $one) {
        if ($digit == 0) {
          unset($co2[$j]);
        }
      } else if ($one > $zero) {
        if ($digit == 1) {
          unset($co2[$j]);
        }
      } else if ($zero == $one) {
        if ($digit == 1) {
          unset($co2[$j]);
        }
      }
    }        
  }
}

$oRating = reset($oxygen);
$co2Rating = reset($co2);

$lifeSupportRating = bindec($oRating) * bindec($co2Rating);
echo "The life support rating is: ".$lifeSupportRating;

?>