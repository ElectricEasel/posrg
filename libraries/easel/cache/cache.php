<?php defined('EE_PATH') or die;

class EECache extends JCache
{
	public static function call()
	{
		$cache = self::getInstance('callback');
		$cache->setCaching(1);
		$cache->_options['storage'] = 'file';

		$args = func_get_args();
		$callback = array_shift($args);

		try
		{
			$data = $cache->call($callback, $args);
		}
		catch (Exception $e)
		{
			$code = $e->getCode();
			JError::raiseError($code ? $code : 500, $e->getMessage());
		}
		
		return $data;
	}
}
