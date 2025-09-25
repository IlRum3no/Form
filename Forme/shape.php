<html>

<?php

    $valore= $_GET["n"];
    $getForma = $_GET["forma"];

    if($getForma == "triangolo"){
        for($i = 1; $i <= $valore; $i++){
            for($j = 1; $j <= $i; $j++){
                echo "#";
            }
            echo "<br>";
        }
    } else if($getForma == "reverseTriangolo"){
        for($i = 1; $i <= $valore; $i++){
            for($j = 1; $j <= $valore; $j++){
                if($i > $j){
                    echo "&nbsp  ";
                } else {
                    echo "#";
                }
            }
            echo "<br>";
        }
    } else if($getForma == "quadrato"){
        for($i = 1; $i <= $valore; $i++){
            for($j = 1; $j <= $valore; $j++){
                echo "#";
            }
            echo "<br>";
        }
    } else if($getForma == "cornice"){
        for($i = 1; $i <= $valore; $i++){
            for($j = 1; $j <= $valore; $j++){
                if($i == 1 || $j == 1 || $i == $valore || $j == $valore){
                    echo "#";
                } else{
                    echo "&nbsp  ";
                }
            }
            echo "<br>";
        }
    }
?>
<a href="forma.html">Torna Indietro</a>
</html>