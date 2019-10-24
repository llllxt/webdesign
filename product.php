<div class="product center">
<div class="row center product_image">
<?php
echo '<a href="detail.php?id='.$product_id.'"class="">';
echo '<img class="center" id="img_'.$product_id.'" src='.$product_image.' alt="product image"  ></a>';
?>
</div>

<div class="row center product_name">
	<?php 
	echo '<a href="detail.php?id='.$product_id.'">';
	echo '<p class="textcenter">'.$product_name.'</p>';
	echo '</a>';
	?>
</div>
<div class="row center product_price">
	<div class="current_price">
		<p class="textcenter">
			<?php 
			$price = $product_discount * $product_price;
			echo '$'.number_format($price,2);
			?>
		</p>
	</div>
	<?php 
	if($product_discount>0){
		echo '<div class="pre_price">';
		echo '$' .number_format($product_price,2);
		echo '</div>';
	}
	?>
</div>
</div>