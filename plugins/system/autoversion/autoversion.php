<?php
/**
 * @copyright	Copyright (C) 2015 Electric Easel, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

class plgSystemAutoversion extends JPlugin
{
	/**
	 * onBeforeCompileHead event trigger.
	 */
	public function onBeforeCompileHead()
	{
		$app = JFactory::getApplication();

		if ($app->isAdmin())
		{
			return;
		}

		$this->autoVersionAssets();
	}

	/**
	 * Add versioning information to document
	 * scripts and styleSheets.
	 *
	 * @return void
	 */
	protected function autoVersionAssets()
	{
		$document = JFactory::getDocument();

		foreach (array('_scripts', '_styleSheets') as $property)
		{
			foreach ($document->$property as $src => $attributes)
			{
				if ($this->detectLocalAsset($src))
				{
					$newSrc = $this->autoVersionedAssetSrc($src);

					$document->$property = $this->arrayReplaceKey($document->$property, $src, $newSrc);
				}
			}
		}
	}

	/**
	 * @param string $src Asset path to check
	 *
	 * @return bool
	 */
	protected function detectLocalAsset($src)
	{
		return (strpos($src, '/') === 0 && strpos($src, '//') !== 0 && file_exists(JPATH_ROOT . $src));
	}

	/**
	 * Add versioning information to an asset path.
	 *
	 * @param string $src The path to modify.
	 *
	 * @return string
	 */
	protected function autoVersionedAssetSrc($src)
	{
		$info = pathinfo($src);
		$hash = filemtime(JPATH_ROOT . $src);

		return $info['dirname'] . '/' . $info['basename'] . '?v=' . $hash;
	}

	/**
	 * Replaces a key in an array with the newKey at
	 * the same place in the array.
	 *
	 * @param  array      $array The array to operate on.
	 * @param  int|string $key    The key to search for.
	 * @param  mixed      $newKey The name of the new key.
	 *
	 * @return mixed      Returns false of the key wasn't found, otherwise returns the modified array.
	 */
	protected function arrayReplaceKey($array, $key, $newKey)
	{
		$keys = array_keys($array);
		$values = array_values($array);
		$index = array_search($key, $keys);

		if ($index === false)
		{
			return false;
		}

		$keys[$index] = $newKey;

		return array_combine($keys, $values);
	}
}
