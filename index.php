<?php
session_start();
include 'funkcijas.php';

if(isset($_POST['dzest'])){
	dzesdatus($_POST['id']);
}
$results = getdata();

include 'layout.php';

if(isset($_SESSION['message'])){
	echo $_SESSION['message'];
	unset($_SESSION['message']);
}
?>

<div class="form-group mt-3">
	<a href="pievienot.php" class="btn btn-outline-primary">Pievienot studentu</a>
</div>

<?php
if($results) :?>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Vārds</th>
      <th scope="col">Uzvārds</th>
      <th scope="col">Grupa</th>
      <th scope="col">Darbības</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($results as $result) :?>
    <tr>
		<td><?=$result['vards']?></td>
		<td><?=$result['uzvards']?></td>
		<td><?=$result['grupa']?></td>
		<td>
			<form method="post" id="dzest<?=$result['id_stud']?>">
				<input name="id" hidden="true" value="<?=$result['id_stud']?>">
			</form>
			<div class="btn-group">
				<a href="labot.php?id=<?=$result['id_stud']?>" class="btn btn-outline-primary">Labot</a>
				<button type="submit" class="btn btn-outline-danger" form="dzest<?=$result['id_stud']?>" name="dzest">Dzēst</button>
				<a href="atzimes.php?id=<?=$result['id_stud']?>" class="btn btn-outline-info">Atzīmes</a>
			</div>
		</td>
    </tr>
<?php endforeach;?>
</tbody>
</table>

<?php else: ?>
<p>Nav ievadīts neviens students</p>
<?php endif ?>

<?
include 'footer.php';