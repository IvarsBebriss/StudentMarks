<?php
session_start();
include 'funkcijas.php';

include 'layout.php';

if(isset($_POST['name'])){
	saveData('products',['name'=>ucfirst($_POST['name']), 'unit'=>$_POST['unit'], 'price'=>$_POST['price']]);
}

?>

<form method="post">
  <fieldset>
    <legend>Jaunas preces pievienošana</legend>
	<div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Nosaukums</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" required="true" value="<?=$_POST['name']??''?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="unit" class="col-sm-2 col-form-label">Vienība</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="unit" required="true" value="<?=$_POST['unit']??''?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="price" class="col-sm-2 col-form-label">Cena</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="price" required="true" value="<?=$_POST['price']??''?>">
      </div>
    </div>
	
	<div class="form-group row">
		<div class="col-sm-2">
			<a href="products.php" class="btn btn-outline-secondary">Atpakaļ</a>
		</div>
		<div class="col-sm-5">
			<button type="submit" class="btn btn-outline-primary">Saglabāt</button>
		</div>
    </div>
  </fieldset>
</form>

<?php
include 'footer.php';