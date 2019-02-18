<?php
/** @var $this JlhoroscopeViewHoroscope */
defined( '_JEXEC' ) or die; // No direct access
JHtml::_('bootstrap.framework');
$header = $this->item->title;
$header .= ', '.JString::strtolower(JText::_('COM_JLHOROSCOPE_'.strtoupper($this->item->horo_type)));
if($this->item->horo_type != 'cur')
	$header .= ' '.JString::strtolower(JText::_('COM_JLHOROSCOPE_'.strtoupper($this->item->type)));
?>
<div class="item-page">
	<div class="row-fluid horoscope-horotype">
		<?php foreach ($this->item->horo_types as $horo_type) : ?>
			<div class="span2">
				<?php if($horo_type['selected']) : ?>
					<p href="<?php echo $horo_type['link'] ?>"><?php echo $horo_type['title'] ?></p>
				<?php else : ?>
					<a href="<?php echo $horo_type['link'] ?>"><?php echo $horo_type['title'] ?></a>
				<?php endif ?>
			</div>
		<?php endforeach; ?>
	</div>
	<?php if($this->item->horo_type != 'cur') : ?>
		<div class="row-fluid horoscope-type">
			<?php foreach ($this->item->types as $type) : ?>
				<div class="span3">
					<?php if($type['selected']) : ?>
						<p><?php echo $type['title'] ?></p>
					<?php else : ?>
						<a href="<?php echo $type['link'] ?>"><?php echo $type['title'] ?></a>
					<?php endif ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<div class="row-fluid">
		<h1><?php echo $header; ?></h1>
		<div class="horoscope-dates">
			<?php echo $this->item->dates; ?>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span3 horoscope-image">
			<div class="row-fluid">
				<img src="<?php echo JUri::root().$this->item->image; ?>" alt="<?php echo $this->item->title; ?>">
			</div>
			<div class="clearfix"><br></div>
			<div class="row-fluid">
				<?php foreach ($this->item->signs as $i => $sign) : ?>
				<?php if($i> 0 && $i%3 == 0) : ?>
			</div>
			<div class="row-fluid">
				<?php endif; ?>
				<div class="span4 horoscopes-item">
					<a href="<?php echo JlhoroscopeSiteHelper::getRoute($sign->id, $sign->alias ); ?>">
						<img src="<?php echo JUri::root().$sign->tumbinail; ?>" title="<?php echo $sign->title; ?>" alt="<?php echo $sign->title; ?>">
					</a>
				</div>
				<?php endforeach; ?>
			</div>

		</div>
		<div class="span9 horoscope-desc">

			<div class="horoscope-text">
				<?php echo $this->item->horoscope->fulltext; ?>
			</div>
		</div>
	</div>
</div>