<!DOCTYPE html>
<html>
    <head>
        <title>Delete record</title>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="StyleErase.css">
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
        <div class="mainContainer">
            <h1>Erasing Data</h1>
            <form action=" " method="POST">
                <label>Enter Reporting ID:</label><br>
                <input type="number" placeholder="Enter ID" name="rid"><br>
                <label>Email</label><br>
                <input type="email" placeholder="Email" name="email"><br>
                <label>Reason</label><br>
                <select name="reason">
                    <option value="Found">Found</option>
                    <option value="Wrong">Wrong Info</option>
                </select><br>
                <input type="submit" name="btnSubmit" id="submit" value="Delete">
            </form>
             <?php
                $conn = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($conn,'mydb');  

                if(isset($_POST['btnSubmit']))
                {
                    $id = $_POST['rid'];
                    $email = $_POST['email'];
                    $reason = $_POST['reason'];

                    $query = "SELECT * FROM missingdb WHERE id=$id AND email='$email'";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_fetch_array($query_run);
                    if($row==false)
                    {
                        echo "No record";
                    }
                    else{
                        if($reason=="Found")
                        {
                            $query = "SELECT fcount FROM foundcount ";
                            $query_run = mysqli_query($conn,$query);
                            $row = mysqli_fetch_array($query_run);
                            $c = $row['fcount'];
                            $count=$c+1;
                            $query = "UPDATE foundcount SET fcount=$count WHERE fcount=$c";
                            $query_run = mysqli_query($conn,$query);
                            $query = "DELETE FROM missingdb WHERE id=$id";
                            $query_run = mysqli_query($conn,$query);
                        }
                        else if($reason=="Wrong")
                        {
                            $query = "DELETE FROM missingdb WHERE id=$id ";
                            $query_run = mysqli_query($conn,$query);
                        } 
                    }                    
                }
            ?>
        </div>
        <footer>
            <span class="copyright">Major project for final year GLBITM,Greater Noida </span>
          </footer>
    </body>
</html>