<?php
session_start();
include 'funkcijas.php';

include 'layout.php';

if(isset($_POST['name'])){
	saveData('clients',['name'=>$_POST['name']]);
}

?>

<form method="post">
  <fieldset>
    <legend>Jauna klienta pievienošana</legend>
	<div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Vārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" required="true" value="<?=$_POST['name']??''?>">
      </div>
    </div>
	
	<div class="form-group row">
		<div class="col-sm-2">
			<a href="clients.php" class="btn btn-outline-secondary">Atpakaļ</a>
		</div>
		<div class="col-sm-5">
			<button type="submit" class="btn btn-outline-primary">Saglabāt</button>
		</div>
    </div>
  </fieldset>
</form>

<?php
include 'footer.php';