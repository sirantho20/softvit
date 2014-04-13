<?php if(CART66_PRO && $track != 1): ?>
  <div class="Cart66Error" style="width: 500px;">
    <h1><?php _e( 'Inventory Tracking Is Not Active' , 'cart66' ); ?></h1>
    <p><?php _e( 'You must enable inventory tracking in in the <a href="'.$wpurl.'/wp-admin/admin.php?page=cart66-settings">settings panel</a>.' , 'cart66' ); ?></p>
  </div>
<?php endif; ?>

<p style="width: 400px;"><?php _e( 'Track your inventory by selecting the checkbox next to the products you want to track and enter 
  the quantity you have in stock in the text field. If you are tracking inventory for a product, Cart66 will check the 
  inventory levels every time a product is added to the shopping cart, every time the quantity of a product in the shopping 
  cart is changed, and on the checkout page. Inventory is reduced after a successful sale, not when a product is added to 
  the shopping cart.' , 'cart66' ); ?></p>

<?php if(count($products)): ?>
  <script type="text/javascript">
    (function($){
      $(document).ready(function(){
        $(".Cart66BoxSelectAll").click(function(){
  				 $(".Cart66InventoryCheckbox").attr('checked',true);
  			})

  			$(".Cart66BoxSelectNone").click(function(){
  				 $(".Cart66InventoryCheckbox").attr('checked',false);
  			})

  			$(".Cart66BoxSelectQty").click(function(){
  				 $(".Cart66InventoryCheckbox").each(function(){
  						if($(this).parent().parent().find(".Cart66InventoryQty").val()>0){
  							$(this).attr("checked",true);
  						}
  				 })
  			})
      })
    })(jQuery);
  </script> 
	
<div class="Cart66SelectAll">
	 <span class="Cart66BoxSelectAll"><?php _e( 'Select All' , 'cart66' ); ?></span> | 
	 <span class="Cart66BoxSelectNone"><?php _e( 'Select None' , 'cart66' ); ?></span> |
   <span class="Cart66BoxSelectQty"><?php _e( 'Select With Quantity' , 'cart66' ); ?></span>
</div>
<form action="" method="post">
  <input type="hidden" name="cart66-task" value="save-inventory-form" id="cart66-task" />
  <table class="widefat Cart66HighlightTable" style="margin: 0px; width: auto;">
  <thead>
  	<tr>
  	  <th><?php _e( 'Track' , 'cart66' ); ?></th>
  	  <th><?php _e( 'Product Name' , 'cart66' ); ?></th>
  		<th><?php _e( 'Product Variation' , 'cart66' ); ?></th>
  		<th><?php _e( 'Quantity' , 'cart66' ); ?></th>
  	</tr>
  </thead>
  <tfoot>
      <tr>
        <th><?php _e( 'Track' , 'cart66' ); ?></th>
    		<th><?php _e( 'Product Name' , 'cart66' ); ?></th>
    		<th><?php _e( 'Product Variation' , 'cart66' ); ?></th>
    		<th><?php _e( 'Quantity' , 'cart66' ); ?></th>
    	</tr>
  </tfoot>
  <tbody>
    <?php
      $ikeyList = array();
      foreach($products as $p) {
        $p->insertInventoryData();
        $combos = $p->getAllOptionCombinations();
        if(count($combos)) {
          foreach($combos as $c) {
            $k = $p->getInventoryKey($c);
            $ikeyList[] = $k;
            if($save) { $p->updateInventoryFromPost($k); }
            ?>
            <tr>
              <td><input type="checkbox" name="track_<?php echo $k ?>" value="1" id="track_<?php echo $k ?>" <?php echo ($p->isInventoryTracked($k)) ? 'checked="checked"' : ''; ?> class="Cart66InventoryCheckbox" /></td>
              <td><?php echo $p->name ?></td>
              <td><?php echo $c ?></td>
              <td><input type="text" name="qty_<?php echo $k ?>" value="<?php echo $p->getInventoryCount($k); ?>" id="qty_<?php echo $k ?>" style="width:50px;" class="Cart66InventoryQty" />
            </tr>
            <?php
          }
        }
        else {
          $k = $p->getInventoryKey();
          $ikeyList[] = $k;
          if($save) { $p->updateInventoryFromPost($k); }
          ?>
            <tr>
              <td><input type="checkbox" name="track_<?php echo $k ?>" value="1" id="track_<?php echo $k ?>" <?php echo ($p->isInventoryTracked($k)) ? 'checked="checked"' : ''; ?> class="Cart66InventoryCheckbox" /></td>
              <td><?php echo $p->name ?></td>
              <td>&nbsp;</td>
              <td><input type="text" name="qty_<?php echo $k ?>" value="<?php echo $p->getInventoryCount($k); ?>" id="qty_<?php echo $k ?>" style="width:50px;" class="Cart66InventoryQty" />
            </tr>
          <?php          
        }
      }
    
      if($save) { $p->pruneInventory($ikeyList); }
    ?>
  </tbody>
  </table>

  <input type="submit" name="submit" value="Save" id="submit" style="width: 80px; margin-top: 20px;" class="button-primary" />
</form>
<?php else: ?>
  <p><?php _e( 'You do not have any products' , 'cart66' ); ?></p>
<?php endif; ?>