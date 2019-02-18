<?php
defined( '_JEXEC' ) or die; // No direct access
/**
 * Component jlhoroscope
 * @author Joomline
 */
require_once JPATH_COMPONENT.'/helpers/jlhoroscope.php';
$controller = JControllerLegacy::getInstance( 'jlhoroscope' );
$controller->execute( JFactory::getApplication()->input->get( 'task' ) );
$controller->redirect();