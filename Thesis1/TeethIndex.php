<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .teeth-container {
            border: 1px solid #000;
            padding: 10px;
            width: 70%; /* Adjust the width as needed */
            margin: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }

        td {
            width: 25px;
            height: 25px;
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
        }

        .present-tooth {
            background-color: #c8e6c9; /* Light green for present teeth */
        }

        .pulled-tooth {
            background-color: #ffcdd2; /* Light red for pulled teeth */
        }

        .x-mark {
            color: red;
            font-weight: bold;
        }
    </style>
    <title>Teeth Visualizer</title>
</head>
<body>

<div class="teeth-container">
    <?php
    include_once("connection/connection.php");
    $con = connection();

    // Fetch upper and lower teeth data
    $upperTeethData = fetchData($con, 'Upper');
    $lowerTeethData = fetchData($con, 'Lower');

    // Display upper teeth table
    displayTeethTable($upperTeethData, 'Upper');

    // Display lower teeth table
    displayTeethTable($lowerTeethData, 'Lower');

    $con->close();

    function fetchData($con, $position)
    {
        $sql = "SELECT * FROM teeth WHERE position = '$position' ORDER BY tooth_number";
        $result = $con->query($sql);

        $teethData = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teethData[] = $row;
            }
        }

        return $teethData;
    }

    function displayTeethTable($teethData, $position)
    {
        echo "<h2>$position Teeth</h2>";
        echo "<table>";
        foreach ($teethData as $tooth) {
            $status = $tooth['status'];
            $toothType = $tooth['tooth_type'];

            $toothClass = strtolower($status) . '-tooth';

            echo "<td class='$toothClass'>";
            echo $status === 'Pulled' ? '<span class="x-mark">X</span>' : $toothType;
            echo "</td>";
        }
        echo "</table>";
    }
    ?>
</div>

</body>
</html>
