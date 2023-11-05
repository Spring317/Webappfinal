<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <?php
        function getPrecision($tp,$fp){
            $precision = $tp/($tp+$fp);
            return $precision;
        }

        function getRecall($tp,$fn){
            $recall = $tp/($tp+$fn);
            return $recall;
        }

        function getF1($precision,$recall){
            $f1 = 2*($precision*$recall)/($precision+$recall);
            return $f1;
        }

        function getAccuracy($tp,$tn,$fp,$fn){
            $accuracy = ($tp+$tn)/($tp+$tn+$fp+$fn);
            return $accuracy;
        }

        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "mymetrics";
    
        $conn = mysqli_connect ($servername, $username, $password,$dbname);
        if (!$conn){
            die("Connection failed" .mysqli_connect_error());
        }
    
        else{
            echo("<script>
            alert('Connection Sucess');
            </script>");
        }
       
        if(isset($_POST['submit'])){
            
            $tp = $_REQUEST['tp'];
            $tn = $_REQUEST['tn'];
            $fp = $_REQUEST['fp'];
            $fn = $_REQUEST['fn'];
            
            $precision = getPrecision($tp,$fp);
            $recall = getRecall($tp,$fn);
            $f1 = getF1($precision,$recall);
            $accuracy = getAccuracy($tp,$tn,$fp,$fn);

            $sql = "INSERT INTO metrics(TP,TN,FP,FN,Precis,accuracy,recall,fscore) 
                    VALUES ('$tp','$tn','$fp','$fn', '$precision', '$accuracy', '$recall', '$f1')";
            
            if (mysqli_query($conn, $sql)) {
                echo("<script>
                alert('Import data sucess');
                </script>");
                header("Location: ex2.html");
            } else {
                    echo "Error:" .$sql. "<br>".mysqli_error($conn);           
                }   
        }


        
        if(isset($_POST['display'])){
            $sql ="SELECT * FROM metrics";
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result) >0){
                echo "<table>
                    <tr>
                        <th>TP</th>
                        <th>TN</th>
                        <th>FP</th>
                        <th>FN</th>
                        <th>Precision</th>
                        <th>Recall</th>
                        <th>F1</th>
                        <th>Accuracy</th>
                    </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>".$row["TP"]."</td>
                        <td>".$row["TN"]."</td>
                        <td>".$row["FP"]."</td>
                        <td>".$row["FN"]."</td>
                    
                        <td>".$row["Precis"]."</td>
                        <td>".$row["Recall"]."</td>
                        <td>".$row["fscore"]."</td>
                        <td>".$row["accuracy"]."</td>
                    </tr>";
                    
                }
                echo "</table>";
            }
            else {
                echo "0 results";
            }
        }    
        mysqli_close($conn);

    ?>
</body>
</html>