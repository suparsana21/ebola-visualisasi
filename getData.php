<?php
    $host = "localhost";
	$uname = "vnjgatqtck";
	$pass = "JDKXcj9PXG";
	$db = "vnjgatqtck";	
 
    $con = mysqli_connect($host, $uname, $pass, $db);
    $data = mysqli_query($con,"SELECT Country,SUM(kasus) as jumlah FROM tb_ebola where Date like '%2014%' group by Country order by jumlah desc");
    $row = [];
    while($value = mysqli_fetch_assoc($data)){
        $row[] = $value;
    }

    echo json_encode($row);

?>