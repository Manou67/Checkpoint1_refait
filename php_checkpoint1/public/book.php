<?php
include '../db/connec.php';
$pdo = new PDO(DSN, USER, PASS);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/book.css">
    <title>Checkpoint PHP 1</title>
</head>
<body>

<?php include 'header.php'; ?>


<main>
    <div class="index">

    <?php
    foreach (range('A', 'Z') as $letter) {
        echo $letter;}
    ?>
    </div>

    <div class="container">
        <div class="desktop">
        <img class="whisky" src="image/whisky.png" alt="a whisky glass" width="200px"/>
        <img class="empty" src="image/empty_whisky.png" alt="an empty glass"/>
        </div>

        <div class="pages">
            <div class="page leftpage">
                <?php
                if(isset($_POST['submit'])) {
                    $errors=[];

                    if (empty($_POST['name']) || empty($_POST['payment'])) {
                        $errors[] = 'Oh no...these is a problem with your bride, your name or payment is empty, please solve this ASAP!';
                    }
                    if ($_POST['payment'] < 0) {
                        $errors[] =  'Oh no...Your bride is too low, if you don\'t solve this problem, you will have to look behind you when you walked outside...';
                    }
                    if (!empty($_POST['name']) && ($_POST['name'])  == 'Eliott Ness') {
                        $errors[] = 'This man is untouchable...watch out!';
                    }
                    if (empty($errors)) {
                        $sql = "INSERT INTO bribe VALUES (null, :name, :payment)";
                        $prepa= $pdo->prepare($sql);
                        $prepa->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
                        $prepa->bindValue(':payment', $_POST['payment'], PDO::PARAM_INT);
                        $prepa->execute();
                        echo '<h6 style="text-align: center">' . 'Thank you for your cooperation! Your bribe has been added and you will not have any problem with us' . '</h6>';
                    }
                    foreach ($errors as $error) { ?>
                        <span class="error"><?= $error; ?></span></br>
                    <?php }
                }
                ?>
                Add a bribe

                <form method="post">
                    <div class="form">
                        <label for="name">Name</label>
                        <input type="text" name="name" value=""/>
                    </div>
                    <div class="form">
                        <label for="payment">Payment</label>
                        <input type="text" name="payment" value="<?php echo isset($_POST['name']); ?>"/>
                    </div>
                    <input type="submit" name="submit" value="Pay!"/>
                </form>

            </div>

            <div class="page rightpage">
                <?php
                $sql = "SELECT name, payment FROM bribe ORDER BY name ASC";
                $resultat = $pdo->query($sql)->fetchAll();
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <td scope="col" style="border-bottom: 1px solid black">S</td>
                        <td scope="col" style="border-bottom: 1px solid black"></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($resultat as $value){
                        echo'<tr>';
                        echo'<td>'.$value['name'].'</td>';
                        echo'<td>'.$value['payment'].'€</td>';
                        echo'</tr>';
                        }
                    echo'<tr>';
                    echo'<td></td>';
                    echo'<td style="border-top: 1px solid black"></td>';
                    echo'</tr>';
                    ?>
                    </tbody>
                    <tfoot>
                    <?php
                    echo '</hr>';
                    echo '<td>Total</td>';
                    $sql = 'SELECT SUM(payment) FROM bribe';
                    $somme = $pdo->query($sql)->fetch();
                    echo'<td>'. $somme [0].'€</td>';
                    ?>
                    </tfoot>
                </table>
            </div>
        </div>

            <div class="inkpen">
                <img src="image/inkpen.png" alt="an ink pen" height="350" />
            </div>

        </div>

</main>
</body>
</html>