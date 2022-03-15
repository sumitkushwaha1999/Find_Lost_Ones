<html>
    <head>
        <title>
            Find
        </title>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="StyleFind.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="js/jquery-2.1.1.min.js"></script>
        <script src="js/face-api.js"></script>
        <script src="js/faceSystem.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Finding Lost One</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="/find lost/Home.html">Home</a></li>
                  <li><a href="/find lost/Report.html" id="report">Report</a></li>
                  <li><a href="/find lost/Finding.php" id="find">Find</a></li>
                  <li><a href="/find lost/Erase.php" id="erase">Erase</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="/find lost/adminLogin.php"><span class="glyphicon glyphicon-user"></span> Admin</a></li>
                </ul>
              </div>
            </div>
          </nav>
        <div class="container">
            <div class="col1">
                <h1 id="head1">Finding</h1>
            <form action="view.php" method="POST" enctype="multipart/form-data">
                    <label >Name:</label><br>
                    <input class="inputArea" type="text" name="name">
                    <br>
                    <label >Gender:</label><br>
                    <input type="radio" name="gender" value="Male">
                    <label >Male</label>
                    <br>
                    <input type="radio" name="gender" value="Female">
                    <label >Female</label>
                    <br>
                    <input type="radio" name="gender" value="Transgender">
                    <label >Transgender</label>
                    <br>
                    <br>
                    <label >Approx. Age:</label><br>
                    <input class="inputArea" type="text" name="apxage">
                    <br>
                    <br>
                    <label >Cloth Color:</label><br>
                    <input class="inputArea" type="text" name="ccolor">
                    <br>
                    <label >Skin:</label><br>
                    <input type="radio" name="skin" value="Wheat">
                    <label >Wheat</label>
                    <br>
                    <input type="radio" name="skin" value="Fair">
                    <label >Fair</label>
                    <br>
                    <input type="radio" name="skin" value="Black">
                    <label >Black</label>
                    <br>
                    <br>
                    <input type="submit"  id="submit" name="fetch" value="Find">
            </form>
            </div>
            <div class="col2">
                <h1>Recent Reportings</h1>
                <table class="reportTable">
                  <tr>
                <th>Profile</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Contact</th>
                  <th>Location</th>
                </tr>
                <?php
                      $conn = mysqli_connect("localhost", "root", "");
                        $db = mysqli_select_db($conn,'mydb');  
                        $query = "SELECT * FROM missingDb ORDER BY cdate DESC LIMIT 5";
    
                        $query_run = mysqli_query($conn,$query);

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
                    ?>
                </table>
            </div>
        </div>
        <footer>
            <span class="copyright">Major project for final year GLBITM,Greater Noida </span>
          </footer>
          
    </body>
</html>