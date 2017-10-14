<?php 
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
if(isset($_GET['name']) && isset($_GET['score']) && isset($_GET['time']))
 { 
    $name=$_GET['name'];

    $score=$_GET['score'];
    $iniscore=$score;
    $tscore=$score;
    $time=$_GET['time'];
    
    $db=new mysqli("localhost","kunjroot","kunjroot","db_game");

    $q1="SELECT * FROM `table1` WHERE `name`='".$name."' ";
    $q2="SELECT * FROM `table2` WHERE `name`='".$name."' ";
    

     if(!(($db->query($q1))->num_rows))
    {   if(!(($db->query($q2))->num_rows))
        { 
            if($score==12){
                $score=(($score*5)+((20-$time)*10)); 
                mysqli_query($db,"INSERT INTO `table1` (`name`,`score`,`time`) VALUES('".$name."','".$score."','".$time."')");
                       
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
            if($time<20){


            	 $tscore=(($tscore*5)+((20-$time)*10)); 
                
                mysqli_query($db,"INSERT INTO `table1` (`name`,`score`,`time`) VALUES('".$name."','".$tscore."','".$time."')");
                mysqli_query($db,"DELETE FROM `table2` WHERE `name`='".$name."' ");
                	//INSERT INTO `table1` (`name`,`score`,`time`) VALUES('".$name."','".$tscore.//"','".$time."')");


            }
            	else{
            if($score>$row['score'])
            {
                mysqli_query($db,"UPDATE `table2`  SET `score`='".$score."' WHERE `name`='".$name."'");
            }
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
        
          mysqli_query($db,"UPDATE `table1` SET `score`='".$score."' WHERE `name`='".$name."' ");
        } 
    
    }



//leaderboard
     $fqr1=$db->query("SELECT * FROM `table1` ORDER BY `time` ASC");
     $fqr2=$db->query("SELECT * FROM `table2` ORDER BY `score` DESC");
     
     $i=0;
     //print_r($fqr);
     $output="<table border=1 style=\"background-color: white;\">
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
    

 
}

else
{

    echo "PRoBleM";

}

?>


 