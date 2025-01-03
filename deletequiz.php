<?php

require "connection.php";

$table_name = $_POST['table_name'];

?>

<script>alert('Table <?= $table_name ?> successfully')</script>

<?php

// Construct and execute the SQL query to drop the table
$sql_delete_quiz = "DROP TABLE IF EXISTS $table_name";
$sql_delete_quiz_results = "DROP TABLE IF EXISTS $table_name"."_result";
if ($conn->query($sql_delete_quiz) && $conn->query($sql_delete_quiz_results)) {
    echo "<script>alert('Table $table_name deleted successfully')";
} else {
    echo "<script>alert('Error deleting table: " . $conn->error."')";
}

header("Location: managequizzes.php");

?>