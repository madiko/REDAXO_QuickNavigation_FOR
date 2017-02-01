<?php
    $toolbar = isset($this->toolbar) && $this->toolbar ? true : false;
    $group = isset($this->group) && $this->group ? true : false;
?>

<?php if (!$toolbar && !$group): ?>
<div class="dropdown<?= (isset($this->block) ? ' btn-block' : '')?><?= ((isset($this->class) && $this->class != '') ? ' ' . $this->class : '') ?>">
<?php endif; ?>

    <?php if ($toolbar): ?>
    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"<?= ((isset($this->disabled) && $this->disabled) ? ' disabled' : '') ?>>
    <?php else: ?>
    <button class="btn btn-default<?= (isset($this->block) ? ' btn-block' : '')?> dropdown-toggle" type="button" data-toggle="dropdown"<?= ((isset($this->disabled) && $this->disabled) ? ' disabled' : '') ?>>
    <?php endif; ?>
        <?php if (isset($this->button_prefix) && $this->button_prefix != ''): ?>
        <?= $this->button_prefix ?>
        <?php endif; ?>
        <?php if (isset($this->button_label) && $this->button_label != ''): ?>
        <?= ' <b>' . $this->button_label . '</b>' ?>
        <?php endif; ?>
        <span class="caret"></span>
    <?php if ($toolbar): ?>
    </a>
    <?php else: ?>
    </button>
    <?php endif; ?>
    
	 <ul class="quicknavi list-group dropdown-menu<?= (isset($this->right) ? ' dropdown-menu-right' : '')?><?= (isset($this->block) ? ' btn-block' : '')?>" role="menu">   	
        <?php if (isset($this->header) && $this->header != ''): ?>
            <li class="dropdown-header"><?= $this->header ?></li>
           
        <?php endif; ?> <input id="qsearch" type="text" class="form-control input" placeholder="Filter" />
        <?php
        foreach ($this->items as $item) {
            echo '<li' . ((isset($item['active']) && $item['active']) ? ' class="active"' : '') . (isset($item['attributes']) ? ' ' . trim($item['attributes']) : '') . '>';
            echo(isset($item['href']) && $item['href'] != '') ? '<a href="' . $item['href'] . '"  title="'. $item['hreftitle'] .'"  >' . $item['title'] . '</a>' : $item['title'];
            echo ' </li>';
        }
        ?>
        <?php if (isset($this->footer) && $this->footer != ''): ?>
            <li class="divider"></li>
            <li><?= $this->footer ?></li>
        <?php endif; ?>
    </ul>

<?php if (!$toolbar && !$group): ?>
</div>
<?php endif;
