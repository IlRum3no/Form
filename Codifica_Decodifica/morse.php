<!DOCTYPE HTML>
<html>

<head>
    <meta  charset="Big5">
    <title>Morse Code</title>
</head>

<body>

<?php
$alfabeto = array(
    "A" => ".-",
    "B" => "-...",
    "C" => "-.-.",
    "D" => "-..",
    "E" => ".",
    "F" => "..-.",
    "G" => "--.",
    "H" => "....",
    "I" => "..",
    "J" => ".---",
    "K" => "-.-",
    "L" => ".-..",
    "M" => "--",
    "N" => "-.",
    "O" => "---",
    "P" => ".--.",
    "Q" => "--.-",
    "R" => ".-.",
    "S" => "...",
    "T" => "-",
    "U" => "..-",
    "V" => "...-",
    "W" => ".--",
    "X" => "-..-",
    "Y" => "-.--",
    "Z" => "--..",
    " " => "/",
);
$alfabetomorse = array(
    ".-" => "A",
    "-..." => "B",
    "-.-." => "C",
    "-.." => "D",
    "." => "E",
    "..-." => "F",
    "--." => "G",
    "...." => "H",
    ".." => "I",
    ".---" => "J",
    "-.-" => "K",
    ".-.." => "L",
    "--" => "M",
    "-." => "N",
    "---" => "O",
    ".--." => "P",
    "--.-" => "Q",
    ".-." => "R",
    "..." => "S",
    "-" => "T",
    "..-" => "U",
    "...-" => "V",
    ".--" => "W",
    "-..-" => "X",
    "-.--" => "Y",
    "--.." => "Z",
    "/" => " ",
);
$morse = "";
if(isset($_POST["lettera"])){
    $testo = strtoupper($_POST["lettera"]);

    for ($i=0; $i< strlen($testo); $i++) {
        $lettera = $testo[$i];
        if(isset($alfabeto[$lettera])){
            $morse .= $alfabeto[$lettera] . " ";
        }
    }

}

$carattere = "";
if (isset($_POST["morsecode"])) {
    $morseInserito = $_POST["morsecode"];
    $letterina = explode(" ", $morseInserito);

    for ($i = 0; $i < count($letterina); $i++) {
        $charito = $letterina[$i];
        if (isset($alfabetomorse[$charito])) {
            $carattere .= $alfabetomorse[$charito] . " ";
        }
    }
}

?>
    <form action="morse.php" method="post">
        <label>Carattere: </label>
        <input type="text" value="<?php echo $carattere ?>" name="lettera"><br>

        <input type="submit" value="Traduci a morse"><br>
        <br>
        <label>Morse: </label>
        <input type="text" value="<?php echo $morse ?>" name="morsecode" ><br>
        <input type="submit" value="Traduci a carattere"><br>

    </form>
<br>
<a href="morse.php">Annulla operazione</a>


</body>

</html>
