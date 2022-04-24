<?php
require "includes/header.php";

if (isset($_GET['cancel'])) {
    $scheduleid = $_GET['cancel'];
    $scheduleinfo = mysqli_fetch_array(mysqli_query($db_connect2,"SELECT * FROM `schedules` WHERE ID = '$scheduleid'"));
    if($scheduleinfo['Confirmed'] == 1){$change = mysqli_query($db_connect2, "UPDATE `schedules` SET Confirmed = '0' WHERE ID = '$scheduleid'");}
    if($scheduleinfo['Confirmed'] == 0){$change = mysqli_query($db_connect2, "UPDATE `schedules` SET Confirmed = '1' WHERE ID = '$scheduleid'");}
}

//if ($_GET['edit']) {
//    $scheduleid = $_GET['edit'];
//
//
//}

if(isset($_GET['from']) && isset($_GET['to'])){
    $DepartureAirportID = $_GET['from'];
    $ArrivalAirportID = $_GET['to'];
    $routes = mysqli_fetch_array(mysqli_query($db_connect2,"SELECT * FROM `routes` WHERE DepartureAirportID = '$DepartureAirportID' AND ArrivalAirportID = '$ArrivalAirportID'"));
    $route = $routes['ID'];
}

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}

if(isset($_GET['outbound'])){
    $outbound = $_GET['outbound'];
}

if(isset($_GET['flight_number'])){
    $flight_number = $_GET['flight_number'];
}

?>
<body class="">
    <main class="container">
        <?php
        if ($_COOKIE['role'] == '7b7bc2512ee1fedcd76bdc68926d4f7b'):
            $from = mysqli_query($db_connect2,"SELECT * FROM `airports`");
            $to = mysqli_query($db_connect2,"SELECT * FROM `airports`");
            echo '
            <div class="form border">
                <form action="" method="get">
                <div class="upper_form">     
                    <div class="mb-3 inline-block">
                            <label for="from" class="form-label schedule_label">From</label>
                            <select class="form-select-lg schedule_select" aria-label="Default select example" id="from" name="from">                         
                                                   
                              <option selected></option>';
                    while($row = mysqli_fetch_array($from)) {
                        echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                    }
                    echo '
                        </select>
                      </div>
                  <div class="mb-3 inline-block ml20">
                            <label for="to" class="form-label schedule_label">To</label>
                            <select class="form-select-lg schedule_select" aria-label="Default select example" id="to" name="to">                                                                
                              <option selected ></option>';
                            while($row2 = mysqli_fetch_array($to)) {
                                echo '<option value="' . $row2['ID'] . '">' . $row2['Name'] . '</option>';
                            }
                            echo '
                        </select>
                      </div>
                      <div class="mb-3 inline-block ml20">
                            <label for="sort" class="form-label schedule_label">Sort by</label>
                            <select class="form-select-lg schedule_select" aria-label="Default select example" id="sort" name="sort">                                                                
                              <option value="Date" selected>Date-time</option>
                              <option value="EconomyPrice">Price </option>
                              <option value="Confirmed">confirmed</option>
                        </select>
                      </div> 
                      </div>
                            <div class="mb-3 inline-block">
                              <label for="outbound" class="form-label schedule_label">Outbound</label>
                              <input type="text" class="form-control-lg schedule_input" name="outbound" id="outbound" placeholder="yyyy-mm-dd" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                            </div>
                            <div class="mb-3 inline-block ml20">
                              <label for="flight_number" class="form-label schedule_label">Flight number</label>
                              <input type="number" class="form-control-lg schedule_input" id="flight_number" name="flight_number" placeholder="xxxx"">
                              <button type="submit" class="btn btn_apply" >Apply</button>
                      </div> 
                       </div>   
                </form>
                </div>
            
            <table class="table  table-sm ">
            <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>From</th>
                <th>To</th>
                <th>Flight number</th>
                <th>Aircraft</th>
                <th>Economy price</th>
                <th>Business price</th>
                <th>First class price</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>';
                            if(isset($_GET['from'])){
                            if($flight_number != '' && $outbound!=''){
                            $schedule = mysqli_query($db_connect2,"SELECT * FROM `schedules` WHERE `Date` = '$outbound'
                            AND `RouteID` = '$route'
                            AND `FlightNumber` = '$flight_number'
                            ORDER BY `$sort` ASC");}
                            if($flight_number == '' && $outbound!='') {
                                $schedule = mysqli_query($db_connect2,"SELECT * FROM `schedules` WHERE `Date` = '$outbound'
                            AND `RouteID` = '$route'
                            AND `FlightNumber` IS NOT NULL
                            ORDER BY `$sort` ASC");}
                            if($flight_number != '' && $outbound ==''){
                                $schedule = mysqli_query($db_connect2,"SELECT * FROM `schedules` WHERE `Date` IS NOT NULL
                                            AND `RouteID` = '$route'
                                            AND `FlightNumber` = '$flight_number'
                                            ORDER BY `$sort` ASC");}
                            if($flight_number == '' && $outbound ==''){
                                $schedule = mysqli_query($db_connect2,"SELECT * FROM `schedules` WHERE `Date` IS NOT NULL
                                                            AND `RouteID` = '$route'
                                                            AND `FlightNumber` IS NOT NULL
                                                            ORDER BY `$sort` ASC");}
                            $i = 1;
                            while ($row = mysqli_fetch_array($schedule)) {
                            $i++;
                $from_schedule = $_GET['from'];
                $to_schedule = $_GET['to'];
                $schedule_from = mysqli_fetch_array(mysqli_query($db_connect2,"SELECT * FROM `airports` WHERE `ID` = '$from_schedule'"));
                $schedule_to = mysqli_fetch_array(mysqli_query($db_connect2,"SELECT * FROM `airports` WHERE `ID` = '$to_schedule'"));
                echo '<tr "';
                if($row['Confirmed'] == 0){echo ' style="background-color: red"';}
                echo '>';
                echo '<td>' . $row['Date'] . '</td>';
                echo '<td>' . $row['Time'] . '</td>';
                echo '<td>' . $schedule_from['IATACode'] . '</td>';
                echo '<td>' . $schedule_to['IATACode'] . '</td>';
                echo '<td>' . $row['FlightNumber'] . '</td>';
                echo '<td>' . 'Boeing 738' . '</td>';
                echo '<td>$' . $row['EconomyPrice'] . '</td>';
                echo '<td>$' . $row['EconomyPrice']*1.35 . '</td>';
                echo '<td>$' . $row['EconomyPrice']*1.3 . '</td>';
                echo '<td> <a href="' . $_SERVER['REQUEST_URI'] . '&cancel='. $row['ID'] .'">';
                if($row['Confirmed'] == 1){echo '<img src="img/switch-off.png"></a></td>';}else{echo '<img src="img/switch-on.png"></a></td>';}
                echo '<td> <button class="open-popup-'. $i .' btn">edit</button>';
                                echo '<div class="popup-'. $i .'-bg" style="   position: fixed;
                                                                                        width: 100%;
                                                                                        height: 100%;
                                                                                        top: 0;
                                                                                        left: 0;
                                                                                        background: rgba(0,0,0,0.6);
                                                                                        display: none;">
                    <div class="popup-'. $i .'" style="    position: absolute;
                                                                top: 50%;
                                                                left: 50%;
                                                                width: 600px;
                                                                background: #F1F2F3;
                                                                transform: translate(-50%, -50%);
                                                                padding: 20px;">
                        <div class="mb-3 inline-block">
                            <label for="Date" class="form-label">Date</label>
                            <input type="text" class="form-control-lg schedule_input" id="Date" name="Date" value="'. $row['Date'].'">
                        </div>
                        <div class="mb-3 inline-block">
                            <label for="Time" class="form-label">Time</label>
                            <input type="text" class="form-control-lg schedule_input" id="Time" name="Time" value="'. $row['Time'].'">
                        </div>
                        <div class="mb-3 inline-block">
                            <label for="Price" class="form-label">Economy price</label>
                            <input type="text" class="form-control-lg schedule_input" id="Price" name="Price" value="'. $row['EconomyPrice'].'">
                        </div>
                        <br>
                        <button style="color: #FFFACB; background-color: #196AA6" type="submit" class="btn btn-primary">Save</button>
                        <a style="color: #FFFACB; background-color: #F79420" type="" class="btn btn close-popup-'. $i .'">Cancel</a>
                    </div>
                    </div>';
                    echo "<script>";
                    echo "$(document).on('click', '.open-popup-". $i ."', function (){ ";
                    echo "$('.popup-". $i ."-bg').fadeIn(600);";
                      echo "});";
                     echo "$(document).on('click','.close-popup-". $i ."',function (){";
                    echo "$('.popup-". $i ."-bg').fadeOut(600);";
                    echo "});";
                    echo "</script>";
                echo '<tr>';

            }}
            echo '</tbody>
        </table>' ;?>
        <?php else:
            echo '<h1>Access denied</h1>'
            ?>
        <?php endif;?>
            
    </main>
</body>

<?php

?>