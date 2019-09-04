<?php
session_start();
include 'funkcijas.php';

include 'layout.php';

if(isset($_POST['vards'])){
	if (validateemail($_POST['epasts'])){
		savepost($_POST);
	} else {
		$_SESSION['error'] = '<div class="alert alert-danger">Nekorekti norādīta e-pasta adrese</div>';
	}
}

if(isset($_SESSION['error'])){
	echo $_SESSION['error'];
	unset($_SESSION['error']);
}
?>

<form method="post">
  <fieldset>
    <legend>Jauna studenta pievienošana</legend>
	<div class="form-group row">
      <label for="vards" class="col-sm-2 col-form-label">Vārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="vards" required="true" value="<?=$_POST['vards']??''?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="uzvards" class="col-sm-2 col-form-label">Uzvārds</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="uzvards" required="true" value="<?=$_POST['uzvards']??''?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="epasts" class="col-sm-2 col-form-label">e-pasts</label>
      <div class="col-sm-5">
        <input type="email" class="form-control" name="epasts" required="true" value="<?=$_POST['epasts']??''?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="grupa" class="col-sm-2 col-form-label">Grupa</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="grupa" required="true" value="<?=$_POST['grupa']??''?>"> 
      </div>
    </div>
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

<?php
include 'footer.php';