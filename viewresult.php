<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/png" href="images/logo1.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuizWiz - Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        h1 {
            font-size: 6vw;
            text-align: center;
            background-image: url("images/color.gif");
            background-size: cover;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        body {
            background-color: #F5DEB3;
        }

        .card{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-body{
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center">Quiz Results</h1>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Score</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $sql = "SELECT * FROM your_table_name";
                            $result = $conn->query($sql);
                            
                            echo "<table>";
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['score'] . "</td>";
                                    echo "<td>" . $row['total'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>No results found</td></tr>";
                            }
                            echo "<table>";
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
