<?php
/**
 * Embedly Field for Cobalt
 * Author Website: http://www.patrickmjones.com
 * @copyright Copyright (C) 2017 Patrick Jones <patrick@patrickmjones.com>. All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */

defined('_JEXEC') or die();
require_once JPATH_ROOT. DIRECTORY_SEPARATOR .'components/com_cobalt/library/php/fields/cobaltfield.php';


class JFormFieldCEmbedly extends CFormField
{
    public function getInput()
	{
		return $this->_display_input();
	}
	public function onRenderFull($record, $type, $section)
	{
		return $this->_display_output('full', $record, $type, $section);
	}

	public function onRenderList($record, $type, $section)
	{
		return $this->_display_output('list', $record, $type, $section);
	}

}
