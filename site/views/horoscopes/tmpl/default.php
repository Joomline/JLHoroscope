<?php
/** @var $this JlhoroscopeViewHoroscopes */
defined( '_JEXEC' ) or die; // No direct access
JHtml::_('bootstrap.framework');
?>
<div class="item-page">
	<h1><?php echo JText::_('COM_JLHOROSCOPE_HOROSCOPES'); ?></h1>
	<div class="row-fluid">
		<?php foreach ( $this->items as $i => $item ): ?>
		<?php if($i> 0 && $i%3 == 0) : ?>
	</div>
	<div class="row-fluid">
		<?php endif; ?>
			<div class="span4 horoscopes-item">
				<img src="<?php echo JUri::root().$item->image; ?>" alt="<?php $item->title; ?>">
				<a href="<?php echo JlhoroscopeSiteHelper::getRoute($item->id, $item->alias); ?>"><h2><?php echo $item->title; ?></h2></a>
				<div class="horoscopes-dates"><?php echo $item->dates; ?></div>
				<div class="horoscopes-desc"><?php echo $item->introtext; ?></div>
			</div>

		<?php endforeach; ?>
	</div>

	<?php echo $this->pagination->getPagesLinks(); ?>
</div>