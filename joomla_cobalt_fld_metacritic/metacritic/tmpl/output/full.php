<?php
/**
 * Embedly Field for Cobalt
 * Author Website: http://www.patrickmjones.com
 * @copyright Copyright (C) 2017 Patrick Jones <patrick@patrickmjones.com>. All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die();

$url = $this->values['url'];
$score = $this->values['score'];
$level = $this->values['level'];

?>
<a class="metacritic-score-widget score-<?php echo $level ?>" href="<?php echo $url; ?>" target="_blank">
    <span class="metacritic-score-title">Metascore</span>			
    <span class="metacritic-score-value"><?php echo $score; ?></span>
    <span class="metacritic-score-value-total">out of 100</span>		
</a>
