<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn,'mydb');  

if(isset($_POST['fetch']))
{
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $apxage = $_POST['apxage'];
    $cloth_color=$_POST['ccolor'];
    $skin = $_POST['skin'];

    $query = "SELECT * FROM missingDb WHERE gender='$gender' AND skin='$skin'";
    
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