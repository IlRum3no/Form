<html>
    <head>Sminatore Matematico</head>
<body>

<?php
session_start();

if (!isset($_SESSION['mosse'])) {
    $_SESSION['mosse'] = 0;
}
if (!isset($_SESSION['difficolta'])) {
    $_SESSION['difficolta'] = "";
}
if (!isset($_SESSION['lista'])) {
    $_SESSION['lista'] = [];
}
if (!isset($_SESSION['arrayprimi'])) {
    $_SESSION['arrayprimi'] = [];
}

if (isset($_POST['scelta']) && $_POST['scelta'] != "") {
    $_SESSION['difficolta'] = $_POST['scelta'];
}
function isPrimos($numero){
    $count = 0;
    for ($i=1; $i <= $numero ; $i++) {
        if ($numero % $i == 0) {
            $count++;
        }
    }
    if ($count == 2){
        return true;
    } else {
        return false;
    }
}
function creaLista($numeros, &$arrayprimi){
    $traccia = 0;
    $i = 2;
    while($traccia < $numeros) {

        if (isPrimos($i)) {
            $arrayprimi[] = $i;   // aggiunge il numero primo all’array
            $traccia++;

        }
        $i++;
    }
}
function incrementaMossa(){
    if (!isset($_SESSION['mosse'])) {
        $_SESSION['mosse'] = 0;
    }
    $_SESSION['mosse'] += 1;
}
function getMosse($numero){
    echo "Hai fatto: $numero mosse <br>";
}
function generaNum(&$lista, &$arrayprimi){
    for ($i = 0; $i < count($arrayprimi); $i++){
        $pescato = array_rand($arrayprimi,3); //funzione che estrae 3 nnumeri casuali dalla funzione
        $a = $arrayprimi[$pescato[0]];
        $b = $arrayprimi[$pescato[1]];
        $c = $arrayprimi[$pescato[2]];

        $moltiplicatore = rand(1, 20);
        $lista[] = $a * $b * $c * $moltiplicatore;
    }
}

$arrayprimi = $_SESSION['arrayprimi'] ?? [];
$lista = $_SESSION['lista'] ?? [];

$difficolta = $_SESSION['difficolta'] ?? "";

// Aggiorna difficoltà e lista solo quando si preme "Genera"
$valore = 0;
if(isset($_POST['NumMag'])){
    $valore = $_POST['NumMag'];
}

    if (isset($_POST['azione'])) {
        if ($_POST['azione'] === "Nuova partita") {
            $_SESSION['mosse'] = 0;
            $_SESSION['difficolta'] = "";
            $_SESSION['lista'] = [];
            $_SESSION['arrayprimi'] = [];
            // Aggiorna anche le variabili locali per farle riflettere subito
            $mosse = $_SESSION['mosse'];
            $difficolta = $_SESSION['difficolta'];
            $lista = $_SESSION['lista'];
            $arrayprimi = $_SESSION['arrayprimi'];
        } elseif ($_POST['azione'] === "Cancella") {
            // Gestione del pulsante Cancella
            if (isset($_POST['azione']) && $_POST['azione'] === "Cancella") {
                if (isset($_POST['NumMag']) && is_numeric($_POST['NumMag'])) {
                    $divisore = intval($_POST['NumMag']);
                    if ($divisore != 0) {
                        // Filtra la lista rimuovendo i numeri divisibili per $divisore
                        $lista = array_filter($lista, function($val) use ($divisore) {
                            return $val % $divisore != 0;
                        });
                        // Aggiorna la lista nella sessione
                        $_SESSION['lista'] = $lista;

                        // Incrementa le mosse
                        incrementaMossa();
                    } else {
                        echo "Attenzione: non puoi dividere per zero!<br>";
                    }
                } else {
                    echo "Attenzione: inserisci un numero valido!<br>";
                }
            }
        } elseif ($_POST['azione'] === "Genera") {
            if (isset($_POST['scelta']) && $_POST['scelta'] != "") {
                $_SESSION['difficolta'] = $_POST['scelta'];
                $difficolta = $_SESSION['difficolta'];

                $arrayprimi = [];
                $lista = [];

                if ($difficolta === "3") {
                    creaLista(3, $arrayprimi);
                } elseif ($difficolta === "7") {
                    creaLista(7, $arrayprimi);
                } elseif ($difficolta === "21") {
                    creaLista(21, $arrayprimi);
                }
                generaNum($lista, $arrayprimi);

                $_SESSION['arrayprimi'] = $arrayprimi;
                $_SESSION['lista'] = $lista;
            }
        }
    }
?>

<form action="SminatoreMat.php" method="post">
        Scegli la difficoltà
        <select name="scelta">
            <option value=""></option>
            <option value="3">difficoltà 3</option>
            <option value="7">difficoltà 7</option>
            <option value="21">difficoltà 21</option>
        </select>
        <input type="submit" value="Genera" name="azione"> <br><br>
    Numeri Generati: [<?php echo implode(",",$lista);?>]
        <br><br>
        Inserisci il numero con cui dividere<input type="text" name="NumMag">
        <input type="Submit" value="Cancella" name="azione">
        <input type="Submit" value="Nuova partita" name="azione">
    <br>
    <?php
    getMosse($_SESSION['mosse']);
    ?>
    </form>
</body>

©️Timotei Sorea
</html>
