<?php
    
    function connection(){

        $host = "localhost";
        $username = "root";
        $password = "Thesis1";
        $database = "patientsdb";
        
         $con = new mysqli($host, $username, $password, $database);

         if ($con->connect_error) {
            echo $con->connect_error;
         }
         else{
            return $con;
         }
    }
