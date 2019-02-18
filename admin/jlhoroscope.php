<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component jlhoroscope
 * @author Joomline
 */
require_once JPATH_COMPONENT.'/helpers/jlhoroscope.php';
jimport('joomla.filesystem.folder');
if(!is_dir(JPATH_ROOT.'/images/com_jlhoroscope')){
    JFolder::create(JPATH_ROOT.'/images/com_jlhoroscope');
}
$controller = JControllerLegacy::getInstance( 'jlhoroscope' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();