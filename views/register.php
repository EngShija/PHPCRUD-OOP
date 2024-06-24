<?php
session_start();
require_once __DIR__ . "/../models/Database.php";
require_once __DIR__ . "/../models/Users.php";
require_once __DIR__ . "/../helpers/functions.php";
$database = new Database();
$student = new User($database);
$students = $student->get_users();
$row = $student->get_user_single_row();
?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/bootstrap.css">
  <link rel="stylesheet" href="../assets/custom-style.css">
  <script src="../assets/bootstrap.min.js"></script>
  <script src="../assets/bootstrap.js"></script>
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</head>

<body>

  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Logo</a>

    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link 2</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Dropdown link
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Link 1</a>
          <a class="dropdown-item" href="#">Link 2</a>
          <a class="dropdown-item" href="#">Link 3</a>
        </div>
      </li>
    </ul>


    <form class="form-inline" id="myInput">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>


  </nav>
<div class="container">
  <div class="all">
      <?php
      if (isset($_GET['emptyName']))
        echo "<div class='alert alert-danger alert-dismissible'>
<a href='register.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
<strong>Error!</strong> Name is required!
</div>";
      ?>
      <form action="../controllers/registerHandler.php" class="form-horizontal mt-5 was-validated" method="post">
        <div class="form-row">
          <div class="col">
            <div class="form-group">
              <label for="name" class="control-lable" class="mr-sm-2">Name:</label>
              <input type="text" class="form-control input-sm mb-2 mr-sm-2" id="name" name="name" autofocus required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill this field</div>

            </div>
            <div class="form-group">
              <label for="email" class="control-lable" class="mr-sm-2">Email address:</label>
              <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please provide a valid email</div>
            </div>
            <div class="form-group">
              <label for="pwd" class="control-lable" class="mr-sm-2">Password:</label>
              <input type="password" class="form-control mb-2 mr-sm-2" id="pwd" name="password" required>
              <div class="valid-feedback">Valid.</div>
              <div class="invalid-feedback">Please fill this field</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>

    
  <div class="all">
  <?php
  if (isset($_GET['edit']) && $_GET['edit'] != null && $_GET['edit'] != 0) {
    $database = new Database();
    $student = new User($database);
    $user = $student->get_user_by_id($_GET['edit']);
    $_SESSION['userId'] = $_GET['edit'];
  ?>

    <form action="../controllers/editHandler.php" class="form-horizontal mt-5 was-validated" method="post">
    <a href='register.php' class='close' style="color: red; cursor: alias;" data-dismiss='alert' aria-label='close'>&times;</a>
      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="name" class="control-lable" class="mr-sm-2">Name:</label>
            <input type="text" class="form-control input-sm mb-2 mr-sm-2" id="name" name="name" value="<?= $user['name'] ?>" autofocus required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill this field</div>

          </div>
          <div class="form-group">
            <label for="email" class="control-lable" class="mr-sm-2">Email address:</label>
            <input type="email" class="form-control mb-2 mr-sm-2" id="email" name="email" value="<?= $user['email'] ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please provide a valid email</div>
          </div>
          <div class="form-group">
            <label for="pwd" class="control-lable" class="mr-sm-2">Password:</label>
            <input type="password" class="form-control mb-2 mr-sm-2" id="pwd" name="password" value="<?= $user['password'] ?>" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill this field</div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  <?php
  }
  ?>
  </div>

    <div class="all">
      <?php
      if ($student->is_user_present('users')) {
      ?>
        <?php
      if (isset($_GET['deleted'])) {
        echo "<td><div class='alert alert-danger alert-dismissible' style='height: fit-content; display: block;'>
<a href='register.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
<strong>Deleted!</strong> One record is deleted!
</div></td>";
      }
      ?>
        <table class="table table-light table-striped" id="myTable">
          <tr>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>ACTIONS</th>
          </tr>
          <?php foreach ($students as $student) : ?>
            <tr>
              <td>
                <?= $student['name'] ?>
              </td>
              <td>
                <a href="mailto:<?= $student['email'] ?>?subject=Email&body=Some texts"> <?= $student['email'] ?></a>
              </td>
              <td>
                <a href="../controllers/deleteUser.php?deleteId=<?= $student['id'] ?>">Delete</a>
                <a href="../views/register.php?edit=<?= $student['id'] ?>"> Edit</a>
              </td>
            </tr>
          <?php
          endforeach;
          ?>
        </table>
      <?php
      } else {
        echo "<small class='error'>No users found!</small>";
      }
      ?>
    </div>
  </div>
</body>

</html>