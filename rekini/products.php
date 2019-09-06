<?php
session_start();
include 'funkcijas.php';

if(isset($_POST['dzest'])){
	deleteId('products', $_POST['id']);
}

$results = getData('products','name');

include 'layout.php';

if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>

<div class="form-group mt-3">
	<a href="products_add.php" class="btn btn-outline-primary">Pievienot preci</a>
</div>

<?php
if($results) :?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Nosaukums</th>
	  <th scope="col">Vienība</th>
	  <th scope="col">Cena</th>
      <th scope="col">Darbības</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($results as $result) :?>
    <tr>
		<td><?=$result['name']?></td>
		<td><?=$result['unit']?></td>
		<td><?=$result['price']?></td>
		<td>
			<form method="post" id="dzest<?=$result['id']?>">
				<input name="id" hidden="true" value="<?=$result['id']?>">
			</form>
			<div class="btn-group">
				<a href="products_edit.php?id=<?=$result['id']?>" class="btn btn-outline-primary">Labot</a>
				<button type="submit" class="btn btn-outline-danger" form="dzest<?=$result['id']?>" name="dzest">Dzēst</button>
			</div>
		</td>
    </tr>
<?php endforeach;?>
</tbody>
</table>

<?php else: ?>
<p>Nav ievadīts neviens produkts</p>
<?php endif ?>

<?
include 'footer.php';