<?php

defined( '_JEXEC' ) or die;

/**
 * Class JlhoroscopeHelper
 */
class JlhoroscopeHelper
{
	/**
	 * Добавление подменю
	 * @param String $vName
	 */
	static function addSubmenu( $vName )
	{
		JHtmlSidebar::addEntry(
			JText::_( 'HOROSCOPE_SUBMENU' ),
			'index.php?option=com_jlhoroscope&view=horoscopes',
			$vName == 'horoscopes' );
	}

	/**
	 * Получаем доступные действия для текущего пользователя
	 * @return JObject
	 */
	public static function getActions()
	{
		$user = JFactory::getUser();
		$result = new JObject;
		$assetName = 'com_jlhoroscope';
		$actions = JAccess::getActions( $assetName );
		foreach ( $actions as $action ) {
			$result->set( $action->name, $user->authorise( $action->name, $assetName ) );
		}
		return $result;
	}
}