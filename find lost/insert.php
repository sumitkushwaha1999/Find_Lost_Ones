<?php
 $conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn,'mydb');  

if(isset($_POST['upload']))
{
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $apxage = $_POST['apxage'];
    $cloth_color=$_POST['ccolor'];
    $contact = $_POST['cnumber'];
    $email = $_POST['eml'];
    $location=$_POST['location'];
    $skin = $_POST['skin'];
    $file = addslashes(file_get_contents($_FILES["image1"]["tmp_name"]));

    $query = "INSERT INTO `missingDb`(`name`,`gender`,`approx_age`,`cloth_color`,`cnumber`,`email`,`loc`,`skin`,`img`) VALUES('$name','$gender','$apxage','$cloth_color','$contact','$email','$location','$skin','$file')";
    $query_run = mysqli_query($conn,$query);

    //Getting max id
    $query = "SELECT MAX(id) FROM `missingDb`";
    $query_run = mysqli_query($conn,$query);
    $row = mysqli_fetch_row($query_run);
    $id = $row[0];

    //Uploading Images to folder

    //Image 1
    $imagename = $_FILES['image1']['name'];
    $extension=pathinfo($imagename,PATHINFO_EXTENSION);
    $rename = $id.'_1';
    $newname=$rename.'.'.$extension;
    $filepath = "imageData/" . $newname;

    if(move_uploaded_file($_FILES["image1"]["tmp_name"], $filepath)) 
    {
    echo "<img src=".$filepath." height=200 width=300 />";
    } 
    else 
    {
    echo "Error !!";
    }

    //Image 2
    $imagename = $_FILES['image2']['name'];
    $extension=pathinfo($imagename,PATHINFO_EXTENSION);
    $rename = $id.'_2';
    $newname=$rename.'.'.$extension;
    $filepath = "imageData/" . $newname;

    if(move_uploaded_file($_FILES["image2"]["tmp_name"], $filepath)) 
    {
    echo "<img src=".$filepath." height=200 width=300 />";
    } 
    else 
    {
    echo "Error !!";
    }

    //Creating JSON of ID's

    $query = "SELECT id FROM missingDb";  
    $query_run = mysqli_query($conn,$query);
    $array = array();

    //Fill array
    while($row = mysqli_fetch_array($query_run))
    {
        $array[]=$row['id'];
    }

    // encode array to json
    $json = json_encode(array('data' => $array));

    //write json to file
    if (file_put_contents("idData/data.json", $json))
        echo "JSON file created successfully...";
    else 
        echo "Oops! Error creating json file...";
    
    //Data uploaded message
    if($query_run)
    {
        echo '<script type="text/javascript">alert("Data uploaded")</script>';
    }
    else
    {
        echo '<script type="text/javascript">alert("Data not uploaded")</script>';
    }
}

?>