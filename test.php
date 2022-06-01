<?php
    if(isset($_POST['button'])) {
        $command = "SELECT room_num, (price/adoults+kids) as ppp FROM rooms WHERE room_num NOT IN (SELECT books.room_num FROM books WHERE (books.arrival >= '" . $date1 . "' AND books.departure <= '" . $date2 . "') OR (books.arrival <= '" . $date1 . "' AND books.departure >= '" . $date2 . "') OR (books.arrival <= '" . $date1 . "' AND books.departure >= '" . $date1 . "') OR (books.arrival <= '" . $date2 . "' AND books.departure >= '" . $date2 . "')) ORDER BY price DESC" ;
        $conn = mysqli_connect("localhost", "root", "", "hotel");
        $list = [];
        $data=mysqli_query($conn, $command);
        while($row=mysqli_fetch_assoc($data)){
            $list[] = $row;
        }

        echo $list[0]["ppp"];
    }


?>