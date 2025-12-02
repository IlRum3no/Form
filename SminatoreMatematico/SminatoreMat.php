<html>
    <head>
        Sminatore Matematico
        <title>Sminatore Matematico</title>
    </head>
    <br>
<body>

<?php
// Inizio sessione
session_start();

// Inizializza variabili di sessione se non esistono
if (!isset($_SESSION['mosse'])) $_SESSION['mosse'] = 0;
if (!isset($_SESSION['difficolta'])) $_SESSION['difficolta'] = "";
if (!isset($_SESSION['lista'])) $_SESSION['lista'] = [];
if (!isset($_SESSION['arrayprimi'])) $_SESSION['arrayprimi'] = [];

//funzioni
function isPrimos($numero){
    $count = 0;
    for ($i=1; $i <= $numero ; $i++) {
        if ($numero % $i == 0) $count++;
    }
    return $count == 2;
}

function creaLista($numeros, &$arrayprimi){
    $traccia = 0;
    $i = 2;
    while($traccia < $numeros) {
        if (isPrimos($i)) {
            $arrayprimi[] = $i;
            $traccia++;
        }
        $i++;
    }
}

function generaNum(&$lista, &$arrayprimi){
    for ($i = 0; $i < count($arrayprimi); $i++){
        $pescato = array_rand($arrayprimi,3);
        $a = $arrayprimi[$pescato[0]];
        $b = $arrayprimi[$pescato[1]];
        $c = $arrayprimi[$pescato[2]];
        $moltiplicatore = rand(1, 20);
        $lista[] = $a * $b * $c * $moltiplicatore;
    }
}

function incrementaMossa(){
    $_SESSION['mosse'] += 1;
}

function getMosse($numero){
    echo "Hai fatto: $numero mosse <br>";
}

// Carica variabili locali dalla sessione
$lista = $_SESSION['lista'];
$arrayprimi = $_SESSION['arrayprimi'];
$difficolta = $_SESSION['difficolta'];


// Gestione dei pulsanti
if (isset($_POST['azione'])) {
    if ($_POST['azione'] === "Nuova partita") {
        $_SESSION['mosse'] = 0;
        $_SESSION['difficolta'] = "";
        $_SESSION['lista'] = [];
        $_SESSION['arrayprimi'] = [];
        
    } elseif ($_POST['azione'] === "Cancella") {
        if (isset($_POST['NumMag']) && is_numeric($_POST['NumMag'])) {
            $divisore = intval($_POST['NumMag']);
            if ($divisore != 0 && $divisore != 1) {
                $nuovaLista = [];
                foreach ($lista as $valore) {
                    if ($valore % $divisore != 0) {
                        $nuovaLista[] = $valore;
                    }
                }
                $lista = $nuovaLista;
                $_SESSION['lista'] = $lista;
                incrementaMossa();
            } else {
                echo "Attenzione: non puoi dividere per zero/uno!<br>";
            }
        } else {
            echo "Attenzione: inserisci un numero valido!<br>";
        }
    } elseif ($_POST['azione'] === "Genera") {
        $_SESSION['mosse'] = 0;
        if (isset($_POST['scelta']) && $_POST['scelta'] != "") {
            $_SESSION['difficolta'] = $_POST['scelta'];
            $difficolta = $_SESSION['difficolta'];

            $_SESSION['arrayprimi'] = [];
            $_SESSION['lista'] = [];
            $arrayprimi = $_SESSION['arrayprimi'];
            $lista = $_SESSION['lista'];

            creaLista(intval($difficolta), $_SESSION['arrayprimi']);
            generaNum($_SESSION['lista'], $_SESSION['arrayprimi']);
            $lista = $_SESSION['lista'];
            $arrayprimi = $_SESSION['arrayprimi'];
        } else if(isset($_POST['scelta'])){
            echo "Devi prima scegliere la difficolta!<br>";
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
    ©Timotei Sorea
</html>
