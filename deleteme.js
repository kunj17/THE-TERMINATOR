var pets=[
  {
    "name": "Meowsy",
    "species" : "cat",
    "foods": {
      "likes": ["tuna", "catnip"],
      "dislikes": ["ham", "zucchini"]
    }
  },
  {
    "name": "Barky",
    "species" : "dog",
    "foods": {
      "likes": ["bones", "carrots"],
      "dislikes": ["tuna"]
    }
  },
  {
    "name": "Purrpaws",
    "species" : "cat",
    "foods": {
      "likes": ["mice"],
      "dislikes": ["cookies"]
    }
  }
];

$(document).ready(function(){
$("#b1").click(function(){


  $.ajax(
  {
    url:"deleteme.php",
    type:"GET",
    async:false,
    data:{
      "name":"KTG",
      "score":"12",
      "time":"5"
    },
    success:function(data){
      $("#show").html(data);
    }
  });



});



});
