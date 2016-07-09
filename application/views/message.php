<script type="text/javascript">       
        var slide = $('#message').hide(0);
        var message = '<?php if($message){echo $message;} ?>';
        var error = '<?php if($error){echo $error;} ?>';
        
        if(message){
            slide.text(message).addClass((error)? 'msgerror' : 'success').fadeIn('slow');
            $('<span class=close>X</span>').prependTo(slide);
            slide.on('click', function() {
                    slide.slideUp('slow');
            }); 
        }
</script>