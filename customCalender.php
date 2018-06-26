<html>
<head>
<title>Custom Calculator</title>

</head>
<body>

<?php //Here you find out what day of the week the first day of the month falls on
function CalendarMonth($month)
{
    switch($month){
        case 1: return "January"; break;
        case 2: return "February"; break;
        case 3: return "March"; break;
        case 4: return "April"; break;
        case 5: return "May"; break;
        case 6: return "June"; break;
        case 7: return "July"; break;
        case 8: return "August"; break;
        case 9: return "September"; break;
        case 10: return "October"; break;
        case 11: return "November"; break;
        case 12: return "December"; break;
        case 13: return "Ptander"; break;
    }

}


function checkLeapYear($year){
    $leapYear = [1995,2000,2005,2010,2015,3000];
    if(in_array($year, $leapYear)){
       return True;
    }


}

$DayCount = 0;

function getDayName($year,$month,$day){
    $extera_day = 0;
    $pre_year = $year - 1990;
    $is_leap_year = checkLeapYear($year);
    if ( $pre_year > 5 && $is_leap_year != True ){
        $extera_day = 1;
    }
    if ( $pre_year > 10 && $is_leap_year != True ){
        $extera_day = 2;
    }
    if ( $pre_year > 15 && $is_leap_year != True ){
        $extera_day = 3;
    }
    if ( $pre_year > 20 && $is_leap_year != True ){
        $extera_day = 4;
    }
    $DayCount = 0;
    if ($pre_year >= 1){
        $pre_year=$pre_year-1;
        foreach (range(0, $pre_year) as $number) {

                $DayCount += 6*21;
                $DayCount += 6*22;

        }


    }


    $month = $month-1;
    foreach (range(1, $month) as $number) {
        if($number % 2 == 0){
            $DayCount += 21;
        }else{
            $DayCount += 22;
        }
    }
    $DayCount += $day;



    $DayVal = $DayCount / 7;
    $DayVal = intval($DayVal);

    $DayRemainder = $DayCount % 7;

    $DayNumber=0;
    if ($DayRemainder >= 1){
       $totalDays = $DayVal * 7;


       if($DayCount > $totalDays){
            $DayNumber = $DayCount - $totalDays;
       }else{
            $DayNumber = $totalDays - $DayCount;
       }

    }else{
        $DayNumber = 1;

    }

    $DayNumber += $extera_day;

//    $DayNumber=4;

    $DayNumber=$DayNumber-1;
    $DayArray = ['Monday','Tuesday','Wednessday','Thurshday','Friday','Saturday','Sunday'];
    $DayName = $DayArray[$DayNumber];


    return $DayName;


}


function checkMonthDay($month,$day,$year){
    if ($year < 1990){

        return ["error","Please enter the correct year above 1990"];
    }
    if($month < 1 || $month >13){
        return ["error","Please enter the correct month in between 1 to 13"];
    }else{
        if ($month % 2==0){
            if ($day < 1 || $day > 21){
                return ["error","Please enter the correct day in between 1 to 21"];
            }
            return ["success","Month is even"];
        }else{
            if ($day < 1 || $day > 22){
                return ["error","Please enter the correct day in between 1 to 22"];
            }
            return ["success","Month is ODD"];
        }

    }
    return CalendarMonth($month);

}

//getDayName(1990,02,10);
//$date_v = explode('.',"17.11.2013");
//echo $date_v[0];
//echo " ====== ",$date_v[1];
//echo " ====== ",$date_v[2];
$msg='';
function findDateDay(){


    $dt = $_GET['dt'];

    $date_v = explode('.',$dt);

    $dt = intval($date_v[0]);
    $month = intval($date_v[1]);
    $year = intval($date_v[2]);

    $msg = checkMonthDay($month,$dt,$year);

    if($msg[0] == "error"){
        echo $msg[1];
    }else{
        echo "Day name is = ", getDayName($year,$month,$day);
    }



}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $dt = $_GET['dt'];
    if( strlen($dt) >=10){
        findDateDay();
    }


}






?>
<form method="get">
<div style="float:left;width:100%">
    Enter Date : <input type="text" name="dt" id="dt" value="<?php echo $_GET['dt']; ?>" placeholder='dd.mm.yyyy'>
    <input type="submit" value="Submit" >
</div>

</form>

<script>


</script>

</body>
</html>