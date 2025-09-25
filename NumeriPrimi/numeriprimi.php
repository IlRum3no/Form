<html>
<?php

function IsPrimo($numero){
    if($numero < 2){
        return false;
    }
    for($i = 2; $i < $numero; $i++){
        if($numero % $i == 0){
            return false;
        }
    }
    return true;
}

function stampaPrimi($n) {
    $primi_trovati = 0;
    $numero = 2;

    while ($primi_trovati < $n) {
        if (isPrimo($numero)) {
            echo $numero;
            if ($primi_trovati < $n - 1) echo ", ";
            $primi_trovati++;
        }
        $numero++;
    }
}

function stampaPrimiIntervallo($a, $b) {
    $trovato = false;
    for ($i = $a; $i <= $b; $i++) {
        if (isPrimo($i)) {
            echo $i . ", ";
            $trovato = true;
        }
    }
    if (!$trovato) {
        echo "Nessun numero primo nell'intervallo [$a; $b]";
    }
}

    if (!empty($_POST["n"])) {
        $n = (int) $_POST["n"];
        stampaPrimi($n);
        echo "<br>";
    }

    if (!empty($_POST["a"]) && !empty($_POST["b"])) {
        $a = (int) $_POST["a"];
        $b = (int) $_POST["b"];
        stampaPrimiIntervallo($a, $b);
        echo "<br>";
    }

?>
<a href="numeriprimi.html">Torna Indietro</a>
</html>
