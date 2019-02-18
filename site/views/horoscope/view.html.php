<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * View for  current element
 * @author Joomline
 */
class JlhoroscopeViewHoroscope extends JViewLegacy
{
	/**
	 * @var $item stdClass
	 */
	public $item;
	/**
	 * @var object model state
	 */
	public $state;

	/**
	 * Execute and display a template script.
	 * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
	 * @return  mixed  A string if successful, otherwise a Error object.
	 */
	public function display( $tpl = null )
	{
        $pathway    = JFactory::getApplication()->getPathway();

		$this->item = $this->get( 'Item' );
		$this->state = $this->get( 'State' );

        $header = $this->item->title;
        $header .= ', '.JString::strtolower(JText::_('COM_JLHOROSCOPE_'.strtoupper($this->item->horo_type)));
        if($this->item->horo_type != 'cur')
            $header .= ' '.JString::strtolower(JText::_('COM_JLHOROSCOPE_'.strtoupper($this->item->type)));

        $pathway->addItem($header, JlhoroscopeSiteHelper::getRoute($this->item->id, $this->item->alias, $this->item->horo_type, $this->item->type ));
		jlhoroscopeSiteHelper::setDocument( $this->item->title,  $this->item->metadesc, $this->item->metakey );
		parent::display( $tpl );
	}

}