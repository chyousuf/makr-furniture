    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <?php if(!is_front_page()){ ?>
        <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.fancybox.js"></script>
    <?php } ?>
    <script src="<?php bloginfo('template_url'); ?>/js/jquery.main2.js"></script>
    <script type="application/javascript">
        jQuery(window).on('load', function() {
            jQuery("#wrapper ~ div").css("display", "none");
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#topbar-close").on('click', function (){
                //$('.top-bar').addClass('close1');
                $(".top-bar").animate({ height: '0px' }, 500);
                $('.top-bar').hide('slow');
                return false;
            });
        });
    </script>
    <script>
        // Add Class in login and register form in my account page
        jQuery(document).ready(function($){
            var url = window.location.href;
            url = url.split("/");
            if(url[4] == "login"){
                $(".inner-register").addClass('remove');
            }
            if(url[4] == "register"){
                $(".inner-login").addClass('remove');
            }
        });
    </script>
    <script type="text/javascript">
        // Add Custom span check box and price b tag in addons
        $(document).ready(function(){
            $(".wcff-option-wrapper-label input").after(' <span class="custom-checkbox"></span>');
            $(".wcff-option-wrapper-label:contains('$')").html(function () {
                return $(this).html().replace("$", "..................<b>$");
            });
            $(".wcff-option-wrapper-label:contains('percent')").html(function () {
                return $(this).html().replace("percent", "..................<b>");
            });
            $(".wcff-option-wrapper-label:contains('(')").html(function () {
                return $(this).html().replace("(", " ");
            });
            $(".wcff-option-wrapper-label:contains(')')").html(function () {
                return $(this).html().replace(")", " ");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            if($('table').hasClass('wccpf_fields_table')){
                $(this).find('.woocommerce-variation-add-to-cart').addClass('active');
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#add_to_cart_button").on('click', function (){
                $("#submitFormData").trigger('click');
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function(){
            // jQuery('#pedestal_pulls_type').change(function () {
            //     var pedestalpullvalue = jQuery(this).find(':selected')[0].value;
            //     if(pedestalpullvalue != 'Pedestal Pulls Type'){
            //         jQuery('#pulls_quantity').removeClass('d-none');
            //         jQuery('#pulls_quantity').addClass('show');
            //     } else {
            //         jQuery('#pulls_quantity').addClass('d-none');
            //     }
            // });
            $("#pedestal_type option").prop("disabled", true);
            jQuery('#add_pedestal').change(function(){
                var pedestalvalue = jQuery(this).find(':selected')[0].value;
                if(pedestalvalue == 'Yes'){
                    $("#pedestal_type option").prop("disabled", false);
                }
                if(pedestalvalue == 'No' || pedestalvalue == 'Add Pedestal'){
                    $("#pedestal_type option").prop("disabled", true);
                }
           });
           // jQuery('#pedestal_type').change(function () {
           //     var pedestaltype = jQuery(this).find(':selected')[0].value;
           //      if(pedestaltype != 'Pedestal Type'){
           //          jQuery('#pedestal_quantity').removeClass('d-none');
           //          jQuery('#pedestal_quantity').addClass('show');
           //      } else {
           //          jQuery('#pedestal_quantity').addClass('d-none');
           //      }
           // });
           // jQuery('#door_pulls_type').change(function () {
           //      var doorpullstype = jQuery(this).find(':selected')[0].value;
           //      if(doorpullstype != 'Door Pulls Type'){
           //          jQuery('#door_pull_quantity').removeClass('d-none');
           //          jQuery('#door_pull_quantity').addClass('show');
           //      } else {
           //          jQuery('#door_pull_quantity').addClass('d-none');
           //      }
           // });
       });
    </script>
    <script type="text/javascript">
        $( "#cart-load-btn" ).click( function () {
            sessionStorage.reloadAfterPageLoad = true;
            window.location.reload();
            //setTimeout(function(){ afterload(); }, 100);
            afterload();
        });
        function afterload() {
            if ( sessionStorage.reloadAfterPageLoad ) {
                $("#add_to_cart_button").addClass("show");
                $( "#add_to_cart_button" ).trigger( "click" );
                sessionStorage.reloadAfterPageLoad = false;
                // $("#quote-message").removeClass('d-none');
            }
        }
        // $(window).on('load', function () {
        //     alert("Window Loaded");
        //     $( ".cart-btn-trigger" ).trigger( "click" );
        // });
    </script>
    <script type="text/javascript">
        function submit_form(){
            var dimensionvalue = $("#dimension").val();
            if(jQuery.type($("#dimension").val()) != 'undefined' && dimensionvalue != 'Dimension'){
                $('#add_to_cart_button').removeClass('d-none');
            } else {
                $('#add_to_cart_button').addClass('d-none');
            }
        }
    </script>
    <script type="text/javascript">
        $( ".options-page-tabs a" ).click( function () {
            setTimeout(function() {
                $("#back-top").removeClass("d-none");
            }, 600);
        });
        $( "#back-top" ).click( function () {
            setTimeout(function() {
                $("#back-top").addClass("d-none");
            }, 600);
        });
        $(window).scroll(function() {
            wh = window.pageYOffset;
            if(wh < 600){
                if($("#back-top").hasClass("d-none")){
                } else {
                    $("#back-top").addClass("d-none");
                }
            } else {
                $("#back-top").removeClass("d-none");
            }
        });
    </script>
    <?php if(!is_front_page()){ ?>
        <script type="text/javascript">
            $('a["title"]').on('mouseenter', function(e){
                e.preventDefault();
            });
            $(".thumb-list a").hover(function(){
            
            });

            $(".thumb-list a").click(function(){// Fired when we leave the element
            
            });
        </script>
        <script type="text/javascript">
            $("#loadimages").removeClass('d-none');
            function gallerycategoryfunction(obj) {
                $("#loadimages").addClass('d-none');
                $("#clearfilter").removeClass("d-none");
                //$(this).parent().addClass('test');
                var cat_val1 = [];
                var tag_val1 = [];
                var type_val1 = [];
                var cat_val = '';
                var tag_val = '';
                var type_val = '';
                $('label').removeClass('parent-checked');
                $.each($("input[name='gallery-cat']:checked"), function(){
                    $(this).parent().addClass('parent-checked');
                    cat_val1.push($(this).val());
                });
                if(cat_val1 !== ''){
                    //cat_val = cat_val1.join(", ");
                    cat_val = cat_val1;
                }
                $.each($("input[name='gallery-tag']:checked"), function(){
                    tag_val1.push($(this).val());
                });
                if(tag_val1 !== ''){
                    //tag_val = tag_val1.join(", ");
                    tag_val = tag_val1;
                }
                $.each($("input[name='gallery-type']:checked"), function(){
                    type_val1.push($(this).val());
                });
                if(type_val1 !== ''){
                    //type_val = type_val1.join(", ");
                    type_val = type_val1;
                }
                if(cat_val1 == '' &&  tag_val1 == '' && type_val == ''){
                    $("#clearfilter").addClass("d-none");
                }
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    dataType: "html", // add data type
                    data: { 
                        action : 'get_ajax_posts',
                        'cat-val' : cat_val,
                        'tag-val' : tag_val,
                        'type-val' : type_val,
                    },
                    beforeSend: function (xhr) {
                        jQuery(".gallery-spinner").addClass("show");
                    },
                    success: function( response ) {
                        jQuery(".gallery-spinner").removeClass("show");
                        console.log( response );
                        $('.gallery-data').remove();
                        $('.gallery-ajax').html( response ); 
                        $(".thumb-list a").hover(function(){
                            
                        });

                      $(".thumb-list a").click(function(){// Fired when we leave the element
                            
                        });
                      $(".moreimages2").slice(0, 15).show();
                        if ($(".blogBox:hidden").length != 0) {
                            $("#loadimages2").show();
                        }
                        $("#loadimages2").on('click', function (e) {
                            e.preventDefault();
                            $(".moreimages2:hidden").slice(0, 6).slideDown();
                            if ($(".moreimages:hidden").length == 0) {
                                $("#loadimages2").fadeOut('slow');
                            }
                        });
                    }
                });
            }
            $( "#clearfilter a" ).click( function () {
                var cat_val = '';
                var tag_val = '';
                var type_val = '';
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    dataType: "html", // add data type
                    data: { 
                        action : 'get_ajax_posts',
                        'cat-val' : cat_val,
                        'tag-val' : tag_val,
                        'type-val' : type_val,
                    },
                    beforeSend: function (xhr) {
                        jQuery(".gallery-spinner").addClass("show");
                    },
                    success: function( response ) {
                        jQuery(".gallery-spinner").removeClass("show");
                        $("#clearfilter").addClass("d-none");
                        $('input[type="checkbox"]').prop('checked', false);
                        $('input[type="radio"]').prop('checked', false);
                        $('label').removeClass('parent-checked');
                        console.log( response );
                        $('.gallery-data').remove();
                        $('.gallery-ajax').html( response ); 
                        $(".moreimages2").slice(0, 15).show();
                        if ($(".blogBox:hidden").length != 0) {
                            $("#loadimages2").show();
                        }
                        $("#loadimages2").on('click', function (e) {
                            e.preventDefault();
                            $(".moreimages2:hidden").slice(0, 6).slideDown();
                            if ($(".moreimages:hidden").length == 0) {
                                $("#loadimages2").fadeOut('slow');
                            }
                        });
                    }
                });
            });
        </script>
        <script type="text/javascript">
            $(".moreimages").slice(0, 15).show();
            if ($(".blogBox:hidden").length != 0) {
                $("#loadimages").show();
            }
            $("#loadimages").on('click', function (e) {
                e.preventDefault();
                $(".moreimages:hidden").slice(0, 6).slideDown();
                if ($(".moreimages:hidden").length == 0) {
                    $("#loadimages").fadeOut('slow');
                }
            });
        </script>
        <script type="text/javascript">
            $(window).on("scroll", function() {
                var scrollHeight = $(document).height();
                var scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    $('.load-spinner').show();
                    setTimeout(function() {
                        $('.load-spinner').hide();
                        $('#loadimages').click();
                        $('#loadimages2').click();
                    }, 1000);
                }
            });
        </script>
    <?php } ?>
    <?php wp_footer(); ?>
</body>
</html>
