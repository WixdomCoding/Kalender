<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <link rel="stylesheet" href="./css/style.css?v=<?php echo time(); ?>">

</head>
<body>
    <div>
        <form method="post">
            <input type="submit" name="prev" value="Previous">
            <input type="submit" name="curr" value="Current">
            <input type="submit" name="next" value="Next">
        </form>
    </div>
    <table>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['prev'])) {
            $dateParam = htmlspecialchars($_GET["date"]);
            $dateArray = explode("-", $dateParam);
            $newMonth = $dateArray[1] - 1;
            if ($newMonth <= 0) {
                $newMonth = 12;
                $dateArray[0]--;
            }
            $newDate = $dateArray[0] . "-" . $newMonth . "-01";
            header("Location: http://localhost/TE4/First?date=" . $newDate);
        } else if(isset($_POST['curr'])){
            $currentDate = date("Y-m-d");
            header("Location: http://localhost/TE4/First?date=" . $currentDate);
        } else if (isset($_POST['next'])) {
            $dateParam = htmlspecialchars($_GET["date"]);
            $dateArray = explode("-", $dateParam);
            $newMonth = $dateArray[1] + 1;
            if ($newMonth >= 13) {
                $newMonth = 1;
                $dateArray[0]++;
            }
            $newDate = $dateArray[0] . "-" . $newMonth . "-01";
            header("Location: http://localhost/TE4/First?date=" . $newDate);
        }
    }

    // Rest of your code for placing the calendar.
    $dateParam = htmlspecialchars($_GET["date"]);
    $dateArray = explode("-", $dateParam);
    echo("<p>".$dateArray[0]."-".$dateArray[1]."-".$dateArray[2]."</p>");
    $day = 01;
    $month = $dateArray[1];
    $currentDate = date("Y-$month-$day");
    $currentDateName = date("F");

    while((strtotime($currentDate)) <= strtotime(date(("Y-$month") . '-' . date('t', strtotime($currentDate))))) {
        $dayNum = date('j', strtotime($currentDate));
        $dayName = date('l', strtotime($currentDate));
        $weekNumber = date('W', strtotime($currentDate));
        $dayString = "$dayName $dayNum";
        $currentDate = date("Y-m-d", strtotime("+1 day", strtotime($currentDate)));
        if($dayName == "Sunday") {
            echo "<tr><td style='color:red;'>".$dayString. '</td></tr>';
        } else if($dayName == "Monday") {
            echo "<tr><td>".$dayString." Week ".$weekNumber.'</td></tr>';
        } else {
            echo "<tr><td>".$dayString. '</td></tr>';
        }
    }
    ?>
    </table>
    <img src="./img/wtf-edp-huh.gif" alt="Huh">
</body>
</html>
