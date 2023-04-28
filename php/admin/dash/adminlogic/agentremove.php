<?php
include('../../../../includes/db.php');
include('../../../../includes/functions.php');
if (isset($_POST['remove'])) {
    $agentId = $_POST['agId'];
    $rAgentId = $_POST['ragId'];
    
    if ($agentId === $rAgentId) {
        //remove agent
        $query = "DELETE FROM agent WHERE Cashier_id = '$agentId'";
        $result = mysqli_query($db, $query);
        $affected_row = mysqli_affected_rows($db);
        if ($affected_row > 0) {
            header("Location: ../removeagent.php?agent=removed");
        } 
        else {
            header("Location: ../removeagent.php?agent=notRemoved");
        }
    }
    else {
        header("Location: ../removeagent.php?agent=idIncorrect");
    }
}
else {
    header("Location: ../removeagent.php?error=error");
}