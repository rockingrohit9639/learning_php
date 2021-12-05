<?php

include "./partials/_dbconnect.php";

$error = false;
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $threadTitle = $_POST["threadTitle"];
    $threadDesc = $_POST["threadDesc"];
    $catId = $_GET["category"];
    $userId = $_POST["userId"];
    $threadInsertSql = "INSERT INTO `threads`(`thread_title`, `thread_desc`, `thread_category_id`, `thread_user_id`, `timestamp`) VALUES ('$threadTitle','$threadDesc','$catId','$userId',current_timestamp())";
    $res = mysqli_query($conn, $threadInsertSql);

    if (!$res) {
        $error = "Could not create your thread. Please try again.";
    } else {
        $success = "Successfully created your thread.";
    }
}


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss - A Coding Forum</title>
</head>

<body>
    <?php include "./partials/_header.php"; ?>

    <?php
    $category = $_GET["category"];
    $cat_sql = "SELECT * FROM `categories` WHERE `category_id` = '$category'";
    $result = mysqli_query($conn, $cat_sql);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $num = mysqli_num_rows($result);

    if ($num >= 1) {
        $name =  $data["category_name"];
        $desc = $data["category_desc"];
    } else {
        header("location: index.php");
        exit;
    }

    if ($error) {
        echo   '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Ooops !!</strong> ' . $error . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif ($success) {
        echo   '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !!</strong> ' . $success . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    }
    ?>



    <div class="container mt-4">
        <h1>Welcome to <?php echo $name; ?> forum</h1>
        <p class="lead"><?php echo $desc; ?></p>
        <hr class="my-4">
    </div>

    <div class="container mt-3">
        <h3 class="mb-3">Start a discussion</h3>
        <form action="/rohit/onlineforum/threadlist.php?category=<?php echo "$category"; ?>" method="POST">
            <input type="hidden" name="userId" value="0">
            <div class="mb-3">
                <label for="threadTitle" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="threadTitle" name="threadTitle" required>
            </div>
            <div class="mb-3">
                <label for="threadDesc" class="form-label">Problem Description</label>
                <textarea class="form-control" requried id="threadDesc" name="threadDesc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <div class="container" style="min-height: 600px;">
        <h3 class="my-5">Browse Questions</h3>

        <?php
        $category = $_GET["category"];
        $thread_sql = "SELECT * FROM `threads` WHERE `thread_category_id` = '$category'";
        $threads = mysqli_query($conn, $thread_sql);
        $no_result = true;
        while ($row = mysqli_fetch_assoc($threads)) {
            $no_result = false;
            echo '<div class="d-flex my-4">
                    <div class="flex-shrink-0">
                        <img src="http://source.unsplash.com/50x40/?user" class="rounded" alt="user">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <a href="/rohit/onlineforum/thread.php?threadid=' . $row["thread_id"] . '" class="text-dark"><h4>' . $row["thread_title"] . '</h4></a>
                        ' . $row["thread_desc"] . '
                    </div>
                </div>';
        }

        if ($no_result) {
            echo "<h6 class='text-muted'>Be the first one to ask a question</h6>";
        }
        ?>
    </div>

    <?php include "./partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>