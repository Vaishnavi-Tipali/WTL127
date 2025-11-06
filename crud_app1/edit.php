<?php include 'db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Student</title>
</head>
<body>
  <h2>Edit Student</h2>
  <form method="POST">
    Name: <input type="text" name="name" value="<?php echo $student['name']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $student['email']; ?>"><br><br>
    Course: <input type="text" name="course" value="<?php echo $student['course']; ?>"><br><br>
    <input type="submit" name="update" value="Update Student">
  </form>

  <?php
  if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
      echo "Student updated!";
      header("Location: index.php");
      exit;
    } else {
      echo "Error: " . $conn->error;
    }
  }
  ?>
</body>
</html>
