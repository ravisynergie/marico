<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/src/skdslider.min.js"></script>
<link href="<?php echo base_url(); ?>assets/js/src/skdslider.css" rel="stylesheet">
<?php $GalleryParameter=array('CallType'=>'PicutreGallery','PageTitle'=>'Picutre&nbsp;Gallery');
//echo '<pre>';
//print_r($GalleryData);
//echo '</pre>';
?>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#demo1').skdslider({
          slideSelector: '.slide',
          delay:3000,
          animationSpeed:2000,
          //showNav:false,
          showNextPrev:false,
          showPlayButton:false,
          autoSlide:true,
          animationType:'sliding'
        });
        
    });
	
	function BigCliders()
	{
		OpenMaricoDashboard('<?php echo json_encode($GalleryParameter);?>');
	}
</script>


 <div id="demo1">
 	<?php foreach ($GalleryData as $key=>$path){

 	    ?>
      <div class="slide">
<!--          <a target="_blank" href="--><?php //echo  base_url().$path['ImagePath'] ?><!--" >-->
        <img src="<?php echo  base_url().$path['ImagePath']; ?>" style="height:370px" onclick="BigCliders()"/>
          </a>
         <div class="slide-desc">
            <h2><?php echo $path['LocationName'] ?></h2>
            <p><?php echo $path['Caption'] ?></p>
        </div>
     </div>
     <?php } ?>
 
</div>
