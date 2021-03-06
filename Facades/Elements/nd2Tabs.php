<?php
namespace exface\NativeDroid2Facade\Facades\Elements;

use exface\Core\Widgets\Tabs;

/**
 * 
 * @method Tabs getWidget()
 * 
 * @author Andrej Kabachnik
 *
 */
class nd2Tabs extends nd2Container
{
    public function buildHtml(){        
        return $this->buildHtmlTabHeaders() . $this->buildHtmlTabBodies();
    }
    
    public function buildHtmlTabBodies()
    {
        $bodies = '';
        foreach ($this->getWidget()->getChildren() as $tab) {
            $bodies .= $this->getFacade()->getElement($tab)->buildHtmlBody();
        }
        return <<<HTML

        <div id="{$this->getId()}_tabs">
            {$bodies}
        </div>
        
HTML;
    }
    
    public function buildHtmlTabHeaders()
    {
        $headers = '';
        foreach ($this->getWidget()->getChildren() as $tab) {
            $headers .= $this->getFacade()->getElement($tab)->buildHtmlHeader();
        }
        return <<<HTML
        
        <ul id="{$this->getId()}" data-role="nd2tabs">
            {$headers}
        </ul>
        
HTML;
    }
}
?>