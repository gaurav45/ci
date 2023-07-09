<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');
*
{
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
    margin: 0;
    padding: 0;
}


body
{
    font-family: 'Roboto', sans-serif;
}
a
{
    text-decoration: none;
}
.product-card {
    width: 380px;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 50px auto;
    background: #fafafa;
}

.badge {
    position: absolute;
    left: 0;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
}

.product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    padding: 50px;
    background: #f0f0f0;
}

.product-tumb img {
    max-width: 100%;
    max-height: 100%;
}

.product-details {
    padding: 30px;
}

.product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
}

.product-details h4 a {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #363636;
    text-decoration: none;
    transition: 0.3s;
}

.product-details h4 a:hover {
    color: #fbb72c;
}

.product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
}

.product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.product-bottom-details div {
    float: left;
    width: 50%;
}

.product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
}

.product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
}

.product-links {
    text-align: right;
}

.product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
}

.product-links a:hover {
    color: #fbb72c;
}
</style>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="clearfix"></div>
<br/>
<br/>
<br/>
<br/>
<div class="row">
	<div class="col-sm-12">
	<?php if(!empty($products)){ 

		foreach ($products as $key => $value) { ?>
			
		

	
		<div class="col-sm-4">
			<div class="product-card">
				<div class="badge">Hot</div>
				<div class="product-tumb">
					<img src="https://i.imgur.com/xdbHo4E.png" alt="">
				</div>
				<div class="product-details">
					<span class="product-catagory"><?php echo $value->productLine;  ?></span>
					<h4><a href="">Women leather bag</a></h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero, possimus nostrum!</p>
					<div class="product-bottom-details">
						<div class="product-price" id="price_<?php echo $value->productCode; ?>"><?php echo $value->MSRP;  ?></div>
						<div class="product-links">
					      <button class="btn btn-primary bidButton" onclick="updateBid('<?php echo $value->productCode; ?>')">BID</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
	 } ?>
	</div>
</div>

<script type="text/javascript">
		function updateBid(productCode){
			let cpricne  = $('#price_'+productCode).text();
			$('#price_'+productCode).text(parseFloat(cpricne) + parseFloat(10));

			$.ajax({
				url : '<?php echo base_url('products/updateBid');?>',
	            data : { 'productCode' : productCode},
	            type:'POST',
	            success:function(data){
	               if(data >= 10){
	               	$(".bidButton").attr("disabled", true);
	               }
	            }
			});
		}


	
	     $(function(){

	         refreshBid(); 
	     })  

		 function timerss(){
		        var s1= new Date();
		        var c1= s1.setSeconds(s1.getSeconds() + 2);  // update in 2seconds

		        var x1= setInterval(function() { 
		            var n1= new Date().getTime();        
		            var d1= c1 - n1;

		            if (d1< 0) {

		                clearInterval(x1);            
		                refreshBid();
		            }
		        }, 1000);

		 };

		function refreshBid(){
         $.ajax({                                        
                url :'<?php echo base_url('products/refreshBid');?>',
                method:"POST",
                data: null, 
	            success:function(json){
	                var data = JSON.parse(json);
	                for (var i = 0; i <= data.length; i++) {
	                	if(typeof data[i] != 'undefined'){
	                	 	$('#price_'+data[i].productCode).text(data[i].MSRP);
	                	}
	                }
	                timerss();		
	            }            
	    });
	}   
</script>
