
<?php
include("connection.php");

if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['schoolID']) && isset($_POST['department'])) {
    $studentID = mysqli_real_escape_string($baglan, $_POST['id']);
    $newName = mysqli_real_escape_string($baglan, $_POST['name']);
    $newSurname = mysqli_real_escape_string($baglan, $_POST['surname']);
    $newSchoolID = mysqli_real_escape_string($baglan, $_POST['schoolID']);
    $newDepartment = mysqli_real_escape_string($baglan, $_POST['department']);

    $updateQuery = "UPDATE `studentform` SET 
                    `Name` = '$newName',
                    `Surname` = '$newSurname',
                    `School No` = '$newSchoolID',
                    `Department` = '$newDepartment'
                    WHERE `ID` = '$studentID'";

    if (mysqli_query($baglan, $updateQuery)) {
        echo "Student with ID $studentID has been updated successfully.";
    } else {
        echo "Error updating student: " . mysqli_error($baglan);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($baglan);
?>
