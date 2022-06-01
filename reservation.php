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
        <form action="" method="POST">
            <label for="min_price">Cena:</label>
            <input type="number" id="min_price" name="min_price" placeholder="Minimalna"
                value=<?php error_reporting(0); echo $_POST['min_price']; ?>>
            <input type="number" id="max_price" name="max_price" placeholder="Maksymalna"
                value=<?php echo $_POST['max_price']; ?>>
            &nbsp;&nbsp;&nbsp;<label for="adult">Dorośli:</label>
            <input type="number" id="adult" name="adult" placeholder="Ilość" value=<?php echo $_POST['adult']; ?>>
            &nbsp;&nbsp;&nbsp;<label for="kids">Dzieci:</label>
            <input type="number" id="kids" name="kids" placeholder="Ilość" value=<?php echo $_POST['kids']; ?>>
            &nbsp;&nbsp;&nbsp;<label for="kids">Pobyt:</label>
            <input id="ar-date" type="date" placeholder="Przyjazd" name="arrival_date"
                value=<?php echo $_POST['arrival_date']; ?> required>
            <input id="dr-date" type="date" placeholder="Odjazd" name="departure_date"
                value=<?php echo $_POST['departure_date']; ?> required>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="button" value="Filtruj" />
        </form>
    </div>

    <div id="list-of-rooms">
        <?php include 'database.php';?>
    </div>

    <div id="footer">
        Autor: Kacper Ołdziejewski & Miłosz Przekop
    </div>

</body>

</html>