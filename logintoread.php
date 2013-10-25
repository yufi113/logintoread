<?php

/**
* @package	Content - Login to Read
* @copyright	Copyright (C) 2011 by NhuangStudio
* @license	This extension in released under the GNU/GPL License - http://www.gnu.org/copyleft/gpl.html
*/

// No direct access
defined('_JEXEC') or die;

// Import library dependencies

class plgContentlogintoread extends JPlugin
{

	function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		
		if($this->isbot('Googlebot,yahoo,baiduspider,msnbot,Slurp,WebCrawler,ZyBorg,scooter,StackRambler,Aport,lycos,WebAlta,ia_archiver,FAST')) return;
		if($context =='com_content.article'||$context == 'com_k2.item'){
			
		if($context =='com_content.article'){
		if ($this->params->get('articleon',0)==0) return;
		 $catid = $this->params->get('catid',array());
		 if(isset($catid[0])&&$catid[0]!=''){
		  if(!in_array($article->catid,$catid)){
			  return;
			  
		  }
		 }
		}
		$type = $this->params->get('type',0);
		if($context =='com_k2.item'){
		if ($this->params->get('k2on',0)==0) return;
		 $catid = $this->params->get('category_id',array());
		 if(isset($catid[0])&&$catid[0]!=''){
		  if(!in_array($article->catid,$catid)){
			  return;
			  
		  }
		 }
		}
		$user	= JFactory::getUser();
		$doc    = JFactory::getDocument();
		$uri = clone JFactory::getURI();
		$app	= JFactory::getApplication();
		$router = $app->getRouter();
		$vars = $router->parse($uri);
	
	
	
		$url = 'index.php?'.JURI::buildQuery($vars);
		if ($type ==0){
        $doc -> addScript(JURI::root()."plugins/content/logintoread/js/jquery-1.9.1.js");
		$doc -> addScript(JURI::root()."plugins/content/logintoread/js/jquery-ui-1.10.2.custom.min.js");
		$doc -> addStyleSheet(JURI::root()."plugins/content/logintoread/css/logintoread.css");
		$doc -> addScript(JURI::root()."plugins/content/logintoread/js/logintoread.js");
		}
		  
		
		if ($user->id==0){
			if ($type ==1) $app->redirect(JRoute::_('index.php?option=com_users&view=login',false));
			if ($type ==2) $logintext ='<a href="'.JRoute::_('index.php?option=com_users&view=login',false).'">'.JText::_('Login to read').'</a>';
			else
		
		  $logintext='<div id="dialog" style="display:none"><form action="'.JRoute::_('index.php').'" method="post" id="login-form" ><fieldset class="userdata">
	<p id="form-login-username">
		<label for="modlgn-username">'.JText::_('JGLOBAL_USERNAME').'</label>
		<input id="modlgn-username" type="text" name="username" class="inputbox"  size="18" />
	</p>
	<p id="form-login-password">
		<label for="modlgn-passwd">'.JText::_('JGLOBAL_PASSWORD').'</label>
		<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="18"  />
	</p>
	<input type="submit" name="Submit" class="button" value="'.JText::_('JLOGIN').'" />
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="'.base64_encode($url).'" />'.JHtml::_('form.token').'
	</fieldset>
</div>';
		
			if($article->fulltext) $article->text =$article->introtext.$logintext; else $article->text = $logintext;

		}
		}else return;
	}
	
	function isbot($search_bots){ // Check search engine bot
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$search_bots = explode(',', $search_bots);
	foreach($search_bots as $bot){
		if (strpos($useragent, $bot) !== false){
			return true;
		}
	return false;
	}
} // isbot


	

} // class


?>
