<?php

include "./partials/_dbconnect.php";

$error = false;
$success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = $_POST["comment"];
    $threadId = $_GET["threadid"];
    $userId = $_POST["userId"];
    $commentSql = "INSERT INTO `comments`(`comment_content`, `thread_id`, `user_id` , `comment_time`) VALUES ('$comment','$threadId', '$userId' ,current_timestamp())";
    $res = mysqli_query($conn, $commentSql);

    if (!$res) {
        $error = "Could not add your comment. Please try again.";
    } else {
        $success = "Comment added successfully.";
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
    <?php include "./partials/_header.php";
    include "./partials/_dbconnect.php"; ?>

    <?php
    $thread_id = $_GET["threadid"];
    $thread_sql = "SELECT * FROM `threads` WHERE `thread_id` = '$thread_id'";
    $result = mysqli_query($conn, $thread_sql);
    $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $num = mysqli_num_rows($result);

    if ($num >= 1) {
        $thread_title =  $data["thread_title"];
        $thread_desc = $data["thread_desc"];
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
        <h3 class="py-3"> <?php echo $thread_title; ?> </h3>
        <p class="lead"><?php echo $thread_desc; ?></p>
    </div>

    <?php

    if(isset($_SESSION['loggedin']) || $_SESSION == true){
    echo '<div class="container mt-5">
        <h1>Post a comment</h1>

        <form action="/rohit/onlineforum/thread.php?threadid='.$thread_id.'" method="POST">
            <div class="mb-3">
                <input type="hidden" name="userId" value="'. $_SESSION["userid"] .'">
                <label for="threadDesc" class="form-label">Type your comment</label>
                <textarea class="form-control" requried id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post</button>
        </form>
    </div>';
    }
    else {
        echo "
        <div class='container'>
        <h3 class='mb-3'>Post a comment</h3>
        Please login to start a discussion.
        </div>";
    }
    ?>

    <div class="container mt-5">
        <h1>Discussion</h1>
        <hr>

        <?php
        $threadId = $_GET["threadid"];
        $comment_sql = "SELECT * FROM `comments` WHERE `thread_id` = '$threadId'";
        $allComments = mysqli_query($conn, $comment_sql);
        $no_result = true;
        while ($row = mysqli_fetch_assoc($allComments)) {
            $no_result = false;
            $userSql = 'SELECT username FROM users WHERE user_id = '. $row["user_id"] .'';
            $userRes = mysqli_query($conn, $userSql);
            $user = mysqli_fetch_assoc($userRes);
            $uname = $user["username"];

            echo '<div class="d-flex my-4">
                    <div class="flex-shrink-0">
                        <img src="http://source.unsplash.com/50x40/?user" class="rounded" alt="user">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="d-flex">
                            <h5>'. $uname .'</h5>
                            <p class="text-muted">'. $row["comment_time"] .'</p>
                        </div>
                        ' . $row["comment_content"] . '
                    </div>
                </div>';
        }

        if ($no_result) {
            echo "<h6 class='text-muted'>Be the saviour of this man.</h6>";
        }
        ?>
    </div>

    <?php include "./partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>