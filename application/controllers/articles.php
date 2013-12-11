<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends GLB_Controller {

	public function index() {
		
		$_data 				= array();
		$_data['page'] 		= "articles";
		$_data['testing'] 	= $this->get_latest_news();
		
		$this->load->view('tpl_articles', $_data);
	}

	public function news(){
	
		$_data['ctr'] = "first";
		$_data['data'] = $this->model_articles->get_articles_by_catid(3);
		echo  $this->load->view('tpl_articles_news', $_data,TRUE);
		
	}	
	
	public function get_latest_news_second($last_date){

		$_data['ctr'] = "second";
		$_data['data'] = $this->model_articles->get_article_second('3', $last_date);
		echo $this->load->view('tpl_articles_news_second', $_data, TRUE);			

	}
	
	public function product_and_promos(){
	
		$_data['ctr'] = "first";
		$_data['data'] = $this->model_articles->get_articles_by_catid(4);
		echo  $this->load->view('tpl_articles_product_and_promos', $_data,TRUE);
		
	}
	
	public function test(){
	
		$_data['ctr'] = "first";
		$_data['data'] = $this->model_articles->get_articles_by_catid(3);
		echo  $this->load->view('tpl_query', $_data,TRUE);
		
	}

	public function get_product_and_promos_second($latest_post_date){
		$_data['ctr'] = "second";
		$_data['data'] = $this->model_articles->get_article_second('4', $latest_post_date);
		echo $this->load->view('tpl_articles_news_second', $_data, TRUE);			

	}	

	public function get_article($post_id){
		
		$p_article = $this->getArticle($post_id);
		$_data['page'] = "article";
		
		foreach( $p_article as $key => $p_art ){
			$catid 	= $p_art['catid'];
			foreach( $p_art as $p_k => $post ){
				$_data[$p_k] = $post;
			}
		}
		
		$_data['random_art'] = $this->model_articles->get_random_articles($catid, $post_id);
		
		$this->load->view('tpl_article_full', $_data);
	}
	
	public function get_article_full_flip($post_id){
  
		$p_article = $this->getArticle($post_id);
		
		
		foreach( $p_article as $key => $p_art ){
			$catid = $p_art['catid'];
			foreach( $p_art as $p_k => $post ){
				$_data[$p_k] = $post;
			}
		}
		
		$_data['random_art'] = $this->model_articles->get_random_articles($catid, $post_id);
		
		$_data['page']    = "article";
		$this->load->view('tpl_article_full_flip', $_data);
	}
	
	public function industry_news(){
		
		$feed_url = "http://meltwaternews.com/magenta/xml/html/15/75/rss/v2_422641.rss.XML";
		$content = file_get_contents($feed_url);  
		$xml  = new SimpleXmlElement($content);
		$_data['data']   = $xml;
		$_data['page']   = "industry_news";
		echo $this->load->view('tpl_industry_news', $_data);					

	}
	
	public function icontribute_news(){
		$_data['ctr'] = "first";
		$_data['data'] = $this->model_articles->get_articles_by_catid(5);
		echo  $this->load->view('tpl_icontribute_news', $_data,TRUE);		

	}
	public function icontribute_news_second($latest_post_date){
		$_data['ctr'] = "second";
		$_data['data'] = $this->model_articles->get_article_second('5', $latest_post_date);
		echo  $this->load->view('tpl_articles_news_second', $_data,TRUE);		

	}
}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */