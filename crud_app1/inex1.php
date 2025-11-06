<?php imclude 'db.php'; ?>
<DOCKTYPE html>
<html>
    <head>
        <tittle>student management system</title>
</head>
<body>
    <h2>student list</h2>
    <a href='add.php'>add student</a>
    <br></br>

    <table border="1" cellpaddin="10">
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>email</th>
            <th>course</th>
</tr>
<?php
$result=$conn->query("select *from students");
while($row=$result->fetch_assoc())
{
  echo "<tr>
  <td>{$row['id']}</td>
  <td>{$row['name']}</td>
  <td>{$row['email']}</td>
  <td>{$row['course']}</td>
  <td>
<a href='edit.php?id={$row['id']}'>Edit</a> |
<a href='delete.php?={$row['id']}'>Delete</a>
</td>
  </tr>"
}
?>
</table>
</body>
</html>