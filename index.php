<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Formularz kontaktowy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Formularz kontaktowy</h2>

    <form method="POST">
        <input type="text" name="imie" placeholder="Imię" required>
        <input type="text" name="nazwisko" placeholder="Nazwisko" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="temat" placeholder="Temat" required>
        <textarea name="wiadomosc" placeholder="Treść wiadomości" required></textarea>

        <button type="submit">Wyślij</button>
    </form>

    <hr>

    <?php

    $plik = "dane.txt";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $imie = $_POST["imie"];
        $nazwisko = $_POST["nazwisko"];
        $email = $_POST["email"];
        $temat = $_POST["temat"];
        $wiadomosc = $_POST["wiadomosc"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p class='error'>❌ Niepoprawny email!</p>";
        } else {
            $dane = "$imie|$nazwisko|$email|$temat|$wiadomosc\n";
            file_put_contents($plik, $dane, FILE_APPEND);
            echo "<p class='success'>✅ Wiadomość zapisana!</p>";
        }
    }

    if (file_exists($plik)) {

        $linie = file($plik);

        echo "<h3>Wiadomości:</h3>";
        echo "<table>";

        foreach ($linie as $linia) {
            $dane = explode("|", $linia);

            echo "<tr>";
            foreach ($dane as $pole) {
                echo "<td>$pole</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</div>

</body>
</html>