<html>
  <head>
  
      <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> 

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#hi').DataTable();
        } );</script>
        
  </head>
  <body>
<?php 
  $url = "https://api.rootnet.in/covid19-in/stats/latest";
 $cObj = curl_init();
  curl_setopt($cObj, CURLOPT_URL, $url);
  //curl_setopt($cObj, CURLOPT_HTTPHEADER, $headers);
  //curl_setopt($cObj, CURLOPT_TIMEOUT, self::$timeout);
  curl_setopt($cObj, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($cObj, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($cObj);
    if ($result === FALSE) {
    die("Curl failed: " . curL_error($cObj));
    }
    $resultData =  json_decode($result, true);
 curl_close($cObj);
 echo "<table class='table'><tr>
 <th>total</th>
 <th>india case</th>
 <th>foreign case</th>
 <th>discharge</th>
 <th>location</th></tr><tr>";
    foreach($resultData['data']['summary'] as  $value){  
        
       
            echo "<td>".$value."</td>";
        }
        echo "</tr></table>";
    

    ?>
    <h4>state wise data</h4>
    <?php
        echo "<table id='hi' class='table table-striped'><thead><tr>
        
        <th>loc</th>
        <th>india case</th>
        <th>foreign case</th>
        <th>discharge</th>
        <th>death</th>
        <th>confirm</th></tr></thead><tbody>";
        $i = 0;
        foreach($resultData['data']['regional'] as  $key => $value){  
           echo "<tr>";
            foreach($value as  $values) {
                echo "<td>".$values."</td>";
                
            }
            echo"</tr>";
        }
            echo "</tbody></table>";
           
       ?>
       
        </body>
       </html>