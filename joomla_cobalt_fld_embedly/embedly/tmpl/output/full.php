<?php
/**
 * Embedly Field for Cobalt
 * Author Website: http://www.patrickmjones.com
 * @copyright Copyright (C) 2017 Patrick Jones <patrick@patrickmjones.com>. All rights reserved.
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 */
defined('_JEXEC') or die();

$URL = $this->value;
$theme = $this->params->get('params.theme');
$show_controls = $this->params->get('params.show_controls');
$card_align = $this->params->get('params.card_align');

?>

<a class="embedly-card" 
    data-card-theme="<?php echo $theme; ?>"
    data-card-controls="<?php echo $show_controls; ?>"
    data-card-align="<?php echo $card_align; ?>"
    href="<?php echo $URL; ?>">
        <?php echo $URL; ?>
</a>
<script async src="//cdn.embedly.com/widgets/platform.js" charset="UTF-8"></script>
