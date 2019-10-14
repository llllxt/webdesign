<div class="product">
	<div class="product_img">
		
	</div>
	<div class="product_name">
		<?php
		echo '<a href="./productdetial.php?id=' .$product_id .'">';
		echo $product_name;
		echo '</a>';
		?>
	</div>
	<div class="product_price">
		<div class="product_price_current">
			<h2 class="price">
				<?php
				$discount_price = (1-$discount/(flaot)100)*$product_price;
				echo "$" .number_format($discount_price,2);
				?>
			</h2>
			<p>
				<?php
				if($discount>0){
					echo "$" .number_format($product_price,2);
				}
				?>
			</p>
		</div>

	</div>

</div>
