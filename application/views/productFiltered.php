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