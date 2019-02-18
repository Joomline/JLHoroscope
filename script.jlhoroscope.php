<?php
defined('_JEXEC') or die();
jimport('joomla.filesystem.folder');
jimport('joomla.filesystem.file');

class com_jlhoroscopeInstallerScript
{
	public function postflight($type, $parent)
	{
		$from      = JPATH_ROOT . '/administrator/components/com_jlhoroscope/images';
		$to       = JPATH_ROOT . '/images/com_jlhoroscope';

		if(!JFolder::exists($to)){
			if(!JFolder::create($to)){
				echo 'Error create folder ' . $to.'<br>';
				return false;
			}
			else{
				echo 'Create folder ' . $to.'<br>';
			}
		}
		$files = JFolder::files($from);
		$errors = 0;
		if(is_array($files) && count($files)){
			foreach ($files as $fileNme){
				$fromFile = $from.'/'.$fileNme;
				$toFile = $to.'/'.$fileNme;
				if(!JFile::copy($fromFile, $toFile)){
					echo 'Error copy file ' . $fromFile . ' to '. $toFile.'<br>';
					$errors++;
				}
				else{
					echo 'Copy file ' . $fromFile . ' to '. $toFile.' success<br>';
				}
			}
		}

		if($errors){
			return false;
		}
		return true;
	}
}