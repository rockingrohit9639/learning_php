<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss - Search Results</title>
</head>

<body>
    <?php include "./partials/_header.php";
    include "./partials/_dbconnect.php"; ?>

    <?php 
        $search = $_GET["search"];
        $sql = "SELECT * FROM threads WHERE thread_title LIKE '%$search%' || thread_desc LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);
        $resultCount = mysqli_num_rows($result);
    ?>

    <div class="container mt-4">
        <h2 class="text-center">Search Results (<?php echo $resultCount;?>)</h2>
        <hr>


        <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $no_result = false;
                $userSql = 'SELECT username FROM users WHERE user_id = '. $row["thread_user_id"] .'';
                $userRes = mysqli_query($conn, $userSql);
                $user = mysqli_fetch_assoc($userRes);
                $uname = $user["username"];
    
                echo '<div class="d-flex my-4">
                        <div class="flex-shrink-0">
                            <img src="http://source.unsplash.com/50x40/?user" class="rounded" alt="user">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <p class="text-bold mb-0">'. $uname .'</p>
                            <a href="/rohit/onlineforum/thread.php?threadid=' . $row["thread_id"] . '" class="text-dark"><h4>' . $row["thread_title"] . '</h4></a>
                            ' . $row["thread_desc"] . '
                        </div>
                    </div>';
            }
        ?>

    </div>


    <?php include "./partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>