<?php
$conn = mysqli_connect("localhost", "root", "", "hotel");

function isInt($price, $return_this)
{
    if ($price < 0 || $price == null) {
        return $return_this;
    } else {
        return $price;
    }
}

function refreshList($pmin, $pmax, $kids, $adult, $date1, $date2)
{
    $conn = mysqli_connect("localhost", "root", "", "hotel");
    $list = [];
    $command =
        "SELECT * FROM rooms WHERE (price>=" .
        $pmin .
        ") and (price<=" .
        $pmax .
        ") and (kids>=" .
        $kids .
        ") and (adults>=" .
        $adult .
        ") AND room_num NOT IN (SELECT books.room_num FROM books WHERE (books.arrival >= '" .
        $date1 .
        "' AND books.departure <= '" .
        $date2 .
        "') OR (books.arrival <= '" .
        $date1 .
        "' AND books.departure >= '" .
        $date2 .
        "') OR (books.arrival <= '" .
        $date1 .
        "' AND books.departure >= '" .
        $date1 .
        "') OR (books.arrival <= '" .
        $date2 .
        "' AND books.departure >= '" .
        $date2 .
        "'))";
    $data = mysqli_query($conn, $command);
    while ($row = mysqli_fetch_assoc($data)) {
        $list[] = $row;
    }
    foreach ($list as &$value) {
        if ($value["room_tier"] == "economic") {
            // Sprawdza jaka nazwa, zdjęcie i opis powinien się wyświtlić
            $tier = "img/economic.jpg";
            $desc =
                "Najmniejsze i budżetowe, tego typu pokoje są odpowiednie dla osób podróżujących samotnie lub na krótki pobyt, ponieważ mają ograniczoną przestrzeń i miejsce do przechowywania.";
            $name = "Ekonomiczny";
        } elseif ($value["room_tier"] == "lux") {
            $tier = "img/luxy.jpg";
            $desc =
                "Z pokoju typu king-size roztacza się widok na ogrody krajobrazowe. W pokoju znajduje się część wypoczynkowa, duża garderoba, sejf cyfrowy i minilodówka.";
            $name = "Klasy Biznes";
        } elseif ($value["room_tier"] == "penthouse") {
            $tier = "img/penthouse.jpg";
            $desc =
                "Znajdujący się na ostatnim piętrze penthouse posiada dużą przestrzeń dzienną oraz dwie sypialnie z osobnymi łazienkami. Druga sypialnia znajduję się na niewielkiej antresoli, na której znajduje się również niewielki gabinet oraz wejście na ogromny taras widokowy znajdujący się na dachu hotelu. Dwie marmurowe łazienki wyposażone są w wannę i osobny prysznic. Przewodnim materiałem budującym charakter wnętrza pokoi oraz łazienek jest lity orzech amerykański, naturalny kamień, szkło oraz miedź.";
            $name = "Penthouse";
        } elseif ($value["room_tier"] == "warmianin") {
            $tier = "img/melina.jpg";
            $desc =
                "Średni belweder w stylu z gatunku Mel-INA. Brzydki zapach wynagradzają miesięczne zapasy paprykarza szczecińskiego oraz mortadeli. Sypialnia z łóżkiem okupywanym niegdyś przez Maj. Wojciecha Suchodolskiego, obok którego znajduje się łoże prezydenckie. W cenie znajdują się potrawy kuchni bombaskiej (między innymi słynny bigos z mandarynkami) oraz spotkanie z tzw. potężnym warmianinem Krzysztofem Kononowiczem.";
            $name = "Warmianin";
        }
        $list_of_rooms = [];
        $list_of_rooms[] = $value;
        $room_numbers = json_encode($list_of_rooms);
        echo "
            <div id='room'>
                <img id='image' src='" .
            $tier .
            "'>
                <div id='description'>
                    <h2>Pokój " .
            $name .
            " - " .
            $value["room_num"] .
            "</h2>
                    " .
            $value["price"] .
            " zł za dobę<br><br>
                    <i class='fa fa-user' style='font-size:24px'></i>&nbsp;<b>" .
            $value["adults"] .
            "</b>&nbsp;&nbsp;&nbsp;
                    <i class='fa fa-child' style='font-size:24px'></i>&nbsp;<b>" .
            $value["kids"] .
            "</b><br><br>
                    " .
            $desc .
            " <br><br>
                    <form method='get' action='book.php'>
                        <input type='hidden' name='date_one' value=" .
            $_POST["arrival_date"] .
            ">
                        <input type='hidden' name='date_two' value=" .
            $_POST["departure_date"] .
            ">
                        <input type='hidden' name='number' value=" .
            $room_numbers .
            ">
                        <input type='submit' name='book' id='book-button' value='Rezerwój'/>
                    </form>
                    
                </div>
            </div>";
    }
    if($adult >= 1 || $kids >= 1)
    bestCombination($kids, $adult, $date1, $date2);
}

function bestCombination($kids, $adult, $date1, $date2) {
    $conn = mysqli_connect("localhost", "root", "", "hotel");
    $command =
        "SELECT  price,room_num, price/adults+kids as ppp, adults, kids FROM rooms WHERE room_num NOT IN (SELECT books.room_num FROM books WHERE (books.arrival >= '" .
        $date1 .
        "' AND books.departure <= '" .
        $date2 .
        "') OR (books.arrival <= '" .
        $date1 .
        "' AND books.departure >= '" .
        $date2 .
        "') OR (books.arrival <= '" .
        $date1 .
        "' AND books.departure >= '" .
        $date1 .
        "') OR (books.arrival <= '" .
        $date2 .
        "' AND books.departure >= '" .
        $date2 .
        "')) ORDER BY ppp";
    $list_of_rooms = [];
    $data = mysqli_query($conn, $command);
    $x = 0;
    $y = 0;
    $kids = 0;
    $adults = 0;
    $price = 0;
    while ($row = mysqli_fetch_assoc($data)) {
        if ($x < $adult or $y < $kids) {
            $x += $row["adults"];
            $y += $row["kids"];
            $list_of_rooms[] = $row;
            $kids += $row["kids"];
            $adults += $row["adults"];
            $price += $row["price"];
        }
    }
    $room_numbers = json_encode($list_of_rooms);
    echo "<div id='best-combination'>
        <h2 id='NKP'>Najlepsza kombinacja pokoi:</h2>
        <div id='combination-of-rooms'>";
    foreach ($list_of_rooms as $element) {
        echo $element["room_num"] . " ";
    }
    echo "
        </div>
        <div id='rooms-information'>
            <h3>Cena: " .
        $price .
        "zł</h3>
            <i class='fa fa-user' style='font-size:24px'></i>&nbsp;<b>" .
        $adults .
        "</b>&nbsp;&nbsp;&nbsp;
            <i class='fa fa-child' style='font-size:24px'></i>&nbsp;<b>" .
        $kids .
        "</b><br><br>
            <form method='get' action='book.php'>
                <input type='hidden' name='date_one' value='" .
        $_POST["arrival_date"] .
        "'>
                <input type='hidden' name='date_two' value='" .
        $_POST["departure_date"] .
        "'>
                <input type='hidden' name='number' value='" .
        $room_numbers .
        "'>
                <input type='submit' name='book' id='book-button' value='Rezerwój'/>
            </form>
        </div>
    </div>";
}


if (isset($_POST["button"])) {
    if (empty($_POST["arrival_date"]) || empty($_POST["departure_date"])) {
        echo "Dane na temat czasu pobytu muszą zostać uzupełnione<br><br><br>";
    } elseif (
        $_POST["arrival_date"] > $_POST["departure_date"] ||
        $_POST["departure_date"] < date("Y-m-d")
    ) {
        echo "Dane na temat czasu pobytu są nieprawidłowe<br><br><br>";
    } else {
        refreshList(
            isInt($_POST["min_price"], 0),
            isInt($_POST["max_price"], 20000),
            isInt($_POST["kids"], 0),
            isInt($_POST["adult"], 0),
            isInt($_POST["arrival_date"], 0),
            isInt($_POST["departure_date"], 0)
        );
    }
}
?>
