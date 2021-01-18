<!--<script src="http://code.jquery.com/jquery.js"></script>-->
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/testimonial/skdslider.min.js"></script>-->
<!--<link href="--><?php //echo base_url(); ?><!--assets/js/testimonial/skdslider.css" rel="stylesheet">-->
<?php
//echo '<pre>';
//print_r($GalleryData);
//echo '</pre>';
$TestimonialParameter = array('CallType' => 'PicutreTestimonial', 'PageTitle' => 'Testimonial');
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo2').skdslider({
            slideSelector: '.slide',
            delay:3000,
            animationSpeed:2000,
            //showNav:false,
            showNextPrev:false,
            showPlayButton:false,
            autoSlide:true,
            animationType:'sliding',
        });

    });

    function BigTestimonial()
    {
        OpenMaricoDashboard('<?php echo json_encode($TestimonialParameter);?>');
    }

</script>


<div id="demo2">
    <?php foreach ($TestimonialData as $key=>$path){
       // $testimonnialParameter=array('CallType'=>'TestimonialData','PageTitle'=>'TESTIMONIAL', 'TestimonialId'=>$path['Id']);
        ?>
        <div class="slide">
<!--            <a onclick=OpenMaricoDashboard('--><?php //echo json_encode($testimonnialParameter);?>
<!--            ')>-->
                <img src="<?php echo  base_url().$path['ThumbImage']; ?>" style="height: 370px; width: auto" onclick="BigTestimonial()"/>
            </a>
            <div class="slide-desc" style="width: 100%">
<!--                <h2>--><?php //echo $path['Title'] ?><!--</h2>-->
                <p><?php echo $path['Title'] ?></p>
            </div>
        </div>
    <?php } ?>

</div>
