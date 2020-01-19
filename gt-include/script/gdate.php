<?php
if (isset($_POST['add_to_datee'])) {
    $datee = $_POST['datee'];
    $add = $_POST['add'];
    echo add_to_datee($datee, $add);
    exit();
}

if (isset($_POST['minus_from_datee'])) {
    $datee2 = $_POST['datee2'];
    $datee1 = $_POST['datee1'];
    echo timeDiff($datee2, $datee1);
    exit();
}