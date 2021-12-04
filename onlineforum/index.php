<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iDiscuss - A Coding Forum</title>
</head>

<body>
    <?php include "./partials/_header.php";
    include "./partials/_dbconnect.php"; ?>

     <!-- slider start  -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="http://source.unsplash.com/1800x500/?python,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="http://source.unsplash.com/1800x500/?javascript,coding" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="http://source.unsplash.com/1800x500/?php,coding" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- slider end  -->

    <div class="container mt-2">
        <h2 class="text-center my-2">iDiscuss | Categories</h2>
        <div class="row mt-4">

            <?php

            // Fetching categories from database 
            $all_cat_sql = "SELECT * FROM categories";
            $all_cat = mysqli_query($conn, $all_cat_sql);

            while ($row = mysqli_fetch_assoc($all_cat)) {
                echo '<div class="col-md-4 mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="http://source.unsplash.com/500x400/?python,coding" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $row["category_name"] . '</h5>
                                    <p class="card-text">' . $row["category_desc"] . '</p>
                                    <a href="#" class="btn btn-primary">View Threads</a>
                                </div>
                            </div>
                        </div>';
            }

            ?>
        </div>

    </div>



    <?php include "./partials/_footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>