<html>
    <head>
        <title>Random Grades</title>
        <meta lang="it">
    </head>

<body>
<?php

if (isset($_POST['cognome']) || isset($_POST['nome']) || isset($_POST['materia']) || isset($_POST['classe'])) {
    $cognome = trim($_POST["cognome"]);
    $nome = trim($_POST["nome"]);
    $materia = trim($_POST["materia"]);
    $classe = trim($_POST["classe"]);

    $file = fopen("random-grades.csv", "r");
    if ($file) {
        $somma = 0;
        $count = 0;
        $sum = 0;
        $conta = 0;
        while (($line = fgets($file)) !== false) {

            $campi = explode(",", $line);

            if ($campi[0] == $cognome && $campi[1] == $nome && $campi[3] == $materia && $campi[2] == $classe) {
                $voto = trim($campi[5]);
                $somma += floatval($voto);
                $count++;
            }
            $voti = trim($campi[5]);
            $sum += floatval($voti);
            $conta++;

        }
        fclose($file);

        if ($count > 0) {
            $media = $somma / $count;
        } else {
            print("Nessuno voto trovato"). "<br>";
        }
        if ($conta > 0) {
            $meida = $sum / $conta;
        } else {
            print("Nessuno voto trovato"). "<br>";
        }
    }
}

?>

    <form action="Random_Grades.php" method="post">
        <label>
            Inserisci il cognome dello studente
            <input type="text" value="" name="cognome"><br>
        </label>
        <label>
            Inserisci il nome dello studente
            <input type="text" value="" name="nome"><br>
        </label>
        <label for="materia">
            Scegli la materia dello studente
            <select name="materia" id="materia">
                <option value=""></option>
                <option value="Matematica">Matematica</option>
                <option value="Religione Cattolica">Religione</option>
                <option value="Informatica">Informatica</option>
                <option value="Scienze Motorie e Sportive">Scienze Motorie</option>
                <option value="Lingua Inglese">Inglese</option>
                <option value="Sitemi e Reti">Sistemi e Reti</option>
                <option value="Gestione Progetto e Organizzazione d'Impresa">GPOI</option>
                <option value="Tecnologie e Progettazione di Sistemi Informatici e di Telecomunicazioni">TEPSIT</option>
                <option value="Storia">Storia</option>
                <option value="Lingua e Letteratura Italiana">Italiano</option>
            </select>
            <br>
        </label>
        <label for="classe">
            Insersci la classe dello studente
            <select name="classe" id="classe">
                <option value=""></option>
                <option value="5CIT">5</option>
                <option value="4BIT">4</option>
                <option value="3BIT">3</option>
            </select>
            <br>
        </label>
        <label>
            Media voto dello studente
            <input type="text" value="<?php echo $media ?>"><br>
        </label>
        <label>
            Media voti di tutti gli studenti
            <input type="text" value="<?php echo $meida ?>"><br>
        </label>

        <label>
            <input type="submit" value="Trova"><br>
        </label>
    </form>

<br>
<a href="Random_Grades.php">☞ Ripeti azione</a><br>



</body>



</html>



