<?php
class Model_articles extends CI_Model
{
	
	function get_articles() {
	
		$query = $this->db->query("	SELECT * FROM `glb_posts` ORDER BY `glb_posts`.`publish_up` DESC");
		
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}

	function add_article( $title, $subtitle, $alias, $content, $status, $catid, 
							$created, $created_by, $created_by_alias, $publish_up, 
							$image, $metakey, $metadesc, $hits , $featured) {

		$query = $this->db->query(	"INSERT INTO `glb_posts` (`id`, `sorting`, `title`,`subtitle`, `alias`, `fulltext`, `status`, 
																`catid`, `created`, `created_by`, `created_by_alias`, `modified`, 
																`modified_by`, `publish_up`, `images`, `metakey`, `metadesc`, `hits`, `featured`) 
									VALUES (NULL, '0', '$title','$subtitle', '$alias', '$content', '$status', 
											'$catid', '$created', '$created_by', '$created_by_alias', '0000-00-00 00:00:00', 
											'0', '$publish_up', '$image', '$metakey', '$metadesc', '0', '0')");
		return $this->db->insert_id();		
	}
	
	function select_article( $post_id ){
		
		$query = $this->db->query("SELECT * FROM `glb_posts` WHERE `glb_posts`.`id` = $post_id " );
		
		return $query->result_array();
	}
	
	function update_article( $post_id, $title,$subtitle, $alias, $content, $status, 
								$catid, $created, $created_by, $created_by_alias, $modified, $modified_by, 
								$publish_up, $image, $metakey, $metadesc){
		
		$query = $this->db->query("UPDATE `glb_posts` SET `title` = '$title',
									`subtitle` = '$subtitle',
									`alias` = '$alias',
									`fulltext` = '$content',
									`status` = '$status',
									`catid` = '$catid',
									`created` = '$created',
									`created_by` = '$created_by',
									`created_by_alias` = '$created_by_alias',
									`modified` = '$modified',
									`modified_by` = '$modified_by',
									`publish_up` = '$publish_up',
									`images` = '$image',
									`metakey` = '$metakey', 
									`metadesc` = '$metadesc'
									WHERE `glb_posts`.`id` =$post_id");
	
		return;
		
	}	
	
	function delete_article( $post_id ){
		
		$query = $this->db->query("DELETE FROM `glb_posts` WHERE `glb_posts`.`id` = $post_id " );
		return;
	}	
	
	function featured_image( $post_id ){
		
		$query = $this->db->query("SELECT images FROM `glb_posts` WHERE `glb_posts`.`id` = $post_id" );
		
		return;
	}
	
	function get_articles_by_catid($catid) {
		$dateNow = date("Y-m-d H:i:s");
		$query = $this->db->query('SELECT * FROM `glb_posts` WHERE catid = '.$catid.' 
									AND status = "published" 
									AND publish_up <= "'.$dateNow.'"
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 6');
								
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}	
		
	function get_article_second($catid , $latest_post_date) {
	
		$query = $this->db->query("	SELECT * FROM `glb_posts` 
									WHERE publish_up < '$latest_post_date' 
									AND status = 'published'
									AND `glb_posts`.`catid` = '$catid' 
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 6");
	
		$articles = $query->result_array();

		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
	
	function get_articles_by_catalias($alias) {
	
		$query = $this->db->query('SELECT * FROM `glb_posts` AS glb_p
									LEFT JOIN `glb_categories` AS glb_c
									ON glb_p.catid = glb_c.id
									WHERE glb_c.alias = "'.$alias.'"
									AND glb_p.status = "published" 
									ORDER BY glb_p.`publish_up` DESC');
		
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
	
	function get_latest_news() {

		$query = $this->db->query("	SELECT * FROM `glb_posts` 
									WHERE `glb_posts`.`catid` = '3' 
									AND `status` = 'published'
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 6 ");
									
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
		
	function get_latest_news_second($latest_post_id) {
		$query = $this->db->query("	SELECT * FROM `glb_posts` 
									WHERE publish_up < '$latest_post_id'  
									AND `glb_posts`.`catid` = '3'
									AND `status` = 'published'
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 6");
		
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
	
	function latest_articles_id() {
	
		$query = $this->db->query("	SELECT * FROM `glb_posts` AND `glb_posts`.`catid` = '3' ORDER BY `glb_posts`.`publish_up` DESC LIMIT 6");
		
		$articles 		= $query->result_array();
		$articles_id 	= $articles[0]['id'];
		
		if ( $articles_id ) { return $articles_id; }
		else { return null; }
		
	}
	
	function get_20latest_news() {

		$query = $this->db->query("	SELECT * FROM `glb_posts` 
									WHERE `glb_posts`.`catid` = '3' 
									AND `status` = 'published'
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 20");
									
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}	
	
	function get_20latest_prods_proms() {

		$query = $this->db->query("	SELECT * FROM `glb_posts` 
									WHERE `glb_posts`.`catid` = '4' 
									AND `status` = 'published'
									ORDER BY `glb_posts`.`publish_up` 
									DESC LIMIT 20");
									
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}

	function get_random_articles($catid,$post_id) {
		$dateNow = date("Y-m-d H:i:s");
		$query = $this->db->query('SELECT * FROM `glb_posts` WHERE catid = '.$catid.' 
									AND status = "published" 
									AND id != '.$post_id.'
									AND publish_up <= "'.$dateNow.'"
									ORDER BY RAND()
									DESC LIMIT 3');
									
		$articles = $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
	
	function dash_latest_articles() {
	
		$query = $this->db->query("SELECT glb_c.`title` AS cat_title, 
									glb_p.`title` AS art_title, 
									glb_p.`created_by` AS art_created_by
									FROM  `glb_posts` AS glb_p
									LEFT JOIN  `glb_categories` AS glb_c 
									ON glb_p.catid = glb_c.id
									ORDER BY glb_p.`id` DESC 
									LIMIT 5");
		
		$articles 		= $query->result_array();
		
		if ( $articles ) { return $articles; }
		else { return null; }
		
	}
	
}

?>