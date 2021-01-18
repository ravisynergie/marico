<script src="http://code.jquery.com/jquery.js"></script>
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/src/skdslider.js"></script>-->
<!--<link href="--><?php //echo base_url(); ?><!--assets/js/src/skdslider.css" rel="stylesheet">-->
<?php //$StudentParameter=array('CallType'=>'PicutreGallery','PageTitle'=>'Picutre&nbsp;Gallery');?>



<div id="demo2Slider" class="demo2Slider">
    <?php foreach ($GalleryData as $key=>$path){  ?>
        <div class="slide">
                      <a target="_blank" href="<?php echo  base_url().$path['ImagePath'] ?>" >
            <img src="<?php echo  base_url().$path['ImagePath']; ?>" style="height:370px" />
            <div class="slide-desc">
                <h2><?php echo $path['LocationName'] ?></h2>
                <p><?php echo $path['Caption'] ?></p>
            </div>
        </div>
    <?php } ?>
  
</div>

<div class="slider-please-wait">Please Wait...</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo2Slider').skdslider({
            slideSelector: '.slide',
            delay:3000,
            animationSpeed:2000,
            //æshowNav:false,
            showNextPrev:true,
            showPlayButton:true,
            autoSlide:true,
            animationType:'sliding'
        });
    });
   // $('#demo2Slider #slide-navs').hide();
setTimeout(function()
{
	jQuery('.slider-please-wait').hide();
	jQuery('#demo2Slider').show();
},4000);
</script>