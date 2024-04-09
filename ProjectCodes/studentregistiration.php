<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="boxbar">
            <div class="logo">
                <a href="welcome.php">Student Finder</a>
            </div>
            <ul>
                <li><a href="welcome.php">Home Page</a></li>
                <li><a href="studentregistiration.php" class="active">Student Registration</a></li>
                <li><a href="students.php">Students</a></li>
                <li><a href="login.php">About Us</a></li>
            </ul>
        </div>
        <div class="streg">
            <h1>You can add a new student!</h1>
            <form id="Studentform" action="" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" required>

                <label for="SchoolID">School No:</label>
                <input type="text" id="SchoolID" name="SchoolID" required>

                <label for="scholarshiprate">Scholarship Rate:</label>
                <input type="number" id="scholarshiprate" name="scholarshiprate" min="0" max="100" required>

                <label for="department">Department:</label>
                <input type="text" id="department" name="department" required>

                <label for="birthdate">Birth Date:</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <label for="registiration">Date of Registiration:</label>
                <input type="date" id="registiration" name="registiration" required>

                 <input type="submit" name="submit" value="Add">
            </form>
        </div>
    </div>
    
    <script>
       // function save() {
        //    var name = document.getElementById("Name").value;
         //   var surname = document.getElementById("Surname").value;
          //  var SchoolID = document.getElementById("SchoolNo").value;
            //var scholarshiprate = document.getElementById("scholarshiprate").value;

            // Bu noktada elde ettiğiniz bilgileri istediğiniz şekilde kullanabilirsiniz.
            // Örneğin, bu bilgileri bir nesne içinde saklayarak başka işlemler yapabilirsiniz.
           // var ogrenci = {
            //    ad: ad,
           //     soyad: soyad,
            //    okulNo: okulNo,
             //   bursOrani: bursOrani
          //  }
       // }
    </script>
</body>
</html>

<?php

include("connection.php");

if(isset($_POST["submit"])) {
    $Name = $_POST["name"];
    $Surname = $_POST["surname"];
    $SchoolNo = $_POST["SchoolID"];
    $SchoolarshipRate = $_POST["scholarshiprate"];
    $Department = $_POST["department"];
    $BirthDate = $_POST["birthdate"];
    $registirationDate = $_POST["registiration"];

    $add = "INSERT INTO studentform (`Name`, `Surname`, `School No`, `Scholarship Rate`, `Department`, `Birth Date`, `Date of Registration`) 
            VALUES ('$Name', '$Surname', '$SchoolNo', '$SchoolarshipRate', '$Department', '$BirthDate', '$registirationDate')";

    if($baglan->query($add) === TRUE) {
        echo "<script>alert('ADDED!')</script>";
    } 
}

?>
