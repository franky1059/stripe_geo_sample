
<h3>Buy Our Product</h3>
<img src="http://www.w3.org/html/logo/downloads/HTML5_Badge_512.png" style="width:20%"  />
<h4>Only $<?php echo $price; ?>!!</h4>
<form action="index.php?action=purchase" method="post">
  <script 
  	src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
    data-key="<?php echo Conf::STRIPE_PUBLISHABLE_KEY; ?>"
    data-amount="<?php echo $price*100; ?>" 
    data-description="One widget">
  </script>
</form>
