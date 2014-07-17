<script>

    // Polyfill trim() for IE8
    if(typeof String.prototype.trim !== 'function') {
      String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, ''); 
      };
    }

    // Get dayparts
    $(document).ready(function(){
        getDayParts();
    });
    function getDayParts(){
        var d = new Date();
        ts = Math.ceil((d.getTime()/1000));
        offset = d.getTimezoneOffset() *60;

        $.ajax({
            url:'/wp_api/v1/dayparts/'+ts+'/'+offset,
            success:function(data){
                var str = "";
                $.each(data, function(index, obj){

                    var menuCategories = $.parseJSON(obj.menu_cat),
                        categoryList = "";

                    $.each(menuCategories, function(key, category){
                        slug = category.trim().replace(/\s+/g, '-').toLowerCase();
                        categoryList += '<li data-cat-name="' + slug + '"><span>' + category + '</span></li>';
                    });

                    if(index == 0){
                        setDaypartCookie(obj);
                        str += '<a class="daypart-link ' + obj.link.post_name + '" href="'+obj.link.guid+'"><div class="daypart featured"><div class="daypart-image"><img src="' + obj.featured_img + '" alt="La Madeleine ' + obj.daypart + '"></div><div class="daypart-text"><div class="title">' + obj.daypart + '</div><div class="desc">' + obj.descriptor + '</div><ul class="categories">' + categoryList + '</ul></div></div></a>';
                    }
                    else{
                        str += '<a class="daypart-link ' + obj.link.post_name + '" href="'+obj.link.guid+'"><div class="daypart"><div class="daypart-image-thumb"><img src="' + obj.thumb_img + '" alt="La Madeleine ' + obj.daypart + '"></div><div class="daypart-text"><div class="title">' + obj.daypart + '</div><div class="desc">' + obj.descriptor + '</div><ul class="categories">' + categoryList + '</ul></div></div></div></a>';
                    }

                });
                $('.widget-daypart .daypart-wrapper').html(str);
            }
        });

        var setDaypartCookie = function(obj){
            // No expires property sets cookie to expire at end of session
            $.cookie("LAM-daypart", JSON.stringify(obj), {
               path: '/'
            });
        }
    }
</script>

<?php
if($onLocationPage != 'true') { ?>

<div class='widget widget-daypart home-daypart'>
    <h3><?php echo $title; ?> </h3>
    <div class="daypart-wrapper"></div>
</div>

<?php } ?>
