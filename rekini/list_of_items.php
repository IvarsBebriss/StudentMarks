	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Prece</th>
				<th scope="col">Daudzums</th>
				<th scope="col">Vienība</th>
				<th scope="col">Cena</th>
				<th scope="col">Summa</th>
				<th scope="col">Darbības</th>
			</tr>
		</thead>
		<tbody>
		<?php if($items):?>
			<?php foreach($items as $item) :?>
				<?php $prece = getDataById('products',$item['product_id'])?>				
			<tr>	
				<td>
					<select class="form-control" name="list[<?=$counter?>][product_id]">
						<?php foreach($products as $product):?>
						<option <?=$product['id'] == $item['product_id'] ? 'selected ' : ''?> value="<?=$product['id']?>"><?=$product['name']?></option>
						<?php endforeach?>
					</select>
				</td>
				<td>
					<input class="form-control" name="list[<?=$counter?>][quantity]" type="number" step="0.001" min="0.001" value="<?=$item['quantity']?>">
				</td>
				<td>
					<input class="form-control-plaintext" type="text" disabled value="<?=$prece['unit']?>">
				</td>
				<td>
					<input class="form-control-plaintext" type="text" disabled value="<?=$prece['price'].'€'?>">
				</td>
				<td>
					<?php $summa=round($prece['price'] * $item['quantity'],2); $sum+=$summa;?>
					<input class="form-control-plaintext" type="text" disabled value="<?=$summa.'€'?>">
				</td>
				<td>
					<div class="btn-group">
						<button type="submit" class="btn btn-outline-danger" name="list[delete][<?=$item['id']?>]">Dzēst</button>
					</div>
				</td>
			</tr>
			<?php endforeach;?>
	
		<?php else:?>
			<tr>
				<td colspan=6>
					<div class="alert alert-info">Nav ierakstu</div>
				</td>
			</tr>
		<?php endif;?>
			<tr>
				<td>
					<select class="form-control" name="product_id">
						<option selected value="">Lūdzu, izvēlieties..</option>
						<?php foreach($products as $product):?>
						<option value="<?=$product['id']?>"><?=$product['name']?></option>
						<?php endforeach?>
					</select>
				</td>
				<td>
					<input class="form-control" name="quantity" type="number" step="0.001" min="0.001" value="">
				</td>
				<td>
					<input class="form-control-plaintext" type="text" disabled value="<?=0?>">
				</td>
				<td>
					<input class="form-control-plaintext" type="text" disabled value="<?=0 .'€'?>">
				</td>
				<td>
					<input class="form-control-plaintext" type="text" disabled value="<?=0 .'€'?>">
				</td>
				<td>
					<div class="btn-group">
						<button class="btn btn-outline-info" type="submit" name="add">Pievienot</button>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan=4 class="text-right">Kopā:</td>
				<td colspan=2 class="text-left"><strong><?=$sum.'€';?></strong></td>
				<input name="sum" hidden="" value="<?=$sum?>">
			</tr>	
		</tbody>
	</table>
</form>
