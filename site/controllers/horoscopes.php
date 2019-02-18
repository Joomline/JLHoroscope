<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 * Controller
 * @author Joomline
 */
class JlhoroscopeControllerHoroscopes extends JControllerLegacy
{
    public function update_horo(){
        $this->getModel('Horoscopes', 'JlhoroscopeModel')->updateHoro();

        die;
    }
}