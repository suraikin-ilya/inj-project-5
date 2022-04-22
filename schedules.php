<?php
require "includes/header.php";


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
                                                   
                              <option selected value=""></option>';
                    while($row = mysqli_fetch_array($from)) {
                        echo '<option value="' . $row['ID'] . '">' . $row['Name'] . '</option>';
                    }
                    echo '
                        </select>
                      </div>
                  <div class="mb-3 inline-block ml20">
                            <label for="to" class="form-label schedule_label">To</label>
                            <select class="form-select-lg schedule_select" aria-label="Default select example" id="to" name="to">                                                                
                              <option selected value=""></option>';
                            while($row2 = mysqli_fetch_array($to)) {
                                echo '<option value="' . $row2['ID'] . '">' . $row2['Name'] . '</option>';
                            }
                            echo '
                        </select>
                      </div>
                      <div class="mb-3 inline-block ml20">
                            <label for="sort" class="form-label schedule_label">Sort by</label>
                            <select class="form-select-lg schedule_select" aria-label="Default select example" id="sort" name="sort">                                                                
                              <option value="date" selected>Date-time</option>
                              <option value="price-down">Price ↓</option>
                              <option value="price-up">Price ↑</option>
                              <option value="confirmed">confirmed</option>
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
            </tr>
            </thead>
            <tbody>';
            
        ?>
        <?php else:
            echo '<h1>Access denied</h1>'
            ?>
        <?php endif;?>
            
    </main>
</body>