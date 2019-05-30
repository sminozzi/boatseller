<?php
/**
 * @author William Sergio Minossi
 * @copyright 2017
 */
?>
   <div id="boatseller-steps3">
       <div class="boatseller-block-title"> 
           <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/3steps.png" />
           <br />   <br />
           Follow this 3 steps after install the theme:
       </div>
    <div class="boatseller-help-container1">
        <div class="boatseller-help-column boatseller-help-column-1">
        <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step1.png" />
          <h3>Install Plugins</h3>
          After activate the theme, will show up top of your desktop:
           <em>Begin Installing Plugins</em>.
           <br />
          Just click over to install and activate all the required plugins.
           <br />
           Free Plugins included:
           <br />
           - Boat Dealer Plugin
           <br />
           - Anti Hacker Protection 
           <br />
           - Slider
           <br />
           - Shortcodes
           <br />
           - More ....
           <br />
       </div> <!-- "Column1">  -->      
        <div class="boatseller-help-column boatseller-help-column-2">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step2.png" />
            <h3>Install Demo Data (optional)</h3>
            To get the same look and feel of the demo site, install the demo data (only if you have now a blank website).
            <br />
            If necessary, to clear all data of your site and begin from fresh start, 
            we suggest to use this free plugin:
            Reset WP 
            <br /><br />             
            To use one click install demo feature, go to:
            <br />
            <strong>dashboard => Appearance => Import Demo Data</strong>
            <br /><br />
        </div> <!-- "columns 2">  --> 
       <div class="boatseller-help-column boatseller-help-column-3">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/step3.png" />
            <h3>Theme Management</h3>  
            To manage the theme, click Appearance => Customize at the left menu or click the button bellow...
            <br /><br />   
            <a href="<?php echo get_site_url()?>/wp-admin/customize.php?return=%2Fwp-admin%2Findex.php" class="button button-primary">Theme Management</a>
        </div> <!-- "Column 3">  --> 
    </div> <!-- "Container 1 " -->    
   </div> <!-- "boatseller-steps3"> -->
   <div id="boatseller-services3">
     <div class="boatseller-block-title">
      Help, Support, Troubleshooting:
    </div>
    <div class="boatseller-help-container1">
        <div class="boatseller-help-column boatseller-help-column-1">
           <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/support.png" />
          <h3>Help and more tips</h3>
          Just click the HELP button at top right corner this page or click Open Help.
          <br />
          If you Opt-In, you are qualified to contact our support directly from this page for 30 days. It is not necessary leave this page . 
          <br /><br />
          <?php 
          if( memory_status())
            echo '<a href="#" id="boatseller-open-help" class="button button-primary">Open Help</a>';
          else
            echo '<a href="#" id= "nohelp" class="button button-primary">Help</a>';
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
          if( memory_status())
            echo '<a href="#" id="boatseller-send-support" class="button button-primary">Open Support Form</a>';
          else
            echo '<a href="#" id= "nosupport" class="button button-primary">Support</a>';
          ?>
          <br /><br />
       </div> <!-- "Column1">  -->   
        <div class="boatseller-help-column boatseller-help-column-2">
            <img alt="aux" src="<?php echo get_template_directory_uri()?>/images/service_configuration.png" />
          <h3>OnLine Guide, Support, Demo Video, Faq...</h3>  
          You will find our complete and updated OnLine guide, demo video, faqs page, link to support page and more usefull stuff in our site.
          <br /><br />
          <?php $site = 'http://boatsellerthemes.com'; ?>
         <a href="<?php echo $site;?>" class="button button-primary">Go</a>
         &nbsp;&nbsp;&nbsp;&nbsp;
         <a href="<?php echo $site;?>/premium" class="button button-primary">Upgrade to Premium</a>
        </div> <!-- "columns 2">  --> 
       <div class="boatseller-help-column boatseller-help-column-3">
         <img alt="aux" src="<?php echo get_template_directory_uri() ?>/images/system_health.png" />
          <h3>Troubleshooting Guide</h3>  
          Use old WordPress version, Low memory, some plugin with Javascript error, wrong permalink settings are some possible problems. Read this and fix it quickly!
          <br /><br />
          <a href="http://siterightaway.net/troubleshooting/" class="button button-primary">Troubleshooting Page</a>
       </div> <!-- "Column 3">  --> 
    </div> <!-- "Container1 ">  -->   
   </div> <!-- "services"> -->