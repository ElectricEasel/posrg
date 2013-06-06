<?php defined( '_JEXEC' ) or die;

class oFBLikeBox
{
	public static function getData(&$params )
	{
		$oFlink	= $params->get('olink', 'http://www.facebook.com/pages/Optimized-Sense/230549220294427?ref=ts');
		$oFwidth	= $params->get('owidth', '300');
		$oFheight	= $params->get('oheight', '500');
		$oFborder	= $params->get('oborder', '000000');
		$oFcolor	= $params->get('ocolor');
		$oFfaces	= $params->get('ofaces');		
		$oFstream	= $params->get('ostream');
		$oFforce	= $params->get('oforce');
		$oFheader	= $params->get('oheader');
		$oFsource	= $params->get('osource');
		
		if($oFcolor == '1'){
			$oFcolor	= 'light';
		}else{
			$oFcolor	= 'dark';
		}
		
		if($oFfaces == '1'){
			$oFfaces	= 'true';
		}else{
			$oFfaces	= 'false';
		}
			
		if($oFstream == '1'){
			$oFstream	= 'true';
		}else{
			$oFstream	= 'false';
		}
		
		if($oFforce == '1'){
			$oFforce	= 'true';
		}else{
			$oFforce	= 'false';
		}
		
		if($oFheader == '1'){
			$oFheader	= 'true';
		}else{
			$oFheader	= 'false';
		}

		$data ='';
		
		if($oFsource == '1'){
			//HTML5			
			$data = '<div id="fb-root"></div><script language="javascript" type="text/javascript">(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) {return;}  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";  fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script>';
			$data = $data.'<script language="javascript" type="text/javascript">//<![CDATA[ 
																						   document.write(\'<div class="fb-like-box" data-href="'.$oFlink.'" data-width="'.$oFwidth.'" data-height="'.$oFheight.'" data-colorscheme="'.$oFcolor.'" data-show-faces="'.$oFfaces.'" data-border-color="'.$oFborder.'" data-stream="'.$oFstream.'" data-force-wall="'.$oFforce.'" data-header="'.$oFheader.'"></div> \'); 
																						   //]]>
			</script> ';
		}else if($oFsource == '2'){
			//XFBML
			$data = '<div id="fb-root"></div><script language="javascript" type="text/javascript">(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) {return;}  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";  fjs.parentNode.insertBefore(js, fjs);}(document, \'script\', \'facebook-jssdk\'));</script>';
			$data = $data.'<script language="javascript" type="text/javascript">//<![CDATA[ 
																						   document.write(\'<fb:like-box href="'.$oFlink.'" width="'.$oFwidth.'" height="'.$oFheight.'" colorscheme="'.$oFcolor.'" show_faces="'.$oFfaces.'" border_color="'.$oFborder.'" stream="'.$oFstream.'" force_wall="'.$oFforce.'" header="'.$oFheader.'"></fb:like-box> \'); 
																						   //]]>
			</script> ';
		}else {
			//iFrame
			$oFsource	="http://www.facebook.com/plugins/likebox.php?href=".$oFlink."&amp;width=".$oFwidth .
					"&amp;colorscheme=".$oFcolor."&amp;show_faces=".$oFfaces .
					"&amp;border_color=%23".$oFborder."&amp;stream=".$oFstream."&amp;force_wall=".$oFforce."&amp;header=".$oFheader."&amp;height=".$oFheight;

			$data = '<iframe src="'.$oFsource.'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:'.$oFwidth.'px; height:'.$oFheight.'px;"></iframe>';
		}

		return $data;
	}
}
