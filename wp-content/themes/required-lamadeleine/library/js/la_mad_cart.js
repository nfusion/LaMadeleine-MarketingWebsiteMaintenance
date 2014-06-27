var lamCart = {

        
        totalShipping:0,
        totalItems:0,
        totalOrder:0,
        shippingBase:0,

        initialize: function(base){
                this.shippingBase = parseFloat(base);
                this.totalShipping = this.shippingBase;
        },

        addItem : function(storeItem){

                if(typeof(storeItem.attr('data-relate')) =='undefined'){
                        itemLine = storeItem.attr('data-product');
                } else {
                        optionval = $('#'+storeItem.attr('data-relate')).val();
                        itemLine = storeItem.attr('data-product') +' - '+optionval;
                }

                cost =storeItem.attr('data-cost');
                shipping = storeItem.attr('data-shipping');


                this.addItemsTotal(cost);
                this.addShippingTotal(shipping);
                this.addOrderTotal();

                /** We need to generate a Dom ID **/
                itemLineDOMtext = itemLine.replace(/ /g,"");
                itemLineDOMtext = itemLineDOMtext.replace(/-/g,"");
                /*** Now get a jquery object to act on ***/
                itemLineDOM = $('#'+itemLineDOMtext);

                /*** If this is the fist time the item is added create a line ***/
                if(!itemLineDOM.get(0)){
                        $('#items').append( "<div id='"+itemLineDOMtext+"'>"+itemLine+"</div> <input type='number' id='"+itemLineDOMtext+"Quantity' class='quantity' value='1' data-cost='"+cost+"'  data-shipping='"+shipping+"'' ></input> ");
                } else {
                        $('#'+itemLineDOMtext+'Quantity').val(parseInt($('#'+itemLineDOMtext+'Quantity').val())+parseInt(1));
                }

                
        },

        addShippingTotal: function(increment){
                this.totalShipping += parseFloat(increment);

                $('#shippingTotal').html(this.totalShipping.toFixed(2));
        },

        addItemsTotal: function(increment){
                this.totalItems += parseFloat(increment);

                $('#itemsTotal').html(this.totalItems.toFixed(2));
        },

        addOrderTotal: function(){
                 this.totalOrder = parseFloat(this.totalItems) + parseFloat(this.totalShipping);

                $('#orderTotal').html(this.totalOrder.toFixed(2));
        },


        setCartCookie: function (){
            
            $.cookie("LAM-Shop", JSON.stringify(), {
               expires : 10,          //expires in 10 days
               path: '/'
            });
        }, 


        getCartCookie: function(baseShipping){
            
            cookieShop = $.cookie('LAM-Shop');

            if(typeof(cookieShop) != 'undefined'){
              
                jsonCookie = $.parseJSON(cookieShop);
                
            } else {
                this.initialize(baseShipping);
            }
            
        },

}