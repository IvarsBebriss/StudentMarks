<?php
session_start();
include 'funkcijas.php';

if (isset($_POST['vards'])){
	if (validateemail($_POST['epasts'])){
		updatepost($_POST);
	} else {
		$_SESSION['error'] = '<div class="alert alert-danger">Nekorekti norādīta e-pasta adrese</div>';
	}
}

include 'layout.php';

if(isset($_SESSION['error'])){
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}

$result = getstudent($_GET['id']);
	
if ($result):?>
<form method="post">
  <fieldset>
    <legend>Studentu datu labošana</legend>
	<div class="form-group row">
      <label for="vards" class="col-sm-2 col-form-label">Vārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="vards" required="true" value="<?=$result['vards']?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="uzvards" class="col-sm-2 col-form-label">Uzvārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="uzvards" required="true"  value="<?=$result['uzvards']?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="epasts" class="col-sm-2 col-form-label">e-pasts</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" name="epasts" required="true" value="<?=$result['epasts']?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="grupa" class="col-sm-2 col-form-label">Grupa</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="grupa" required="true" value="<?=$result['grupa']?>">
      </div>
    </div>
	<input name="id" hidden="true" value="<?=$result['id_stud']?>"> 
	<div class="form-group row">
		<div class="col-sm-2">
			<a href="index.php" class="btn btn-outline-secondary">Atpakaļ</a>
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
