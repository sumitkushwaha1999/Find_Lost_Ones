<!DOCTYPE html>
<html>
    <head>
        <title>
            Admin
        </title>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="StyleadminLogin.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse">
            <div class="container-fluid">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
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
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-user"></span> Admin</a></li>
                </ul>
              </div>
            </div>
          </nav>
        <div class="loginContainer">
            <img src="Resources/admin.png">
            <h1>Admin Login</h1>
           
            <form action=" " method="POST">
                <input type="text" placeholder="Admin ID" name="adminId"><br>
                <input type="password" placeholder="Password" name="pswd"><br>
                <input type="submit" id="submit" name="btnSubmit" value="Login">
            </form>
            <?php
                $conn = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($conn,'mydb');  

                if(isset($_POST['btnSubmit']))
                {
                    $id = $_POST['adminId'];
                    $password = $_POST['pswd'];

                    $query = "SELECT * FROM adminlogin ";
                    
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_fetch_array($query_run);
                    if($row['id']==$id && $row['password']==$password)
                    {
                        echo "Login success";
                        header("Location: controlPanel.html"); /* Redirect browser */
                        exit();
                    }
                    else
                    {
                        echo "<h3>Login fail</h3>";
                    }
                }

            ?>
        </div>
        <footer>
            <span class="copyright">Major project for final year GLBITM,Greater Noida </span>
          </footer>
    </body>
</html>