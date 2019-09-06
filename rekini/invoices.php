<?php
session_start();
include 'funkcijas.php';

if(isset($_POST['dzest'])){
	deleteId('invoices', $_POST['id']);
}

$results = getData('invoices','date');

include 'layout.php';

if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>

<div class="form-group mt-3">
	<a href="invoices_add.php" class="btn btn-outline-primary">Pievienot rēķinu</a>
</div>

<?php
if($results) :?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Datums</th>
	  <th scope="col">Klients</th>
	  <th scope="col">Summa</th>
      <th scope="col">Darbības</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($results as $result) :?>
    <tr>
		<td><?=$result['date']?></td>
		<td><?php
		$client = getDataById('clients',$result['client_id']);
		echo $client['name'];?>
		</td>
		<td><?=$result['sum'].'€'?></td>
		<td>
			<form method="post" id="dzest<?=$result['id']?>">
				<input name="id" hidden="true" value="<?=$result['id']?>">
			</form>
			<div class="btn-group">
				<a href="invoices_edit.php?id=<?=$result['id']?>" class="btn btn-outline-primary">Labot</a>
				<button type="submit" class="btn btn-outline-danger" form="dzest<?=$result['id']?>" name="dzest">Dzēst</button>
			</div>
		</td>
    </tr>
<?php endforeach;?>
</tbody>
</table>

<?php else: ?>
<p>Nav ievadīts neviens rēķins</p>
<?php endif ?>

<?
include 'footer.php';