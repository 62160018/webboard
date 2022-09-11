<?php
session_start();
require_once 'config/db.php';

if (isset($_SESSION['u_id'])) {
    $uid = $_SESSION['u_id'];
}


$query = $connection->prepare("SELECT * FROM users WHERE u_id=:uid");

$query->bindParam("uid", $uid, PDO::PARAM_STR);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>TikTalk</title>
</head>

<body>

    <div class="board d-flex flex-column justify-content-center mb-3">
        <div class="board--container d-flex">
            <div class="board--body d-flex flex-column">
                <div class="board--header d-flex">

                    <div class="p-2 flex-grow-1 bd-highlight">
                        <h1 class="topic">TikTalk</h1>
                    </div>

                    <?php
                    if (isset($_SESSION['u_id'])) {

                    ?>

                        <div class="p-2 bd-highlight">
                            <a href="addboard.php?id=<?php echo $uid ?>" class="btn btn-dark">ตั้งกระทู้ - ตั้งหัวข้อใหม่</a>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="p-2 bd-highlight">
                            <button class="btn btn-dark isDisabled" disabled>ตั้งกระทู้ - ตั้งหัวข้อใหม่</button>
                        </div>

                    <?php
                    }
                    ?>
                </div>

                <div class="board--content">

                    <?php
                    $num = 0;
                    $board = $connection->prepare("SELECT * FROM board_main ORDER BY bm_date DESC");
                    $board->execute();
                    $boards = $board->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($boards as $row) {
                    ?>


                        <div class="d-flex bd-highlight mb-3">
                            <div class="a p-2 flex-grow-1 bd-highlight">
                                <a href="detail.php?bm_id=<?php echo $row['bm_id'] ?>" style="text-decoration:none; color:black;">
                                    <?php echo $row['bm_title'] ?>
                                </a>
                            </div>
                            <?php
                            $bm_cg = $connection->prepare("SELECT * FROM category WHERE cg_id = :cg_id");
                            $bm_cg->bindParam("cg_id", $row['cg_id'], PDO::PARAM_STR);
                            $bm_cg->execute();
                            $bm_cgs = $bm_cg->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <div class="b p-2 bd-highlight"><?php echo $bm_cgs['cg_name'] ?></div>

                            <?php
                            if (isset($_SESSION['u_id']) && $row['u_id'] == $uid) {
                            ?>
                                <div class="b p-2 bd-highlight" style="background-color: #f9bdbb;">
                                    <a href="edit_bm_title.php?bme=<?php echo $row['bm_id'] ?>" style="text-decoration:none; color:black;">ลบ/แก้ไข</a>
                                </div>

                            <?php
                            }
                            ?>

                        </div>

                    <?php
                    }
                    ?>
                    <?php
                    if ($board->rowCount() == 0) {
                    ?>
                        <div class="d-flex bd-highlight mb-3">
                            <p>ไม่มีกระทู้</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <?php

            if (isset($_SESSION['u_id'])) {

            ?>
                <div class="board--profile">
                    <div class="profile-img">
                        <img src="img/user_profile/<?php echo $result['img'] ?>" alt="">
                    </div>
                    <hr>
                    <div class="username">
                        <p><?php echo $result['fullname']  ?></p>
                    </div>
                    <?php
                    if ($result['type'] == 1) {
                    ?>
                        <hr>
                        <a href="admin/admin.php" class="btn btn-dark">หน้าแอดมิน</a>
                    <?php
                    }
                    ?>
                    <hr>
                    <a href="edit_profile.php?id=<?php echo $result['u_id'] ?>" class="btn btn-primary">แก้ไขโปรไฟล์</a>
                    <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
                </div>

            <?php
            } else {
            ?>

                <div class="board--profile">
                    <hr>
                    <div class="username">
                        <p>ยังไม่ได้เข้าสู่ระบบ</p>
                    </div>
                    <hr>
                    <a href="login.php" class="btn btn-outline-primary">เข้าสู่ระบบ</a>
                    <a href="register.php" class="btn btn-outline-dark">สมัครสมาชิก</a>
                </div>

            <?php
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>