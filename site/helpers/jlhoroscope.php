<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Component helper
 * @author Joomline
 */
class JlhoroscopeSiteHelper
{
	/**
	* @var array $menuIds  List Id depending of view component
	*/
	static $menuIds = array();
	
	/**
	* Create sef links
	* @param $option string
	* @param $view string
	* @param $query string
	* @return string link
	* @throws Exception
	*/
	static function getRoute( $id, $alias, $horo_type='com', $type='today' )
	{
		if ( empty( self::$menuIds['com_jlhoroscope' . '.' . 'horoscope'] ) )
		{
			$items = JMenuSite::getInstance( 'site' )->getItems( 'component', 'com_jlhoroscope' );

			foreach ( $items as $item )
			{
				if ( isset( $item->query['view'] ) )
				{
					self::$menuIds['com_jlhoroscope' . '.' . 'horoscope'] = $item->id;
				}
			}
		}

        $link = 'index.php?option=com_jlhoroscope&view=horoscope&id='.$id.':'.$alias.'&horo_type=' . $horo_type . '&type='.$type . '&Itemid=' . self::$menuIds['com_jlhoroscope.horoscope'];

        return JRoute::_( $link );
	}

	/**
	 * set meta tags
	 * @param string $title
	 * @param string $metaDesc
	 * @param string $metaKey
	 * @throws Exception
	 */
	static function setDocument( $title = '', $metaDesc = '', $metaKey = '' )
	{
		$baseUrl = JUri::base();
		$doc = JFactory::getDocument();
		$app = JFactory::getApplication();
		if ( empty( $title ) ) {
			$title = $app->get( 'sitename' );
		}
		elseif ( $app->get( 'sitename_pagetitles', 0 ) == 1 ) {
			$title = JText::sprintf( 'JPAGETITLE', $app->get( 'sitename' ), $title );
		}
		elseif ( $app->get( 'sitename_pagetitles', 0 ) == 2 ) {
			$title = JText::sprintf( 'JPAGETITLE', $title, $app->get( 'sitename' ) );
		}
		$doc->setTitle( $title );
		if ( trim( $metaDesc ) ) {
			$doc->setDescription( $metaDesc );
		}
		if ( trim( $metaKey ) ) {
			$doc->setMetaData( 'keywords', $metaKey );
		}
	}
}