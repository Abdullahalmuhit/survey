<?php
include 'header.php';
?>
<div class="jumbotron text-center">
	<h2 align="center">Welcome to Crime Rating</h2><br>
    <form action="area.php" method="post" role="form" class="form-inline" class="container center_div" style="align-items: center">
      <div class="form-group">
        <label for="sel1">Select Area</label>
        <select name="select" class="form-control" id="sel1">
          <option value="Dhanmondi">Dhanmondi</option>
          <option value="Dhaka">Dhaka</option>
        </select>
      </div>
      <input type="submit" name="search" value="search" class="btn btn-primary"></input>
    </form>
  </div>
 </body>
</html>
