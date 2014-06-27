<?php
/***** CONFIG ****/

        //Soup  Cost
        $soupCost = 12.99;
        $soupShippingIncremental = 3.99;

        //Dressing Cost
        $dressingCost = 9.99;
        $dressingShippingIncremental = 3.99;

        //Shippig
        $shippingBase = 5.99




?>

<script>

$(document).ready(function(){
        lamCart.getCartCookie();
        $('.product-button').click(function(){
                lamCart.addItem($(this));
        });
})



</script>

        <h2>Perfect Gifts</h2>
        <p>
        Now our signature Tomato Basil soupe and salade dressings are available for purchase online. Whether you’re giving gifts to someone special, or just to yourself, getting the taste of la Madeleine has never been easier.
        </p>

                <div>
                        <img src="/wp-content/uploads/2014/06/fma-3-full-174x90.jpg"><br>
                        <b>Tomato Basil Soupe Trio</b>
                        <p>Enjoy la Madeleine’s signature Tomato Basil Soupe. Three 15.5 fl. Oz jars.
                        <br>$<?php echo $soupCost ?>
                        </p>
                </div>
                <div>
                        <button class='btn clickable product-button' data-product='Tomato Basil Soupe Trio' data-cost='<?php echo $soupCost; ?>'  data-shipping='<?php echo $soupShippingIncremental; ?>' > Add To Cart </button>
                </div>



                <div>
                        <img src="/wp-content/uploads/2014/06/fma-3-full-174x90.jpg"><br>
                         <b>Salade Dressing Duet</b>
                         <p>Make the perfect gift with two of your favorite la Madeleine salade dressings. 
                         Choose from our signature Caesar or fat-free Caesar. The Caesar and Balsamic dressings 
                         are “all natural” and “gluten free”.</p>
                </div>

                <select id='dressingOptions'>
                        <option value="Two Bottles Original Caesar Dressing">Two Bottles Original Caesar Dressing</option>
                        <option value="Two Bottles Fat Free Caesar Dressing">Two Bottles Fat Free Caesar Dressing</option>
                        <option value="One Bottle Original Caesar Dressing and One Bottle Fat Free Caesar Dressing">One Bottle Original Caesar Dressing and One Bottle Fat Free Caesar Dressing</option>
                </select>

                <div>
                        <button class='btn clickable product-button' data-product='Salade Dressing Duet' data-relate='dressingOptions' data-cost='<?php echo $dressingCost; ?>'  data-shipping='<?php echo $dressingShippingIncremental; ?>'> Add To Cart </button>
                </div>


        <div id='cart'>

                <div id='items'></div>
                <hr>
                <div> <div> Subtotal: </div> <div id='itemsTotal'></div></div>
                <hr>
               <div> <div> Shipping: </div> <div id='shippingTotal'></div></div>
               <hr>
               <div> <div> Total<sup>*</sup>: </div> <div id='orderTotal'></div></div>
               <hr>
                <div><sup>*</sup> Tax will be calculated at time of payment</div>
        </div>
