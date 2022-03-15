<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script defer src="js/face-api.min.js"></script>
  <script defer src="js/script.js"></script>
  <title>Face Recognition</title>
  <link rel="stylesheet" href="StyleAuto.css">
</head>
<body>
    <h1>Search with AI</h1>
    <input type="file" id="imageUpload">
    <p>Result ID</p>
    <form action=" " method="POST">
      <input type="number" name="result" id="result" readonly>
      <input type="submit" id="submit" name="btnSubmit" value="Show Results">
      </form>
      <h2 id="notify">Wait for the side to load</h2>
      <?php
          $conn = mysqli_connect("localhost", "root", "");
          $db = mysqli_select_db($conn,'mydb');  

          if(isset($_POST['btnSubmit']))
          {
            $id = $_POST['result'];

            $query = "SELECT * FROM missingDb WHERE id = $id";
    
            $query_run = mysqli_query($conn,$query);
            echo "<table>";
            echo "<tr>";
            echo "<th>Profile</th>";
            echo "<th>Name</th>";
            echo "<th>Gender</th>";
            echo "<th>Contact</th>";
            echo "<th>Location</th>";
            echo "</tr>";

            while($row = mysqli_fetch_array($query_run))
            {
            echo "<tr>";
            echo "<td>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img']).'" height="100" width="100"/>';
            echo "</td>";
            echo "<td>";
            echo ($row['name']);
            echo "</td>";
            echo "<td>";
            echo ($row['gender']);
            echo "</td>";
            echo "<td>";
            echo ($row['cnumber']);
            echo "</td>";
            echo "<td>";
            echo ($row['loc']);
            echo "</td>";
            echo "</tr>";
            }
        }

      ?>
</body>
</html>