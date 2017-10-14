<?php 
/// session_start();

//if(isset($_SESSION['output'])){
 //   header('Location : game.php?op=t');
  //  exit();
//}
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
if(isset($_GET['name']) && isset($_GET['score']) && isset($_GET['time']))
 { 
    $name=$_GET['name'];

    $score=$_GET['score'];
    $iniscore=$score;
    $time=$_GET['time'];
    
    $db=new mysqli("localhost","kunjroot","kunjroot","db_game");

    $q1="SELECT * FROM `table1` WHERE `name`='$name' ";
    $q2="SELECT * FROM `table2` WHERE `name`='$name' ";
     
     if(!($db->query($q1)) )
    {
        if(!($db->query($q2)))
        { 
    
            if($score==12){
                $score=(($score*5)+((20-$time)*10)); 

                mysqli_query($db,"INSERT INTO `table1` (`name`,`score`,`time`) VALUES('".$name."','".$score."','".$time."')");
                        echo "$name";
                        }

            else{

                $score=($score*5);
       mysqli_query($db,"INSERT INTO `table2` (`name`,`score`,`time`) VALUES('".$name."','".$score."','20')");
            }
        }

    
        else{
            $score=($score*5);

            $resultq2=$db->query($q2);
            $row=$resultq2->fetch_assoc();
            if($score>$row['score'])
            {
                mysqli_query($db,"UPDATE `table2` SET `score`='".$score."'' ");
            }
        }

    }

    else{  

        $score=(($score*5)+((20-$time)*10));

        $resultq1=$db->query($q1);
        $row=$resultq1->fetch_assoc();
        $score = 500;
       if($score > $row['score'])
       {
        
          mysqli_query($db,"UPDATE `table1` SET `score`='".$score."' ");
        } 
    
    }



//leaderboard
     $fqr1=$db->query("SELECT * FROM `table1` ORDER BY `time` ASC");
     $fqr2=$db->query("SELECT * FROM `table2` ORDER BY `score` DESC");
     
     $i=0;
     //print_r($fqr);
     $output="<table border=1>
        <tr><th> RANK </th><th> NAME </th><th> SCORE </th><th> TIME </th></tr>";
     
     while($row=$fqr1->fetch_assoc()) 
    { 
        $i++;

         $output.="<tr><td>$i</td><td>".$row['name']."</td><td>".$row['score']."</td><td>".$row['time']."</td> </tr>";

         
    }
     while($row=$fqr2->fetch_assoc()) 
    { 
        $i++;

         $output.="<tr><td>$i</td><td>".$row['name']."</td><td>".$row['score']."</td><td>".$row['time']."</td> </tr>";

         
    }

        $output.="</table>";
      

       echo $output;
    // $_SESSION['output']=$output;
  // $output=urlencode($output);

   header('Location : gamephp.php?op=$output');
    exit();
}

else
{

    echo "PRoBleM";

}

?>
<script type="text/javascript">
    
var auto_refresh = setInterval(
    function()
    {
    submitform();
    }, 10000);

    function submitform()
    {
      
      document.myForm.submit();
    }
   

</script>
<!DOCTYPE html>
<html>
<head>
    <title>
        
    </title>
    <style type="text/css">
        #hideit{
            display: none;
        }
    </style>
</head>
<body>
<form name="myForm" action="game.php" method="post" >
    <div id="hideit">
        <input type="text" name="output" value="<?php echo "$output"; ?>">
         <input type="submit" name="submit" value="Submit" />
    </div>







</form>
</body>
</html>
 