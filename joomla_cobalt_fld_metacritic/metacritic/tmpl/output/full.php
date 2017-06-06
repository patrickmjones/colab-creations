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

?>
<a class="metacritic-score-widget" href="<?php echo $url; ?>" style="display:block;text-align:center;background:#66CC33;color:#FFF;width:87px;height:87px;font-family:arial, verdana, sans-serif;text-decoration:none;" target="_blank">
    <span class="metacritic-score-title" style="display:block;font-size:11px;line-height:13px;padding-top:4px;">Metascore</span>			
    <span class="metacritic-score-value" style="display:block;font-size:51px;line-height:53px;padding:0;font-weight:bold;"><?php echo $score; ?></span>
    <span class="metacritic-score-value-total" style="display:block;font-size:11px;line-height:13px;">out of 100</span>		
</a>
