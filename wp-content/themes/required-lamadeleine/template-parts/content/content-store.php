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

        $paypalLink = "https://sandbox.PayPal.com/cgi-bin/webscr";
        $paypalUser = "cs45977@gmail.com"; //"guestrelations@lamadeleine.com";
        $returnURL = "get_site_url()";

?>

<script>

$(document).ready(function(){
        lamCart.getCartCookie(<?php echo $shippingBase ?>);
        $('.product-button').click(function(){
                lamCart.addItem($(this));
                $('.cart').show();
                
                $('.quantity').on('change',function(){
                    lamCart.recalculate(this);
                });

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
        })
})



</script>

<style>
    
    /*.store h1{
        font-size: 14px;
        margin: 10px 0;
        text-transform: uppercase;
        font-weight: bold;
        color: #310d00;
    }
*/
     p.subhead{
        /*$playfair*/
        font-family: "Playfair Display", serif;  
        font-style: italic;
        color: #310d00;
        line-height: 1.4;
    }
    
    .store-text{
        text-align: center;
    }

    .store_item{
        margin-bottom: 20px;
    }

    
    .store_item_image img{
        width:100%;
    }


    .btn , select {
        color: #fffdf0;
        font-family: "Lato", sans-serif;
        font-style: none;
        font-size: 12px;
        line-height: 16px;
        text-transform: uppercase;
        padding: 7px 30px 7px 20px;
        font-weight: bold;
        position: relative;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        border-radius: 5px;
        text-shadow: #310d00 0 -1px 0;
        -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0 2px 1px;
        -moz-box-shadow: rgba(0, 0, 0, 0.5) 0 2px 1px;
        box-shadow: rgba(0, 0, 0, 0.5) 0 2px 1px;
        background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, #b64507), color-stop(100%, #6c2904));
        background-image: -webkit-linear-gradient(#b64507, #6c2904);
        background-image: -moz-linear-gradient(#b64507, #6c2904);
        background-image: -o-linear-gradient(#b64507, #6c2904);
        background-image: linear-gradient(#b64507, #6c2904);
        -webkit-transition-property: background-image;
        -moz-transition-property: background-image;
        -o-transition-property: background-image;
        transition-property: background-image;
        -webkit-transition-duration: 0.3s;
        -moz-transition-duration: 0.3s;
        -o-transition-duration: 0.3s;
        transition-duration: 0.3s;
}

 select{
    width: 70%;
    height:30px;

    margin-bottom: 20px;
}

 div.cart{
    display: none;
    text-align: left;
    padding-left: 5%;
    background-color: #fff;
    border:1px solid #ccc;
    margin: 5px;
    /*max-width: 350px;*/
    height: 100%;
    padding: 7px;
    margin-bottom: 10px;
 }
 div.cart .title{
    float: left;
    padding-right: 5%;

 }
 div.cart .info{
    float: right;
    padding-right: 25%;
 }

div.cart .info:before {
  content: "$";
}

div.cart input {
    width: 60px;
    /*text-align: center;*/
}
.lineItem{
    width: 75%;
    overflow: visible;
    float: left;
    padding-right: 10px;
}
 .tallies{
    clear: both;
    padding: 10px;
 }
</style>
    <div class='store'>

    
            <div class='store-text row'>
                <h1>Perfect Gifts</h1>
                
                <p class='subhead'> Now our signature Tomato Basil soupe and salade dressings are available for purchase online. Whether you’re giving gifts to someone special, or just to yourself, getting the taste of la Madeleine has never been easier.</p>
            </div>

            <div class='store_item row'>
                <div class='store_item_image six columns' >
                        <img src="/wp-content/uploads/2014/06/fma-3-full-174x90.jpg"><br>
                </div>
                <div class='store_item_info six columns'>
                        <h4>Tomato Basil Soupe Trio</h4>
                        <p class='subhead' >Enjoy la Madeleine’s signature Tomato Basil Soupe. Three 15.5 fl. Oz jars.
                        <br>$<?php echo $soupCost ?>
                        </p>
                        <p><a class='btn  product-button' data-product='Tomato Basil Soupe Trio' data-cost='<?php echo $soupCost; ?>'  data-shipping='<?php echo $soupShippingIncremental; ?>' > Add To Cart </a></p>
                </div>
                
            </div>


            <div class='store_item row'>
                <div class='store_item_image six columns' >
                        <img src="/wp-content/uploads/2014/06/fma-3-full-174x90.jpg"><br>
                </div>
                <div class='store_item_info six columns'>
                        <h4>Salade Dressing Duet</h4>
                        <p class='subhead'>Make the perfect gift with two of your favorite la Madeleine salade dressings. 
                         Choose from our signature Caesar or fat-free Caesar. The Caesar and Balsamic dressings 
                         are “all natural” and “gluten free”.</p>
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
                <input type="hidden" name="hidden" value="<?php echo $returnURL?>">

                <!-- <input type="hidden" name="return" value="http://www.yoursite.com/thankyou.htm"> -->
           
              <p><a id='paypal' class='btn' > Check Out </a></p>


            </form>

        <!-- <div><sup>*</sup> Tax will be calculated at time of payment</div> -->
                
        </div>

        
    </div>
