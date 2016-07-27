<div id="body_section">
<!-- Errors -->
<?php if ($message) { echo "<div class=\"yellow_bar\">".$message."</div>"; } ?>
<div id="body_section_inner">
<div class="contentPageWrapper">

<div class='mainInfo'>
<?php /* if(isset($_POST['submit'])) { print_r($final); }  */ ?>
 
<div id="form">
	<h1><?php echo $page_title; ?></h1>
    
	<p><strong><?php echo $this->lang->line("update_price"); ?></strong>: <a href="<?php echo $this->config->base_url(); ?>smlib/lib/sample_product_price.csv">Download CSV file Sample</a></p>
    
	<p><span style="color: #F60;"><?php echo $this->lang->line("csv1"); ?></span><br /><span style="color: #060;"><?php echo $this->lang->line("csv2"); ?> (<?php echo $this->lang->line("product_code"); ?>, <?php echo $this->lang->line("product_price"); ?>)</span> <?php echo $this->lang->line("csv3"); ?></p>
    
    <?php echo form_open_multipart("module=products&view=update_price");?>
            
      <p>
		<div>
		<label><?php echo $this->lang->line("upload_file"); ?>:</label>

				<div class="uploader" id="uniform-undefined"><input type="file" name="userfile" class="i-format" style="opacity: 0; "><span class="filename"><?php echo $this->lang->line("no_file_selected"); ?></span><span class="action"><?php echo $this->lang->line("choose_file"); ?></span></div>
					<span class="input_tips"><?php echo $this->lang->line("csv_file_tip"); ?></span>
				</div>

		<div class="clear"></div>
	  </p>
                           
      <p><?php echo form_submit('submit', $this->lang->line("update_price"), 'class="submitInput" style="margin-left: 110px;"');?></p>

      
    <?php echo form_close();?>
</div>
</div>

<div class="clr"></div>
</div>
<div class="clear"></div>
</div>
</div>