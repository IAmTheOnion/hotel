<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="hotel akus">
    <meta name="author" content="Kacper i Milosz">
    <title>Hotel Akus</title>
    <link href="style.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <!-- Google Font Import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <!-- Icons Import -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- JQuery Import -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

    <div id="baner">
        <h1 id="hotel-logo"><b>Hotel Akus</b></h1>
        <a href="index.html" id="hotel-button">Hotel</a>
        <a href="reservation.php" id="reservation-button">Rezerwacja</a>
        <a href="specialOffer.php" id="specOffert-button">Oferta Specjalna</a>
    </div>

    <div id="reservation">
        <h1>Rezerwacja</h1>
        <div id="reservation-form">
            <form action="thanks.php" method="POST">
                <?php
                $conn = mysqli_connect("localhost", "root", "", "hotel");
                $list = json_decode($_GET["number"]);
                $days =
                    strtotime($_GET["date_two"]) - strtotime($_GET["date_one"]);
                $days = abs(round($days / 86400) + 1);
                echo "Pobyt będzie trwał od " .
                    $_GET["date_one"] .
                    " do " .
                    $_GET["date_two"] .
                    " (" .
                    $days .
                    " dni)<br>Numer pokoju: ";
                $price = 0;
                foreach ($list as &$value) {
                    echo $value->room_num . " ";
                    $price += $value->price;
                }
                echo " <h2> Cena: " . $days * $price . "zł</h2>";
                ?>
                <input type="text" id="name" name="name1" placeholder="Imie">&nbsp;&nbsp;&nbsp;
                <input type="text" id="sec_name" name="name2" placeholder="Nazwisko"><br><br>
                <input type="email" id="email" name="mail" placeholder="Twój Mail">&nbsp;&nbsp;&nbsp;
                <input type="tel" id="telephone" name="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="Twój Nr. Telefonu"><br><br>
                <input type="submit" name="book" value="Rezerwój">
                <?php if (isset($_POST["book"])) {
                    if (
                        $_POST["name1"] == "" ||
                        $_POST["name2"] == "" ||
                        $_POST["mail"] == "" ||
                        $_POST["phone"] == ""
                    ) {
                        echo "<br><br>Błąd: Niepoprawnie uzupelnione informacje";
                    } else {
                        $data = mysqli_query(
                            $conn,
                            "SELECT `id` FROM `customers` WHERE `name`='" .
                                $_POST["name1"] .
                                "' and `surname`='" .
                                $_POST["name2"] .
                                "' and `telephone_num`='" .
                                $_POST["phone"] .
                                "' and `email`='" .
                                $_POST["mail"] .
                                "';"
                        );
                        if ($data->num_rows == 0) {
                            $command =
                                "INSERT INTO `customers`(`name`, `surname`, `telephone_num`, `email`) VALUES ('" .
                                $_POST["name1"] .
                                "','" .
                                $_POST["name2"] .
                                "','" .
                                $_POST["phone"] .
                                "','" .
                                $_POST["mail"] .
                                "')";
                            $conn->query($command);
                        }
                        $data = mysqli_query(
                            $conn,
                            "SELECT `id` FROM `customers` WHERE `name`='" .
                                $_POST["name1"] .
                                "' and `surname`='" .
                                $_POST["name2"] .
                                "' and `telephone_num`='" .
                                $_POST["phone"] .
                                "' and `email`='" .
                                $_POST["mail"] .
                                "';"
                        );
                        $data = mysqli_fetch_assoc($data);
                        foreach ($list as $element) {
                            $command =
                                "INSERT INTO `books`(`room_num`, `arrival`, `departure`, `customer_id`) VALUES ('" .
                                $element->room_num .
                                "','" .
                                $_GET["date_one"] .
                                "','" .
                                $_GET["date_two"] .
                                "','" .
                                $data["id"] .
                                "')";
                            $conn->query($command);
                        }
                    }
                } ?>
        </div>
        </form>
    </div>

    <div id="footer">
        Autor: Kacper Ołdziejewski & Miłosz Przekop
    </div>

</body>

</html>
