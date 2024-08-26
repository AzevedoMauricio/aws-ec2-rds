<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Projetos</h1>
<?php


$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$database = mysqli_select_db($connection, DB_DATABASE);

VerifyProjectsTable($connection, DB_DATABASE);

$project_name = htmlentities($_POST['PROJECT_NAME']);
$start_date = htmlentities($_POST['START_DATE']);
$budget = htmlentities($_POST['BUDGET']);
$description = htmlentities($_POST['DESCRIPTION']);

if (strlen($project_name) || strlen($start_date) || strlen($budget) || strlen($description)) {
    AddProject($connection, $project_name, $start_date, $budget, $description);
}
?>

<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <table border="0">
    <tr>
      <td>Project Name</td>
      <td>Start Date</td>
      <td>Budget</td>
      <td>Description</td>
    </tr>
    <tr>
      <td><input type="text" name="PROJECT_NAME" maxlength="100" size="30" /></td>
      <td><input type="date" name="START_DATE" /></td>
      <td><input type="number" step="0.01" name="BUDGET" /></td>
      <td><textarea name="DESCRIPTION" rows="3" cols="30"></textarea></td>
      <td><input type="submit" value="Add Project" /></td>
    </tr>
  </table>
</form>

<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>Project Name</td>
    <td>Start Date</td>
    <td>Budget</td>
    <td>Description</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM PROJECTS");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>", $query_data[0], "</td>",
       "<td>", $query_data[1], "</td>",
       "<td>", $query_data[2], "</td>",
       "<td>", $query_data[3], "</td>",
       "<td>", $query_data[4], "</td>";
  echo "</tr>";
}
?>

</table>

<!-- Clean up. -->
<?php

mysqli_free_result($result);
mysqli_close($connection);

?>

</body>
</html>

<?php

function AddProject($connection, $project_name, $start_date, $budget, $description) {
    $pn = mysqli_real_escape_string($connection, $project_name);
    $sd = mysqli_real_escape_string($connection, $start_date);
    $b = mysqli_real_escape_string($connection, $budget);
    $d = mysqli_real_escape_string($connection, $description);

    $query = "INSERT INTO PROJECTS (PROJECT_NAME, START_DATE, BUDGET, DESCRIPTION) VALUES ('$pn', '$sd', '$b', '$d');";

    if(!mysqli_query($connection, $query)) echo("<p>Error adding project data.</p>");
}

function VerifyProjectsTable($connection, $dbName) {
    if(!TableExists("PROJECTS", $connection, $dbName)) {
        $query = "CREATE TABLE PROJECTS (
            ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            PROJECT_NAME VARCHAR(100),
            START_DATE DATE,
            BUDGET DECIMAL(10, 2),
            DESCRIPTION TEXT
        )";

        if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
    }
}

function TableExists($tableName, $connection, $dbName) {
    $t = mysqli_real_escape_string($connection, $tableName);
    $d = mysqli_real_escape_string($connection, $dbName);

    $checktable = mysqli_query($connection,
        "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

    if(mysqli_num_rows($checktable) > 0) return true;

    return false;
}
?>
