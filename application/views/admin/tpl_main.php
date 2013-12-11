<!DOCTYPE html>
<html lang="en">
	<head>	
		<title>IconX CMS Administration</title>		
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<meta name='description' content='IconX CMS Administration' />
		<meta name="author" content="jhoana">
		<meta name="viewport" content="width=device-width">		
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/Ajaxfileupload-jquery-1.3.2.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/ajaxupload.3.5.js"></script>	
		
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery-ui/jquery-1.9.1.js"></script>	
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/tinymce/tinymce.min.js"></script>	
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/util.js"></script>	
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/validate_form.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery-ui-1.10.3.custom.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>_assets/js/jquery.dataTables.js"></script>
		<script src="<?php echo base_url(); ?>_assets/js/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/admin/stylesheet.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/admin/notifications.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/js/jquery-ui/themes/base/jquery.ui.all.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>_assets/css/admin/<?php echo $page; ?>.css?<?php echo time(); ?>" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>_assets/js/uploadify/uploadify.css">
		<link rel="icon" type="image/png" href="<?php echo base_url(); ?>_assets/images/favicon.png">
		<!-- place in header of your html document -->
		<script>
		tinymce.init({
			selector: "textarea#content",
			theme: "modern",
			width : "100%",
			height: 400,
			plugins: [
				 "advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",
				 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
				 "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
			],
			extended_valid_elements : "p[style]",
			inline_styles : true,
			
			external_filemanager_path:"<?php echo base_url(); ?>_assets/js/filemanager/",
			filemanager_title:"Responsive Filemanager" ,
			external_plugins: { "filemanager" : "<?php echo base_url(); ?>_assets/js/filemanager/plugin.min.js"},

			
		   /*content_css: "css/content.css",*/
		   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons | pagebreak", 
		   style_formats: [
				{title: 'Bold text', inline: 'b'},
				{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
				{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
				{title: 'Example 1', inline: 'span', classes: 'example1'},
				{title: 'Example 2', inline: 'span', classes: 'example2'},
				{title: 'Table styles'},
				{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
			]
		 }); 
		</script>
	</head>	
	<body>
		<div id="container">
			<div id="adminbar">
				<ul class="top-menu">
					<!--<li> <a target="_blank" href="<?php echo base_url(); ?>">ICON X</a> </li>-->
					<li>
						<a id="" target="_blank" href="<?php echo base_url(); ?>">
							<img height="20" id="logo" src="<?php echo base_url(); ?>_assets/images/iconx-logo.png" alt="logo" />
						</a>
					</li>
				</ul>
				<ul class="account-top-menu">
					<li><?php echo $this->session->userdata('first_name')." ". $this->session->userdata('last_name') ; ?> </li>
				</ul>
			</div>	
	
			<div id="content-wrapper">
				<div id="sidebar">
					<ul class="sidebar-menu">
						<li> <a href="<?php echo base_url(); ?>admin/">Dashboard</a> </li>
						<li> <a href="<?php echo base_url(); ?>admin/articles">Articles</a> </li>
						<li> <a href="<?php echo base_url(); ?>admin/videos">Videos</a> </li>
						<li> <a href="<?php echo base_url(); ?>admin/albums">Photos</a> </li>
						<li> <a href="<?php echo base_url(); ?>admin/logout">Logout</a> </li>
					</ul>					
				</div>
				<?php include("tpl_notifications.php"); ?>				
				<div id="main-wrapper">
					<?php echo $content; ?>
				</div>				
			</div>			
		</div>
	</body>
	
</html>