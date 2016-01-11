<?php echo $header;?>

<?php echo $menu;?>
		<aside class="right-side">
			<!-- BEGIN CONTENT HEADER -->
			<section class="content-header">
				<i class="fa fa-laptop"></i>
				<span><?php echo lang('explnatory_videos_view');?></span>
				<ol class="breadcrumb">
					<li><a href="<?=site_url('home');?>"><?php echo lang('home');?></a></li>
                                         <li ><a href="<?=site_url('explanatory_video/index');?>"><?=lang('explanatory_video_list');?></a></li>
                                        <li class="active"><?=lang('txt_view');?></li>
				</ol>
			</section>
			<!-- END CONTENT HEADER -->
			<?php 
                         $message=$this->session->flashdata('message');
                         if($message!=''): ?>
                            <div class="alert alert-success">

                            <?php  echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>  
			<!-- BEGIN MAIN CONTENT -->
			<section class="content">
				<div class="row">
					<!-- BEGIN BASIC ELEMENTS -->
					
                                        <div class="col-md-12">
							<div class="grid">
							<div class="grid-header">
								<i class="fa fa-align-left"></i>
								<span class="grid-title">Video full name should be shown here</span>
								<div class="pull-right grid-tools">
									<a data-widget="collapse" title="Collapse"><i class="fa fa-chevron-up"></i></a>
									<a data-widget="reload" title="Reload"><i class="fa fa-refresh"></i></a>
									<a data-widget="remove" title="Remove"><i class="fa fa-times"></i></a>
								</div>
							</div>
							<div class="grid-body">
								
                                
                                <div class="row">
                                    <div class="col-lg-6 ">
                                        <div class="col no-padding"><span>
                                        	<div style="height:250px; background:#373737;"><iframe type='text/html' src='http://www.youtube.com/embed/PCwL3-hkKrg' frameborder='0' allowfullscreen='true'/></iframe></div>
                                        </span></div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                        
                                        <p><strong>Total Likes:</strong> New York City, NY, USA</p>
                                        <p><strong>Facebook:</strong> (123) 456-7890</p>
                                        <p><strong>Youtube:</strong> 18345</p>
                                        <p><strong>Total Share:</strong> 18345</p>
                                        <p><strong>Facebook:</strong> 18345</p>
                                        <p><strong>Twitter:</strong> 18345</p>
                                        <p><strong>E-mail:</strong>18345</p>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                
							</div>
						</div>
                        
						<div class="grid">
							
							<div class="grid-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                        
                                        <p class="col-lg-6 no-padding"><strong>Video title:</strong><span> New York City, NY, USA</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Topics:</strong><span> (123) 456-7890</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Video Description:</strong><span> 18345</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Tags:</strong><span> 18345</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Video ID:</strong><span> 18345</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Highlight Video:</strong><span> 18345</span></p>
                                        <p class="col-lg-6 no-padding"><strong>Website Status:</strong><span>18345</span></p>
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                
							</div>
						</div> 

					</div>
					<!-- END BASIC ELEMENTS -->
				</div>
<?php echo $footer;?>

    <script type="text/javascript">
    $(document).ready(function () {
        $("iframe").css ('width',100%);
         $("iframe").css ('height',100%);
       // $("iframe").width(10);
       // $("iframe").height(10);
    });
</script>