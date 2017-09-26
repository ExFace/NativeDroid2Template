<?php
namespace exface\JQueryMobileTemplate\Template\Elements;

class nd2CheckBox extends nd2AbstractElement
{

    protected function init()
    {
        parent::init();
        $this->setElementType('checkbox');
    }

    function generateHtml()
    {
        $output = '	<div class="fitem exf_input" title="' . $this->buildHintText() . '">
						<label>' . $this->getWidget()->getCaption() . '</label>
						<input type="checkbox" value="1" 
								form="" 
								id="' . $this->getWidget()->getId() . '_checkbox"
								onchange="$(\'#' . $this->getWidget()->getId() . '\').val(this.checked);"' . '
								' . ($this->getWidget()->getValue() ? 'checked="checked" ' : '') . '
								' . ($this->getWidget()->isDisabled() ? 'disabled="disabled"' : '') . ' />
						<input type="hidden" name="' . $this->getWidget()->getAttributeAlias() . '" id="' . $this->getWidget()->getId() . '" value="' . $this->getWidget()->getValue() . '" />
					</div>';
        return $output;
    }

    function generateJs($jqm_page_id = null)
    {
        return '';
    }

    function buildJsInitOptions()
    {
        $options = 'on: "&#10004;"' . ', off: ""';
        return $options;
    }
}
?>