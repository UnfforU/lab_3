<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/styles.css"/>
</head>
<body>
    <form action="index.php" method="post">
        <p>
            Введите год: <input name="year" type="text">
        </p>
        <p>
            <input class="button_show" type='submit' value='Показать'>
        </p>
    </form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $year = htmlspecialchars($_POST['year']);

    function CreateCalendar($year) {
        $all_mouth = array(
            1 => 'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь'
        );
        $calendar = '<div class="calendar">';

        for($currMonth = 1; $currMonth <= 12; $currMonth++){
            $title = '
            <div class="calendar_item">
                <div class="title_text">' . $all_mouth[$currMonth] . ' ' . $year . '</div>';
            $calendar .= $title;
            $calendar_item = '<table>
                        <tr>
                            <th>пн</th>
                            <th>вт</th>
                            <th>ср</th>
                            <th>чт</th>
                            <th>пт</th>
                            <th>сб</th>
                            <th>вс</th>
                        </tr>';
            $firstDayOfMouth =  date('w', mktime(0, 0, 0, $currMonth, 1, $year));
            if ($firstDayOfMouth == 0){
                $firstDayOfMouth = 7;
            }

            $tr = '<tr>';
            $td = '<td> </td>';

            for ($i = 0; $i < $firstDayOfMouth - 1; $i++){
                $tr .= $td;
            }

            $numbOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $currMonth, $year);
            for ($i = $firstDayOfMouth, $currDay = 1; $currDay <= $numbOfDaysInMonth; $i++, $currDay++){
                $td = '<td class="day">'."$currDay".'</td>';
                $tr .= $td;
                if ($i % 7 === 0){
                    $tr .= '</tr><tr>';
                }
            }

            $calendar_item.= $tr.'</tr></table></div>';
            $calendar .= $calendar_item;
        }
        $calendar .= '</div>';
        echo $calendar;
    }
    CreateCalendar($year);
}