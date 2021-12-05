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
    ?>

    <div class="container mt-4">
        <h3 class="py-3"> <?php echo $thread_title; ?> </h3>
        <p class="lead"><?php echo $thread_desc; ?></p>
    </div>

    <div class="container mt-5">
        <h1>Discussion</h1>
        <hr>
    </div>

    <?php include "./partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>