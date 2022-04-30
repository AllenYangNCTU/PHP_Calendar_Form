<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calendar</title>
    <style>
        .table {
            width: 560px;
            height: 560px;
            display: flex;
            flex-wrap: wrap;
            align-content: baseline;
            margin-left: 1px;
            margin-top: 1px;
        }

        .table div {
            display: inline-block;
            width: 80px;
            height: 80px;
            border: 1px solid #999;
            box-sizing: border-box;
            margin-left: -1px;
            margin-top: -1px;
            text-align: center;
        }
        .table div.header {
            background: black;
            color: yellow;
            height: 32px;
            text-align: center;
        }

        .weekend {
            background: pink;
        }

        .workday {
            background: lightblue;
        }

        .today {
            background: lightseagreen;
        }
        .othermonth{
            background: lightgreen;
        }
        .workdayfont{
            color: black;
            font-size: 24px;
        }
        .holidayfont{
            color: olivedrab;
            font-size: 40px;
            line-height: 5px;
        }
    </style>
</head>

<body>
    <form name="calendar" method="post" action="calendar_flex.php">
      Pleas choose the month you want to check.
   <select name="month">
         <option> January </option>
         <option> February </option>
         <option> March </option>
         <option> April </option>
         <option> May </option>
         <option> June </option>
         <option> July </option>
         <option> Augst </option>
         <option> September </option>
         <option> October </option>
         <option> November </option>
         <option> December </option>
   </select>
         <BR>
         <input type="submit" value="submit">
   </form>
<?php
    $month = $_POST["month"];
    $firstDay = date("Y-") . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay = date("Y-") . $month . "-" . $monthDays;
    $today = date("Y-m-d");
    $lastWeekday = date("w", strtotime($lastDay));
    $dateArray = [];

    for ($i = 0; $i < $firstWeekday; $i++) {
        $dateArray[] = "";
    }

    for ($i = 0; $i < $monthDays; $i++) {
        $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
        $dateArray[] = $date;
    }

    for ($i = 0; $i < (6 - $lastWeekday); $i++) {
        $dateArray[] = "";
    }
    ?>
    <h1>The month you choose is </h1><h1><?php print($month);?></h1>
    <div class="table">
        <div class='header'>Sun</div>
        <div class='header'>Mon</div>
        <div class='header'>Tue</div>
        <div class='header'>Wed</div>
        <div class='header'>Thur</div>
        <div class='header'>Fri</div>
        <div class='header'>Sat</div>
        <?php
        foreach ($dateArray as $k => $day) {
            $holiday = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : "workday";
            $pfont = ($k % 7 == 0 || $k % 7 == 6) ? 'holidayfont' : "workdayfont";
            if (!empty($day)) {
                $dayFormat = date("j", strtotime($day));
                echo "<div class='{$holiday}'><p class='{$pfont}'>{$dayFormat}</p></div>";
            } else {
                echo "<div class='othermonth'></div>";
            }
        }
        ?>
    </div>
</body>

</html>