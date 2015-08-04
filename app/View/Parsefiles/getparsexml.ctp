<div class="container ">
	<h3 id="msg" class="text-center"></h3>
		<div class="col-md-12 column">
			<table  class="table">
				<thead>
					<tr>
						<th>
							Name Xml File
						</th>
						<th>
							id_product
						</th>
						<th>
							Sku
						</th>
						<th>
							Ean
						</th>
						<th>
							Name
						</th>
						<th>
							Stock
						</th>
						<th>
							Availability
						</th>
						<th>
							Last check file
						</th>
					</tr>
				</thead>
				<tbody >
			
					<?php foreach ($parsefiles as $parsefile): ?>
				
					<tr  class="success">
						<td>
								<?php echo h($parsefile['uploadxmls']['xml']) ;?>
						</td>
						<td>
							<?php echo h($parsefile['Parsefile']['id_product']) ;?>
						</td>
						<td>
							<?php echo h($parsefile['Parsefile']['sku']) ;?>
						</td>
						<td>
							<?php echo h($parsefile['Parsefile']['ean']) ;?>
						</td>
						<td>
								<?php echo h($parsefile['Parsefile']['name']) ;?>
						</td>
						<td>
								<?php echo h($parsefile['Parsefile']['stock']) ;?>
						</td>
						<td>
								<?php echo h($parsefile['Parsefile']['availability']) ;?>
						</td>
						<td>
								<?php echo h($parsefile['uploadxmls']['last_check']) ;?>
						</td>
					</tr>
							<?php endforeach; ?>
			
			
				</tbody>
			</table>
		</div>
	</div>