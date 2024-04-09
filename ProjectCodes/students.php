<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students</title>
    <link rel="stylesheet" href="stustylelast.css">
</head>
<body>
    <div class="container">
        <div class="boxbar">
            <div class="logo">
                <a href="welcome.php">Student Finder</a>
            </div>
            <ul>
                <li><a href="welcome.php">Home Page</a></li>
                <li><a href="studentregistiration.php">Student Registration</a></li>
                <li><a href="students.php" class="active">Students</a></li>
                <li><a href="aboutus.php">About Us</a></li>
            </ul>
        </div>
        <div class="stu">
            <h1>You can find registered students.</h1>
            <form id="Students" action="" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" >

                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname" >

                <label for="SchoolID">School No:</label>
                <input type="text" id="SchoolID" name="SchoolID" >

                <label for="department">Department:</label>
                <input type="text" id="department" name="department" >

                 <input type="submit" name="submit" value="Search">
<!-- For deleting form -->
                <form id="DeleteForm" action="" method="post">
                <label for="deleteID">ID:</label>
                <input type="text" id="deleteID" name="deleteID" >
                 <input type="submit" name="delete" value="Delete">
                </form>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include("connection.php");


if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $schoolID = $_POST['SchoolID'];
    $department = $_POST['department'];

    $conditions = array();

    if (!empty($name)) {
        $conditions[] = "`Name` = '$name'";
    }

    if (!empty($surname)) {
        $conditions[] = "`Surname` = '$surname'";
    }

    if (!empty($schoolID)) {
        $conditions[] = "`School No` = '$schoolID'";
    }

    if (!empty($department)) {
        $conditions[] = "`Department` = '$department'";
    }

    $whereClause = implode(" AND ", $conditions);


    $choose = "SELECT `ID`, `Name`, `Surname`, `School No`, `Scholarship Rate`, `Department`, `Birth Date`, `Date of Registration` 
               FROM `studentform` 
               WHERE $whereClause";
} else {
    $choose = "SELECT `ID`, `Name`, `Surname`, `School No`, `Scholarship Rate`, `Department`, `Birth Date`, `Date of Registration` 
               FROM `studentform`";
}


$result = mysqli_query($baglan, $choose);


echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>School No</th>
            <th>Scholarship Rate</th>
            <th>Department</th>
            <th>Birth Date</th>
            <th>Date of Registration</th>
        </tr>";

if ($result) {

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['ID']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['Surname']."</td>";
        echo "<td>".$row['School No']."</td>";
        echo "<td>".$row['Scholarship Rate']."</td>";
        echo "<td>".$row['Department']."</td>";
        echo "<td>".$row['Birth Date']."</td>";
        echo "<td>".$row['Date of Registration']."</td>";
        echo "<td><button class='update-btn' data-id='".$row['ID']."'>Edit</button></td>";
        echo "</tr>";
    }
} else {

    echo "Error: " . $choose . "<br>" . mysqli_error($baglan);
}

echo "</table>";


mysqli_close($baglan);

?>

<?php
include("connection.php");

if (isset($_POST['delete']) && isset($_POST['deleteID'])) {

    $deleteID = mysqli_real_escape_string($baglan, $_POST['deleteID']); 
    $deleteQuery = "DELETE FROM `studentform` WHERE `ID` = '$deleteID'";

    if (mysqli_query($baglan, $deleteQuery)) {
        echo "Record with ID $deleteID has been deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($baglan);
    }
}

mysqli_close($baglan);
?>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.update-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var studentID = button.getAttribute('data-id');

                // Make modal
                var modal = document.createElement('div');
                modal.className = 'modal';
                
                // Modal infos
                modal.innerHTML = `
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <h2>Update Student Information</h2>
                        <label for="newName">New Name:</label>
                        <input type="text" id="newName" name="newName" required>

                        <label for="newSurname">New Surname:</label>
                        <input type="text" id="newSurname" name="newSurname" required>

                        <label for="newSchoolID">New School ID:</label>
                        <input type="text" id="newSchoolID" name="newSchoolID" required>

                        <label for="newDepartment">New Department:</label>
                        <input type="text" id="newDepartment" name="newDepartment" required>

                        <button onclick="updateStudent('${studentID}')">Update</button>
                    </div>
                `;

                document.body.appendChild(modal);
            });
        });

        window.closeModal = function () {
            var modal = document.querySelector('.modal');
            if (modal) {
                modal.parentNode.removeChild(modal);
            }
        };

        window.updateStudent = function (studentID) {
            var newName = document.getElementById('newName').value;
            var newSurname = document.getElementById('newSurname').value;
            var newSchoolID = document.getElementById('newSchoolID').value;
            var newDepartment = document.getElementById('newDepartment').value;

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                    closeModal();
                    location.reload();
                }
            };

            xhr.open("POST", "updateStudent.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("id=" + studentID +
                     "&name=" + newName +
                     "&surname=" + newSurname +
                     "&schoolID=" + newSchoolID +
                     "&department=" + newDepartment);
        };
    });
</script>
