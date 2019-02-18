<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Model to see the current entries
 * @author Joomline
 */
class JlhoroscopeModelHoroscope extends JModelItem
{
	/**
	 * Method to auto-populate the model state.
	 * @return  void
	 */
	protected function populateState()
	{
		$input = JFactory::getApplication()->input;
		$params = JComponentHelper::getParams( 'com_jlhoroscope' );
		list( $id, $alias ) = explode( ':', $input->getString( 'id', '' ) );

		$this->setState( 'type', $input->getString( 'type', 'today' ) );
		$this->setState( 'horo_type', $input->getString( 'horo_type', 'com' ) );
		$this->setState( 'item.id', $id );
		$this->setState( 'item.alias', str_replace( ':', '-', $alias ) );
		parent::populateState();
	}


	/**
	 * Return a record
	 * @return object
	 * @throws Exception
	 */
	public function getItem()
	{
		$query = $this->getDbo()->getQuery( true )
			->select( '*' )
			->from( '#__jlhoroscope_sign' )
			->where( 'published=1' )
			->where( 'id=' .  $this->getDbo()->q( $this->getState( 'item.id', 0 ) ) )
			->where( 'alias=' . $this->getDbo()->q( $this->getState( 'item.alias', '' ) ) )
			;
		$item = $this->getDbo()->setQuery( $query )->loadObject();
		if ( empty( $item->id ) ) {
			throw new Exception( 'No entry found', 404 );
		}

        $item->horoscope = $this->getHoroscope($item->code);
        $item->signs = $this->getSigns();
        $item->horo_types = $this->getHoroTypes($item);
        $item->horo_type = $this->getState( 'horo_type', 'com' );
        $item->types = $this->getTypes($item);
        $item->type = $this->getState( 'type', 'today' );
		return $item;
	}

	private function getHoroTypes($item){
        $horoTypes = array(
            'com',
            'ero',
            'anti',
            'bus',
            'hea',
            'cook',
            'lov',
            'mob',
            'cur',
        );
        $return = array();
        $horo_type = $this->getState( 'horo_type', 'com' );
        $type = $this->getState( 'type', 'today' );
        foreach ($horoTypes as $horoType){
            $selected = $horoType == $horo_type ? 1 : 0;

            $return[] = array(
                    'selected' => $selected,
                    'title' => JText::_('COM_JLHOROSCOPE_'.strtoupper($horoType)),
                    'key' => $horoType,
                    'link' => JlhoroscopeSiteHelper::getRoute($item->id, $item->alias, $horoType, $type)
            );
        }

        return $return;
    }

	private function getTypes($item){
        $aTypes = array(
            'yesterday',
            'today',
            'tomorrow',
            'tomorrow02'

        );
        $return = array();
        $horo_type = $this->getState( 'horo_type', 'com' );
        $type = $this->getState( 'type', 'today' );
        foreach ($aTypes as $sType){
            $selected = $sType == $type ? 1 : 0;
            $return[] = array(
                    'selected' => $selected,
                    'title' => JText::_('COM_JLHOROSCOPE_'.strtoupper($sType)),
                    'key' => $sType,
                    'link' => JlhoroscopeSiteHelper::getRoute($item->id, $item->alias, $horo_type, $sType)
            );

        }

        return $return;
    }

	private function getHoroscope($code)
	{
        $horo_type = $this->getState( 'horo_type', 'com' );
		$query = $this->getDbo()->getQuery( true )
			->select( '*' )
			->from( '#__jlhoroscope_horoscope' )
			->where( 'sign=' .  $this->getDbo()->q( $code ) )
			->where( 'horo_type=' .  $this->getDbo()->q( $horo_type ) )
        ;
        if($horo_type != 'cur'){
            $query->where( 'type=' .  $this->getDbo()->q( $this->getState( 'type', 'today' ) ) );
        }

		$item = $this->getDbo()->setQuery( $query )->loadObject();
		if ( empty( $item->id ) ) {
			throw new Exception( 'No entry found', 404 );
		}
		return $item;
	}

	private function getSigns()
	{
		$query = $this->getDbo()->getQuery( true )
			->select( 'id, tumbinail, title, alias' )
			->from( '#__jlhoroscope_sign' )
            ->order('ordering, id')
        ;
		$items = $this->getDbo()->setQuery( $query )->loadObjectList();

		return $items;
	}
}