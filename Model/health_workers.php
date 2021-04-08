<?php
function get_all_health_workers($link) {

    $sql = "SELECT * FROM person,publicHealthWorker WHERE person.medicareNum = publicHealthWorker.workerId";
    $select_stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_execute($select_stmt);
    $workers = mysqli_stmt_get_result($select_stmt);
    mysqli_stmt_close($select_stmt);

    return $workers;
}
?>