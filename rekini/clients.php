<?php
session_start();
include 'funkcijas.php';

if(isset($_POST['dzest'])){
	deleteId('clients', $_POST['id']);
}

$results = getData('clients','name');

include 'layout.php';

if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>



<div class="form-group mt-3">
	<a href="clients_add.php" class="btn btn-outline-primary">Pievienot klientu</a>
</div>

<?php
if($results) :?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Vārds</th>
      <th scope="col">Darbības</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($results as $result) :?>
    <tr>
		<td><?=$result['name']?></td>
		<td>
			<form method="post" id="dzest<?=$result['id']?>">
				<input name="id" hidden="true" value="<?=$result['id']?>">
			</form>
			<div class="btn-group">
				<a href="clients_edit.php?id=<?=$result['id']?>" class="btn btn-outline-primary">Labot</a>
				<button type="submit" class="btn btn-outline-danger" form="dzest<?=$result['id']?>" name="dzest">Dzēst</button>
				<a href="clients_invoices.php?id=<?=$result['id']?>" class="btn btn-outline-info">Rēķini</a>
			</div>
		</td>
    </tr>
<?php endforeach;?>
</tbody>
</table>

<?php else: ?>
<p>Nav ievadīts neviens klients</p>
<?php endif ?>

<?
include 'footer.php';