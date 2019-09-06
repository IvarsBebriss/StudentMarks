<?php
session_start();
include 'funkcijas.php';

include 'layout.php';

if (isset($_POST['name'])){
	updateId('products',['name'=>ucfirst($_POST['name']), 'unit'=>$_POST['unit'], 'price'=>$_POST['price']], $_POST['id']);
}

$result = getDataById('products',$_GET['id']);
	
if ($result):?>
<form method="post">
  <fieldset>
    <legend>Preces labošana</legend>
	<div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Nosaukums</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="name" required="true" value="<?=$result['name']?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="unit" class="col-sm-2 col-form-label">Vienība</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="unit" required="true" value="<?=$result['unit']?>">
      </div>
    </div>
	<div class="form-group row">
      <label for="price" class="col-sm-2 col-form-label">Cena</label>
      <div class="col-sm-5">
        <input type="number" min="0.01" step="0.01" class="form-control" name="price" required="true" value="<?=$result['price']?>">
      </div>
    </div>
	<input name="id" hidden="true" value="<?=$result['id']?>">
	
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

<?php else:?>

	<div class="alert alert-danger">Lapa nav atrasta</div>

<?php endif;
	include 'footer.php';
?>
