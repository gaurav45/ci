<style type="text/css">
	
	.product-card {
  margin: 0.4rem 0 !important;
}

.card {
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23) !important;
}

</style>
<div class="container" style="top: 100px;" >
    <div class="col-sm-3">
    	<select name="productLine" id="productLine" class="form-control" onchange="getProductByFilter('productLine')" >
    		<?php if(!empty($productLine)){ ?>
    			<option value="no_data">Select Product Line</option>
    			<?php 
    			 foreach ($productLine as $key => $lines) { ?>

    			<option value="<?php  echo $lines->productLine; ?>" <?php if($this->session->userdata('productLinesearch') == $lines->productLine) echo 'selected'; ?>><?php echo $lines->productLine; ?></option>
    			<?php }
    		} ?>
    	</select>
    </div>
   <div class="container">
  <div class="row">
    <div class=" col-12 col-md-2">
      <div class="card px-2">
        
        <div class="card-body">
          <form id="price-range-form">
            <label for="min-price" class="form-label">Min price: </label>
            <span id="min-price-txt">$<?php echo  !empty($this->session->userdata('minPrice')) ? $this->session->userdata('minPrice') : 0; ?></span>
            <input type="range" class="form-range" min="0" max="99" id="price-min" step="1" value="<?php !empty($this->session->userdata('minPrice')) ? $this->session->userdata('minPrice') : 0; ?>" onchange="getProductByFilter('price-min')">
            <label for="max-price" class="form-label">Max price: </label>
            <span id="max-price-txt">$<?php echo !empty($this->session->userdata('maxPrice')) ? $this->session->userdata('maxPrice') : 1000; ?></span>
            <input type="range" class="form-range" min="1" max="1000" id="price-max" step="1" value="<?php !empty($this->session->userdata('maxPrice')) ? $this->session->userdata('maxPrice') : 1000; ?> onchange="getProductByFilter('price-max')">
          </form>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-10">
      <div class="card">
        <div class="card-body">
          <div class="row" id="display-items-div">

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
    <div class="column" id="dataFull">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                	<!-- <th>Serial No. </th> -->
                    <th>Product Code</th>
                    <th>Name</th>
                    <th>Product Line</th>
                    <th>Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                	$i = 1;
                	foreach ($products as $product): ?>
                    <tr>
                    	<!-- <td><?= $i; ?></td> -->
                        <td><?= $product->productCode ?></td>
                        <td><?= $product->productName ?></td>
                        <td><?= $product->productLine ?></td>
                        <td><?= $product->MSRP ?></td>
                        <td><?= $product->productDescription ?></td>
                    </tr>
                <?php 
                $i++;
            	endforeach; ?>
            </tbody>
        </table>
        <button><?php echo $links; ?></button>
        <button>Total Products : <?php echo $totalProducts; ?></button>
    </div>
</div>
<script >
	
 function getProductByFilter(name){
 	var productLine = $('#productLine').val();

 	var minPrice  = $('#price-min').val();
 	var maxPrice = $('#price-max').val();
 	if(name=='productLine'){
 		 productLine =  $('#'+name+'').val();
 	}else if(name=='price-min'){
 		minPrice =  $('#'+name+'').val();
 	}else if(name=='price-max'){
 		maxPrice =  $('#'+name+'').val();
 	}
  	

  	$.ajax({
            url : '<?php echo base_url('products');?>',
            data : { 'productLine' : productLine ,'minPrice' :minPrice,'maxPrice':maxPrice},
            type:'POST',
            success:function(data){
                $('#dataFull').html(data);
            }
        });
  }	
let min_price = "?php !empty($this->session->userdata('minPrice')) ? $this->session->userdata('minPrice') : 0; ?>";
let max_price = "?php !empty($this->session->userdata('maxPrice')) ? $this->session->userdata('maxPrice') : 0; ?>";


$("#price-min").on("change mousemove", function () {
  min_price = parseInt($("#price-min").val());
  $("#min-price-txt").text("$" + min_price);
  
});

$("#price-max").on("change mousemove", function () {
  max_price = parseInt($("#price-max").val());
  $("#max-price-txt").text("$" + max_price);
  
});
</script>