	<p class="title">Tìm Kiếm: 
		<?php  
			if (isset($this->key) && !empty($this->key)) {
			echo $this->key;
			}
		?>
	</p>
	<?php
	if (isset($this->data) && !empty($this->data)) {
		echo "<p>Kết quả:</p>";				
		echo $this->data;
		
		if (isset($this->pagelist) && !empty($this->pagelist)) {
			echo $this->pagelist;
		}		
	}
	else {		
		echo "<p>Not found</p>";		
	}
	?>

</div>
