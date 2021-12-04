<?php
//INSERT INTO `notes` (`sno`, `title`, `description`, `timestmp`) VALUES (NULL, 'First Note', 'This is first note using phpmyadmin', current_timestamp());
// Connecting to the databse
$database = "inotes";
$hostname = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Could not connect to the database" . mysqli_connect_error());
}

if (isset($_GET["delete"])) {
    $del_sno = $_GET['delete'];
    $del_query = "DELETE FROM notes WHERE `sno` = $del_sno";
    $res = mysqli_query($conn, $del_query);

    if (!$res) {
        echo "<div class='alert alert-danger alert-dismissible fade show mb-0' role='alert'>
    <strong>Failed!</strong> Could note delete note.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['snoEdit'])) {
        $editTitle = $_POST["titleEdit"];
        $editDesc = $_POST["descrEdit"];
        $sno = $_POST["snoEdit"];

        $update_query = "UPDATE `notes` SET `title` = '$editTitle', `description` = '$editDesc' WHERE `sno` = $sno";
        $res = mysqli_query($conn, $update_query);

        if (!$res) {
            echo "<div class='alert alert-danger alert-dismissible fade show mb-0' role='alert'>
        <strong>Failed!</strong> Could note update note.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        }
    } else {
        $title = $_POST["title"];
        $description = $_POST["descr"];

        $query = "INSERT INTO `notes` (`sno`, `title`, `description`, `timestmp`) VALUES (NULL, '$title', '$description', current_timestamp())";
        $res = mysqli_query($conn, $query);
        if (!$res) {
            echo "<div class='alert alert-danger alert-dismissible fade show mb-0' role='alert'>
        <strong>Failed!</strong> Could note insert note.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        }
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>iNotes</title>
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="container mt-3" action="/rohit/inotes/" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="descr" class="form-label">Description</label>
                            <textarea class="form-control" id="descrEdit" name="descrEdit" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-info text-white">Update Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/rohit/inotes">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/rohit/inotes">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form class="container mt-3" action="/rohit/inotes/" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="mb-3">
            <label for="descr" class="form-label">Description</label>
            <textarea class="form-control" name="descr" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-info text-white">Add Note</button>
    </form>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM notes";
                $res = mysqli_query($conn, $sql);
                $sno = 0;

                while ($row = mysqli_fetch_assoc($res)) {
                    $sno += 1;
                    echo "<tr>
                    <th scope='row'>" . $sno . "</th>
                    <td>" . $row["title"] . "</td>
                    <td>" . $row["description"] . "</td>
                    <td> <button class='btn btn-primary btn-sm mx-2 edit' id=" . $row['sno'] . ">Edit</button><button class='btn btn-primary btn-sm mx-2 delete' id=d-" . $row['sno'] . ">Delete</button></td>
                    </tr>";
                }
                ?>

                <!-- data-bs-toggle='modal' data-bs-target='#editModal'  -->
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        // Updating notes
        const edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach(elem => {
            elem.addEventListener("click", (e) => {
                const tr = e.target.parentNode.parentNode;
                const title = tr.getElementsByTagName("td")[0].innerText;
                const description = tr.getElementsByTagName("td")[1].innerText;

                document.getElementById("titleEdit").value = title;
                document.getElementById("descrEdit").value = description;
                document.getElementById("snoEdit").value = e.target.id;
                const modal = new bootstrap.Modal(document.getElementById('editModal'), {
                    keyboard: false
                });
                modal.toggle();
            })
        })

        // Deleting notes
        const deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach(elem => {
            elem.addEventListener("click", (e) => {
                const sno = e.target.id.substr(2, );

                if (confirm("Are you sure you want to delete this note?")) {
                    window.location = `/rohit/inotes/index.php?delete=${sno}`;
                }
            })
        })
    </script>


</body>

</html>