<?php defined('_JEXEC') or die;

class ProductController extends JController
{
	protected $app;

	public function __construct($config = array())
	{
		$config['model_path'] = JPATH_COMPONENT . '/model';
		parent::__construct($config);

		$this->app = JFactory::getApplication();
		$this->registerTask( 'unblock', 'block' );
	}

	public function display()
	{
		$view = $this->app->input->get('view');
		$task = $this->app->input->get('task');

		if (!$task && !$view)
		{
			JRequest::setVar('view', 'list');
			$this->app->input->set('view', 'list');
		}

		$checkTask = array(
			'block',
			'save',
			'saveorder',
			'delete'
		);

		if (in_array($task, $checkTask) || $view === 'block')
		{
			$this->checkTK();
			$this->checkLogin();
		}

		parent::display();
	}

	public function block( )
	{
		// Check for request forgeries
		$model = new ProductModel;
		$arr   = array();
		$arr['id']    = $this->app->input->getInt('id');
		$arr['published']   = $this->getTask() == 'block' ? 0 : 1;
		$tables    = $model->saveData($arr, array(), 'product');

		if ($tables->getError())
		{
			$msg = JText::_( 'Error: One or More Record Could not be ' . $this->getTask() );
		}
		else
		{
			$msg = JText::_( 'Record(s) ' . $this->getTask() );
		}

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'), $msg);
	}

	public function save()
	{
		$post  = JRequest::get('post');
		$model = new ProductModel;
		$id    = $this->app->input->getInt('id');
		$max_order=$model->setTable('#__product')->select()->getListData();
		$order  = count($max_order) + 1;//intval($rs->maxs) + 1;
		$post['ordering']  = $order;

		if (intval($post['id']))
		{
			$post['ordering']  = null;
		}

		$table = $model->saveData($post, array(), 'product');

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'));
	}

	public function delete()
	{
		$id = $this->app->input->getInt('id');
		$model = new ProductModel;
		$model->setTable('#__product')
			->where('id = ' . $id)
			->delete();

		$this->setRedirect(JRoute::_('index.php?option=com_product&view=manager'), JText::_('GM_PRODUCT_DELETE_ITEM'));
	}

	public function upload()
	{
		$this->checkLogin();

		$my			= JFactory::getUser();
		$json		= '{file: "%file", filethumb: "%thumb", message: "%msg", type: "%type"}';
		$file		= JRequest::getVar('file_upload', null, 'files', 'array');
		$filename	= date('Y-m-d H-i-s') . " " . JFile::makeSafe($file['name']);
		$src		= $file['tmp_name'];
		$path		= JPATH_COMPONENT . DS . 'assets' . DS . 'upload';
		$return		= date('Y') . DS . date('m') . DS . $filename;
		$dest		= $path . DS .  $return;
		$ext		= array('jpg', 'png', 'gif');
		$type		= "success";
		$msg		= "";

		if (in_array(strtolower(JFile::getExt($filename)), $ext) )
		{
			if (JFile::upload($src, $dest))
			{
				$msg = JText::_('GM_UPLOAD_SUCCESS');
			}
			else
			{
				$type = 'error';
				$msg = 'GM_NOT_UPLOAD';
			}
		}
		else
		{
			$type = 'error';
			$msg = JText::_('GM_APPLY_FILE') . ' ' . implode(',', $ext);
		}

		$return	= @str_replace(DS, "/", $return);
		$json	= str_replace('%msg', $msg, $json);
		$json	= str_replace('%type', $type, $json);
		$json	= str_replace('%file', $return, $json);
		$json	= str_replace('%thumb', $this->getThumb("components/com_product/assets/upload/" . $return, 50, 50 ), $json);

		$this->app->close($json);
	}

	public function getThumb($image_path, $h, $w = 0)
	{
		$file_div = strrpos($image_path, '.');
		$thumb_ext = substr($image_path, $file_div);
		$thumb_prev = substr($image_path, 0, $file_div);
		$thumb_path =  $thumb_prev . "_sectcont_thumb" . $thumb_ext;

		@unlink($thumb_path);

		$thumb = new Varien_Image_Adapter_Gd2();
		$thumb->keepAspectRatio(true);
		$thumb->keepFrame(false);

		$thumb->open($image_path)->resize($w, $h)->save($thumb_path)->__destruct();

		return JUri::base() . $thumb_path;
	}

	public function saveorder()
	{
		$cid = JRequest::getVar('cid', array(), 'get', 'array');
		JArrayHelper::toInteger($cid);

		$order = JRequest::getVar( 'order', array(), 'get', 'array' );
		JArrayHelper::toInteger($order);

		$model = new ProductModel();
		if ($model->setOrder($cid, $order, 'product'))
		{
			$msg = JText::_( 'New ordering saved' );
		}
		else
		{
			$msg = $model->getError();
		}

		$this->setRedirect( 'index.php?option=com_product&view=manager', $msg );
	}

	protected function checkTK()
	{
		JSession::checkToken() or die('Invalid Token');
	}

	protected function checkLogin()
	{
		$user = JFactory::getUser();

		if (strtolower($user->get('username')) !== 'admin')
		{
			$this->setRedirect('index.php?option=com_users&view=login');
			$this->redirect();
		}
	}

}
