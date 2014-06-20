<script>
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
                    if(index == 0){
                        str += '<a href="'+obj.link.guid+'"><div class="daypart"><div class="daypart-image"><img src="' + obj.featured_img + '" alt="La Madeleine ' + obj.daypart + '"></div><div class="daypart-text"><div class="title">' + obj.daypart + '</div><div class="desc">' + obj.descriptor + '</div></div></div></a>';
                    }
                    else{
                        str += '<a href="'+obj.link.guid+'"><div class="daypart"><div class="daypart-image-bg" style="background-image: url(' + obj.featured_img + ');"></div><div class="daypart-text"><div class="title">' + obj.daypart + '</div><div class="desc">' + obj.descriptor + '</div></div></div></a>';
                    }

                });
                $('.widget-daypart .daypart-wrapper').append(str);
            }
        });
    }
</script>

<div class='widget widget-daypart'>
    <h3 class="hide-for-small"><?php echo $title; ?> </h3>
    <h3 class="show-for-small">Current Menu</h3>
    <div class="daypart-wrapper"></div>
</div>


