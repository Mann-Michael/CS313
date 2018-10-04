<?php
    $i = rand(0 , 5);
    echo nl2br("i = " . $i . ", for sure!\n\n");

    switch ($i) {
        case 0:
            echo "i = zero";
            break;
        case 1:
            echo "i = one";
            break;
        case 2:
            echo "i = two";
            break;
        default:
           echo "i does not = zero, one, or two";
    }
?>