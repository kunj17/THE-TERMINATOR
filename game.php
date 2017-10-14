<?php 
ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);
?>
<!DOCTYPE>
<html>
<head>

<link rel="stylesheet" type="text/css" href="gamecss.css"> 
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script type="" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css
"></script>
<script type="text/javascript" src="
https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
</script>
<script>

var name="<?php if(isset($_POST['submit'])){ $name=$_POST['name'];echo "$name";} ?>";
var score=0,TIME=0;



function initCanvas()
{

    var sl=document.getElementById('seconds');
    var ml=document.getElementById('minutes');
    
    var ctx = document.getElementById('my_canvas').getContext('2d');
    var cW = ctx.canvas.width, cH = ctx.canvas.height;

    var sec=0,rct=0,min=0,oec=0;
    ///for random number   Math.floor(Math.random() * (max - min + 1)) + min
    var enemies = [ {"id":"enemy1","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy2","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy3","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy4","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20},
                    {"id":"enemy5","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20},
                    {"id":"enemy6","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20},
                    {"id":"enemy1","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy2","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy3","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-20,"w":40,"h":20},
                    {"id":"enemy4","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20},
                    {"id":"enemy5","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20},
                    {"id":"enemy6","x":(Math.floor(Math.random() * (700 - 50 + 1)) + 50),"y":-70,"w":40,"h":20}
    ];
    
    function renderEnemies(){
        for(var i = 0; i < enemies.length; i++){
            ctx.fillStyle = "blue";
            ctx.fillRect(enemies[i].x, enemies[i].y+=.5, enemies[i].w, enemies[i].h);
            ctx.strokeRect(enemies[i].x, enemies[i].y+=.5, enemies[i].w, enemies[i].h);
        }
    }
    function Launcher(){
        this.y = 500, this.x = cW*.5-25, this.w = 50, this.h = 50, this.dir, this.bg="orange", this.missiles = [];
        this.render = function(){
          if((rct++)%33==0)
            {sl.innerHTML=++sec;
              if(sec>=60){ sec=0; sl.innerHTML=sec;    ml.innerHTML=++min;}
            }
            if(this.dir == 'left'){
                this.x-=5;
            } else if(this.dir == 'right'){
                this.x+=5;
            }
            ctx.fillStyle = this.bg;
            ctx.fillRect(this.x, this.y, this.w, this.h);
            ctx.strokeRect(this.x, this.y, this.w, this.h);
            for(var i=0; i < this.missiles.length; i++){
                var m = this.missiles[i];
                ctx.fillStyle = m.bg;
                ctx.fillRect(m.x, m.y-=5, m.w, m.h);ctx.strokeRect(m.x, m.y-=5, m.w, m.h);
                this.hitDetect(this.missiles[i],i);
                if(m.y <= 0){ // If a missile goes past the canvas boundaries, remove it
                    this.missiles.splice(i,1); // Splice that missile out of the missiles array
                }
            }
            function enemiespos()
            {oec=0;
               for(var i = 0; i < enemies.length; i++){
            if(enemies[i].y+enemies[i].h>cH)  
              {oec++; 
                if(oec==enemies.length){return true;}
            
             }
          
            }  return false;
        }

            
            if(enemies.length == 0 || enemiespos()){
                clearInterval(animateInterval); // Stop the game animation loop
                ctx.fillStyle = '#FC0';
                ctx.font = 'italic bold 36px Arial, sans-serif';
                if(enemiespos()){ ctx.fillText('Game Over!!!  Score:'+(12-oec), cW*.5-130, 50, 300);
                }
                else{
                ctx.fillText('Level Complete!!!  Score:12', cW*.5-130, 50, 300);}

                score=(12-oec);
                TIME=sl.innerHTML;


                $.ajaxPrefilter(function( options, original_Options, jqXHR ) {
    options.async = true;
});

                 $.ajax(
  {
    url:"deleteme.php",
    type:"GET",
     
    data:{
      "name":name,
      "score":score,
      "time":TIME
    },
    success:function(data){
      $("#answer").html(data);
    }
  });
              
         
   alert("name "+name+"score "+score+" TIME"+TIME);
               
            }
        }
        this.hitDetect = function(m,mi){
            for(var i = 0; i < enemies.length; i++){
                var e = enemies[i];
                if(m.x+m.w >= e.x && m.x <= e.x+e.w && m.y >= e.y && m.y <= e.y+e.h){
                    this.missiles.splice(this.missiles[mi],1); // Remove the missile
                    enemies.splice(i,1); // Remove the enemy that the missile hit
                    document.getElementById('status').innerHTML = "You destroyed "+ e.id;
                }
            }
        }
    }

     var launcher = new Launcher();
     
   
    function animate(){
       
        //ctx.save();
        
       ctx.clearRect(0, 0, cW, cH);
       launcher.render();
        renderEnemies();
       //ctx.restore();}
   }
    var animateInterval =setInterval(animate,30);
    var left_btn = document.getElementById('left_btn');
    var right_btn = document.getElementById('right_btn');
    var fire_btn = document.getElementById('fire_btn');
    left_btn.addEventListener('mousedown', function(event) {
        launcher.dir = 'left';
    });
    left_btn.addEventListener('mouseup', function(event) {
        launcher.dir = '';
    });
    right_btn.addEventListener('mousedown', function(event) {
        launcher.dir = 'right';
    });
    right_btn.addEventListener('mouseup', function(event) {
        launcher.dir = '';
    });
    fire_btn.addEventListener('mousedown', function(event) {
        launcher.missiles.push({"x":launcher.x+launcher.w*.5,"y":launcher.y,"w":3,"h":10,"bg":"white"});
    });





}

 window.addEventListener('load', function(event) {
    initCanvas();});

</script>
</head>
<body style="background: url('img3.jpg')";><center>
<h4 style="margin-right:50px;";>TIME <label id="minutes">00</label>:<label id="seconds">00</label>
</h4></center><div class="nav-side-menu">
    <div class="brand"><b><u>LEADERBOARD</u></b></div>
    
    <div id="answer" style="color: white">
        LEADERBOARD  
        GENETARTING SHORTLY....
        <p>.....</p>
    </div>
</div>
<div id="main">
    <div class="row">
        <div class="col-md-12">
<center>
<canvas id="my_canvas" width="700" height="600"></canvas>
<div>
  <button id="left_btn">Move Left</button>
    <button id="fire_btn">Fire Missile</button><button id="right_btn">Move Right</button>
  </div>
<h3 id="status">
</h3>
</center>
        

        </div>
    </div>
</div>



</body>  
</html>








