<?php
/**
 * Metacritic Field for Cobalt
 * Author Website: http://www.patrickmjones.com
 * @copyright Copyright (C) 2017 Patrick Jones <patrick@patrickmjones.com>. All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();
$COBALT_PATH = JPATH_ROOT. DIRECTORY_SEPARATOR .'components'. DIRECTORY_SEPARATOR .'com_cobalt' .DIRECTORY_SEPARATOR;
$PLUGIN_PATH = $COBALT_PATH .'fields' .DIRECTORY_SEPARATOR .'metacritic' .DIRECTORY_SEPARATOR;
require_once $COBALT_PATH .'library' .DIRECTORY_SEPARATOR .'php'.DIRECTORY_SEPARATOR.'fields'.DIRECTORY_SEPARATOR.'cobaltfield.php';
require_once $PLUGIN_PATH .'helpers' .DIRECTORY_SEPARATOR .'api.php';

class JFormFieldCMetacritic extends CFormField
{
    public function getInput()
	{
		return $this->_display_input();
	}
	public function onRenderFull($record, $type, $section)
	{
        if(empty($this->value)) {
            return; // eject - field is empty
        }

        $url = parse_url($this->value)['path'];
        if(!empty($url)) {
            $this->values = array();
            $this->values['url'] = $this->value;
			
			// Let's check the cache first
            $cache = JFactory::getCache('MetacriticCache', '');
            $cache->setCaching(true);
            $cache->setLifeTime(1800); // seconds: 30 mins
            $cache_id = 'MetaCriticCache'.md5($this->value);
            
            $cached_score = $cache->get($cache_id);
            if(!empty($cached_score)) {
                $this->values['score'] = $cached_score;
            }else{
                $api = new MetacriticAPI($url);
                $score = $api->extractScore();
                $this->values['score'] = $score;
                $cache->store($score, $cache_id);
            }
        }        
		$score = $this->values['score'];
		$this->values['level'] = ($score >= 75 ? "good" : ($score >= 40 ? "mixed" : "bad"));
		JFactory::getDocument()->addStyleSheet('components/com_cobalt/fields/metacritic/css/metacritic.css');
		return $this->_display_output('full', $record, $type, $section);
	}

	public function onRenderList($record, $type, $section)
	{
		return $this->_display_output('list', $record, $type, $section);
	}

}
