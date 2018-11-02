<?php
	include 'index.php';
?>
<div class="container" style="width:800px;">
   <h2 align="center">Crime Rating About Shabag</h2>
   <br />
   <span id="question_list"></span>
   <br />
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 load_business_data();
 
 function load_business_data()
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   success:function(data)
   {
    $('#question_list').html(data);
   }
  });
 }
 
 $(document).on('mouseenter', '.rating', function(){
  var index = $(this).data("index");
  var question_id = $(this).data('question_id');
  remove_background(question_id);
  for(var count = 1; count<=index; count++)
  {
   $('#'+question_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 function remove_background(question_id)
 {
  for(var count = 1; count <= 5; count++)
  {
   $('#'+question_id+'-'+count).css('color', '#ccc');
  }
 }
 
 $(document).on('mouseleave', '.rating', function(){
  var index = $(this).data("index");
  var question_id = $(this).data('question_id');
  var rating = $(this).data("rating");
  remove_background(question_id);
  //alert(rating);
  for(var count = 1; count<=rating; count++)
  {
   $('#'+question_id+'-'+count).css('color', '#ffcc00');
  }
 });
 
 $(document).on('click', '.rating', function(){
  var index = $(this).data("index");
  var question_id = $(this).data('question_id');
  $.ajax({
   url:"insert_rating.php",
   method:"POST",
   data:{index:index, question_id:question_id},
   success:function(data)
   {
    if(data == 'done')
    {
     load_business_data();
     alert("You have rate "+index +" out of 5");
    }
    else
    {
     alert("There is some problem in System");
    }
   }
  });
  
 });

});
</script>
