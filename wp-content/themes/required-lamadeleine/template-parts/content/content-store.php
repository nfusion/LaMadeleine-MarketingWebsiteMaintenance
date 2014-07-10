<?php
/***** CONFIG ****/

        //Soup  Cost
        $soupCost = 12.99;
        $soupShippingIncremental = 3.99;

        //Dressing Cost
        $dressingCost = 9.99;
        $dressingShippingIncremental = 3.99;

        //Shippig
        $shippingBase = 5.99;

        $paypalLink = "https://www.paypal.com/cgi-bin/webscr";//https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/general/OptionalAccount-outside";
        /*** https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/cps/general/OptionalAccount-outside **/
        $paypalUser = "guestrelations@lamadeleine.com"; 
        
        $returnURL = get_site_url().'/thank-you';

?>

<script>

$(document).ready(function(){
        lamCart.getCartCookie(<?php echo $shippingBase ?>);
        $('.product-button').click(function(){
                $(this).parent().append('<div class = "item_added"> <a href="#cart"> Item added to cart</a></div>');
                lamCart.addItem($(this));
                $('.cart').show();
                
                $('.quantity').on('change',function(){
                    lamCart.recalculate(this);
                });

                $('.item_added').delay(2500).fadeOut();
        });

        

        // on('focus', function(){
        //     cd
        // });
        $('.quantity').on('focus',function(){
          j
            lamCart.recalculate(this);
        });

        $('#paypal').click(function(e){
            lamCart.prepPayment();
            event.preventDefault();
        });

        
})



</script>

<style>
    
    
</style>
    <div class='store'>
    
            <div class='store-text row'>
                <h1>Share the Joie & Give the Gift of la Madeleine</h1>
            </div>   
                <div class='store_item row'>
                    <div class='store_item_image six columns' >
                            <img src="/wp-content/uploads/2014/07/card.jpg"><br>
                    </div>
                    <div class='store_item_info six columns'>
                        <h4>Gift Cards</h4>
                    <p> 
                        La Madeleine gift cards are perfect for anyone who likes French country inspired cuisine. The cards can currently be purchased in-store, reloaded at any la Madeleine location, and checking your balance is as easy as calling 1-877-893-0012. Share la Madeleine with someone you love and give a gift card today.
                    </p>

                     <p><a href='https://lamadeleine.myguestaccount.com/login/web_card_sale/selectcards.srv?m_id=64&pid=26' target='new' class='btn '> Purchase a Gift Card </a></p>
                        <br>
                     <p><a href='https://lamadeleine.myguestaccount.com/login/accountbalance.srv?id=vKVo8rXxlhE%3d' target='new' class='btn '> Check your Gift Card Balance </a></p>

                    </div>
                
                </div>
    

            <div class='store-items row'>
                 
                <p>Now our signature Tomato Basil soupe and salade dressings are available for purchase online. Whether you’re giving gifts to someone special, or just to yourself, getting the taste of la Madeleine has never been easier.</p>
          
            </div>   
                <div 

            <div class='store_item row'>

                <div class='store_item_image six columns' >
                        <img src="/wp-content/uploads/2014/06/LM_FMA_HopeByTheJarful.jpg"><br>
                </div>
                <div class='store_item_info six columns'>
                        <h4>Tomato Basil Soupe Trio</h4>
                        <p>Enjoy la Madeleine’s famous Tomato Basil Soupe or Reduced Fat Tomato Basil Soupe at home! Three 15.5 fl. Oz jars.
                        <br>$<?php echo $soupCost ?>
                        </p>
                        <p><a class='btn product-button' data-product='Tomato Basil Soupe Trio' data-cost='<?php echo $soupCost; ?>'  data-shipping='<?php echo $soupShippingIncremental; ?>' > Add To Cart </a></p>
                </div>
                
            </div>


            <div class='store_item row'>
                <div class='store_item_image six columns' >
                        <img src="/wp-content/uploads/2014/07/caesar.jpg"><br>
                </div>
                <div class='store_item_info six columns'>
                        <h4>Salade Dressing Duet</h4>
                        <p>Make the perfect gift with two of your favorite la Madeleine salade dressings. Choose from our signature Caesar, fat-free Caesar or Balsamic Vinaigrette.  La Madeleine dressings are all-natural and gluten-free.
                        <br>$<?php echo $dressingCost ?>
                        </p>
                        <select id='dressingOptions'>
                            <option value="Two Bottles Original Caesar Dressing">Two Bottles Original Caesar</option>
                            <option value="Two Bottles Fat Free Caesar Dressing">Two Bottles Fat Free Caesar</option>
                            <option value="One Bottle Original Caesar Dressing and One Bottle Fat Free Caesar Dressing">One Original Caesar Dressing and One Fat Free Caesar </option>
                        </select>
                         <p><a class='btn  product-button' data-product='Salade Dressing Duet' data-relate='dressingOptions' data-cost='<?php echo $dressingCost; ?>'  data-shipping='<?php echo $dressingShippingIncremental; ?>'> Add To Cart </a></p>
                </div>
                
            </div>
            


                <!-- <div>
                        <img src="/wp-content/uploads/2014/06/fma-3-full-174x90.jpg"><br>
                         <h1>Salade Dressing Duet</h1>
                         <p class='subhead'>Make the perfect gift with two of your favorite la Madeleine salade dressings. 
                         Choose from our signature Caesar or fat-free Caesar. The Caesar and Balsamic dressings 
                         are “all natural” and “gluten free”.</p>
                </div>

                <select id='dressingOptions'>
                        <option value="Two Bottles Original Caesar Dressing">Two Bottles Original Caesar</option>
                        <option value="Two Bottles Fat Free Caesar Dressing">Two Bottles Fat Free Caesar</option>
                        <option value="One Bottle Original Caesar Dressing and One Bottle Fat Free Caesar Dressing">One Original Caesar Dressing and One Fat Free Caesar </option>
                </select>

                <div>
                         <p><a class='btn  product-button' data-product='Salade Dressing Duet' data-relate='dressingOptions' data-cost='<?php echo $dressingCost; ?>'  data-shipping='<?php echo $dressingShippingIncremental; ?>'> Add To Cart </a></p>

                </div> -->

        <a name="cart"></a>
        <div class='cart row'>

            <div id='items'></div>

            <div class='tallies'> <div class='title'> Subtotal: </div> <div id='itemsTotal' class='info'></div></div>

            <div class='tallies'> <div class='title'> Shipping: </div> <div id='shippingTotal' class='info'></div></div>

            <div class='tallies'> <div class='title'> Total<sup></sup>: </div> <div id='orderTotal' class='info'></div></div>

            <br>
           
            <form id='payPal' method="post" action="<?php echo $paypalLink ?>">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="upload" value="1">  <!-- add this line in your code -->
                <input type="hidden" name="business" value="<?php echo $paypalUser ?>">
                <input type="hidden" name="upload" value="1">  <!-- add this line in your code -->
                <input type="hidden" id='payPalShipping' name="shipping_1" value="1.00">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="return" value="<?php echo $returnURL?>">

                <!-- <input type="hidden" name="return" value="http://www.yoursite.com/thankyou.htm"> -->
           
              <p><a id='paypal' class='btn' > Check Out </a></p>


            </form>

        <!-- <div><sup>*</sup> Tax will be calculated at time of payment</div> -->
                
        </div>

        
    </div>
