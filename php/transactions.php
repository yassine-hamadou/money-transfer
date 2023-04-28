<?php 
  session_start();
  if ($_SESSION['Logged'] !== true) {
    header("Location: ../html/loginpage.php");
  }
  require_once '../includes/db.php';
?>

<!doctype html>
<html lang="en">

<?php include '../includes/dashead.php';?>

<body>

    <?php include '../includes/dasheader.php';?>
    <?php include '../includes/dashnav.php';?>
    <main class="col-md-9 ms-sm-auto col-lg-10">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">TransactionID</th>
                        <th scope="col">Sender</th>
                        <th scope="col">Receiver</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    $sender = $_SESSION["id"];
                    $sql = "SELECT * FROM transactions WHERE sender_id = '$sender' OR receiver_id = '$sender'";
                    $sql2 = "SELECT CONCAT(`prefix`, `#`) AS 'transactionId' FROM transactions WHERE sender_id = '$sender' OR receiver_id = '$sender';";
                    $result = mysqli_query($db, $sql);
                    $result2 = mysqli_query($db, $sql2);

                    while(($row = mysqli_fetch_assoc($result)) && ($transactionId = mysqli_fetch_assoc($result2))) {
                      //replacing account number to display my account 
                      if ($row['sender_id'] === $sender) {
                        $row['sender_id'] = 'My account';
                      }
                      if ($row['receiver_id'] === $sender) {
                        $row['receiver_id'] = 'My account';
                      }
                      echo "<tr>";
                      //Making the transaction IDs more elaborate with alphanumeric characters
                      echo "<td>".$transactionId['transactionId']."</td>";
                      echo "<td>".$row['sender_id']."</td>";
                      echo "<td>".$row['receiver_id']."</td>";
                      echo "<td>".$row['amount']."</td>";
                      echo "<td>".$row['time']."</td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include '../includes/script.php';?>
</body>

</html>