<?php
session_start();
include 'funkcijas.php';

include 'layout.php';

if (isset($_POST['name'])){
	updateId('clients',['name'=>$_POST['name']], $_POST['id']);
}

$result = getDataById('clients',$_GET['id']);
	
if ($result):?>
<form method="post">
  <fieldset>
    <legend>Klienta datu labošana</legend>
	<div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Vārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" required="true" value="<?=$result['name']?>">
      </div>
    </div>
	
	<input name="id" hidden="true" value="<?=$result['id']?>">
	
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

<?php else:?>

	<div class="alert alert-danger">Lapa nav atrasta</div>

<?php endif;
	include 'footer.php';
?>
