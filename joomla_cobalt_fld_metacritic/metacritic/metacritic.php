<?php
/**
 * Metacritic Field for Cobalt
 * Author Website: http://www.patrickmjones.com
 * @copyright Copyright (C) 2017 Patrick Jones <patrick@patrickmjones.com>. All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();
require_once JPATH_ROOT. DIRECTORY_SEPARATOR .'components'.DIRECTORY_SEPARATOR.'com_cobalt'.DIRECTORY_SEPARATOR.'library'.DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR.'cobaltfield.php';
require_once JPATH_ROOT. DIRECTORY_SEPARATOR .'components'. DIRECTORY_SEPARATOR .'com_cobalt' .DIRECTORY_SEPARATOR .'fields' .DIRECTORY_SEPARATOR .'metacritic' .DIRECTORY_SEPARATOR .'helpers' .DIRECTORY_SEPARATOR .'api.php';


class JFormFieldCMetacritic extends CFormField
{
    public function getInput()
	{
		return $this->_display_input();
	}
	public function onRenderFull($record, $type, $section)
	{
        if(!empty($this->value)) {
            $url = parse_url($this->value)['path'];
            if(!empty($url)) {
                $api = new MetacriticAPI($url);
                $this->values = array();
                $this->values['url'] = $this->value;
                $this->values['score'] = $api->extractScore();
            }
        }
		return $this->_display_output('full', $record, $type, $section);
	}

	public function onRenderList($record, $type, $section)
	{
		return $this->_display_output('list', $record, $type, $section);
	}

}
