<?php

// No direct access
defined( '_JEXEC' ) or die;

/**
 * Model to see the current entries
 * @author Joomline
 */
class JlhoroscopeModelHoroscopes extends JModelList
{
	/**
	 * Method to auto-populate the model state.
	 * @param   string $ordering An optional ordering field.
	 * @param   string $direction An optional direction (asc|desc).
	 * @return  void
	 */
	protected function populateState( $ordering = null, $direction = null )
	{
		parent::populateState( $ordering, $direction );
		$input = JFactory::getApplication()->input;
		$params = JComponentHelper::getParams( 'com_jlhoroscope' );
		$this->setState( 'list.start', $input->get( 'start' ) );
		$this->setState( 'list.limit', $params->get( 'limit', 12 ) );
	}

	/**
	 * Method for receiving a request to view records
	 * @return JDatabaseQuery
	 */
	protected function getListQuery()
	{
		$query = $this->getDbo()->getQuery( true );
		$query->select( '*' )->from( '#__jlhoroscope_sign' )->where( 'published=1' )->order('ordering, id');
		return $query;
	}

	public function updateHoro(){
	    $db = $this->getDbo();
        $query = $db->getQuery( true );
        $query->select('*')->from('#__jlhoroscope_date');
        $DateUpdate = $db->setQuery($query)->loadObjectList('type');

        $horoTypes = array(
            'com' => 'http://img.ignio.com/r/export/utf/xml/daily/com.xml',
            'ero' => 'http://img.ignio.com/r/export/utf/xml/daily/ero.xml',
            'anti' => 'http://img.ignio.com/r/export/utf/xml/daily/anti.xml',
            'bus' => 'http://img.ignio.com/r/export/utf/xml/daily/bus.xml',
            'hea' => 'http://img.ignio.com/r/export/utf/xml/daily/hea.xml',
            'cook' => 'http://img.ignio.com/r/export/utf/xml/daily/cook.xml',
            'lov' => 'http://img.ignio.com/r/export/utf/xml/daily/lov.xml',
            'mob' => 'http://img.ignio.com/r/export/utf/xml/daily/mob.xml',
            'cur' => 'http://img.ignio.com/r/export/utf/xml/weekly/cur.xml',
//            'prev' => 'http://img.ignio.com/r/export/utf/xml/weekly/prev.xml',
        );

        $tz = new DateTimeZone(JFactory::getApplication()->get('offset'));
        $date = new JDate('now', $tz);
        $now = $date->format('Y-m-d', true, false);

        foreach ($horoTypes as $key => $url) {
//            echo '<pre>'; var_dump($DateUpdate[$key]->date_update, $now);echo '</pre>'; die;
            if(!isset($DateUpdate[$key]) || $DateUpdate[$key]->date_update != $now){
                if($this->updateHoroType($key, $url)){
                    $this->updateDates($key, $now);
                    echo 'Horoscope '.$key.' loaded'."\n";
                }
            }
            else{
                echo 'Horoscope '.$key.' does not need to be updated'."\n";
            }
        }
    }

    private function updateDates($horo_type, $now){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query
            ->delete('#__jlhoroscope_date')
            ->where('type = '.$db->quote($horo_type));
        $db->setQuery($query)->execute();
        $ob = new stdClass();
        $ob->date_update = $now;
        $ob->type = $horo_type;
        $db->insertObject('#__jlhoroscope_date', $ob);
    }

    private function updateHoroType($horo_type, $url)
    {
        list($data, $code) = $this->open_http($url);
        if($code != 200 || empty($data)){
            return false;
        }

        $data = new SimpleXMLElement($data);

        if(!($data instanceof SimpleXMLElement)){
            return false;

        }
        $data = json_encode($data);
        $data = json_decode($data, true);
        if(!is_array($data) || count($data) < 2){
            return false;
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete('#__jlhoroscope_horoscope')
            ->where('horo_type = '.$db->quote($horo_type))
        ;
        $db->setQuery($query)->execute();

        foreach($data as $sign => $v){
            if($sign == 'date'){

            }
            else
            {
                if(is_array($v) && count($v))
                {
                    foreach ($v as $type => $horo){
                        $ob = new stdClass();
                        $ob->title = $horo_type.' '.$type.' '.$sign;
                        $ob->alias = JApplicationHelper::stringURLSafe($ob->title);
                        $ob->fulltext = $horo;
                        $ob->sign = $sign;
                        $ob->type = $type;
                        $ob->horo_type = $horo_type;
                        $db->insertObject('#__jlhoroscope_horoscope', $ob);
                    }
                }

            }
        }

        return true;
    }

    private function open_http($url)
    {
        if (!function_exists('curl_init')) {
            die('ERROR: CURL library not found!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return array($result, $httpcode);
    }
}