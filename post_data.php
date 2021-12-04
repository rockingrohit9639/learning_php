<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Post Data</title>
</head>

<body>

    <?php
        include "_dbconnect.php"; // throws only warning if file is not there and proceed
        require "_dbconnect.php"; // stops the further execution if file is not there
    ?>

    <form class="container" action="/rohit/handle_post_data.php" method="POST">
        <h1 class="center my-5">Post Form Data in Database</h1>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Rohit Saini">
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="text" name="age" class="form-control" placeholder="21">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <div class="container mt-5">
        <h1>Data in Database</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $query = "SELECT * FROM firsttable";
                $res = mysqli_query($conn, $query);
                $num = mysqli_num_rows($res);

                // Displaying the rows
                if ($num > 0) {

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['age'] . "</td></tr>";
                    }
                }


                ?>

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>