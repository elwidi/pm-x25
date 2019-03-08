<?php
     
       $ch = curl_init(); 
	$url = "http://project.apps.moratelindo.co.id/index.php/backgroundJobs/cronJobOpenIssueRegister";
        
       curl_setopt($ch, CURLOPT_URL, $url); 

       //return the transfer as a string 
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

       // $output contains the output string 
       $output = curl_exec($ch); 

       // close curl resource to free up system resources 
       curl_close($ch);  
    
	echo $output;
?>