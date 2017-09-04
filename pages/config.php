<?php
// Variablen initialisieren
$content = $buttons = '';
$formElements = [];
$n = [];





// User-ID ermitteln
$user =  rex::getUser()->getId();
#dump($this->getConfig('quicknavi_favs'.$user));
// Einstellungen speichern
if (rex_post('formsubmit', 'string') == '1') {
    $this->setConfig(rex_post('config', [
        ['quicknavi_favs'.$user, 'array[int]'],
    ]));
    echo rex_view::success($this->i18n('quicknavi_config_saved'));
}
$content .= '<fieldset><legend>' . $this->i18n('quicknavi_info') . '</legend>';

// Kategorieauswahl 

$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');
// Kategorienauswahl
$formElements = [];
$n = [];
$n['label'] = '<label for="quicknavi-config-favs">' . $this->i18n('quicknavi_categories') . '</label>';
$category_select = new rex_category_select(false, false, false, true);
$category_select->setName('config[quicknavi_favs'.$user.'][]');
$category_select->setId('quicknavi-config-favs');
$category_select->setSize('10');
$category_select->setMultiple(true);
$category_select->setAttribute('class', 'selectpicker show-menu-arrow form-control');
$category_select->setAttribute('data-actions-box', 'false');
$category_select->setAttribute('data-live-search', 'true');
$category_select->setAttribute('data-size', '15');
$category_select->setSelected($this->getConfig('quicknavi_favs'.$user));
$n['field'] = $category_select->get();
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$content .= $fragment->parse('core/form/container.php');	
// Save-Button
$formElements = [];
$n = [];
$n['field'] = '<button class="btn btn-save rex-form-aligned" type="submit" name="save" value="' . $this->i18n('quicknavi_config_save') . '">' . $this->i18n('config_save') . '</button>';
$formElements[] = $n;
$fragment = new rex_fragment();
$fragment->setVar('elements', $formElements, false);
$buttons = $fragment->parse('core/form/submit.php');
$buttons = '
<fieldset class="rex-form-action">
    ' . $buttons . '
</fieldset>
';
// Ausgabe Formular
$fragment = new rex_fragment();
$fragment->setVar('class', 'edit');
$fragment->setVar('title', $this->i18n('quicknavi_general'));
$fragment->setVar('body', $content, false);
$fragment->setVar('buttons', $buttons, false);
$output = $fragment->parse('core/page/section.php');
$output = '
<form action="' . rex_url::currentBackendPage() . '" method="post">
<input type="hidden" name="formsubmit" value="1" />
    ' . $output . '
</form>
';
echo $output;