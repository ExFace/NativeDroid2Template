<?php
namespace exface\NativeDroid2Template\Templates;

use exface\Core\Templates\AbstractAjaxTemplate\AbstractAjaxTemplate;
use exface\Core\Interfaces\Actions\ActionInterface;
use exface\Core\Templates\AbstractAjaxTemplate\Middleware\JqueryDataTablesUrlParamsReader;

class NativeDroid2Template extends AbstractAjaxTemplate
{

    protected $request_columns = array();

    public function init()
    {
        parent::init();
        $this->setClassPrefix('nd2');
        $this->setClassNamespace(__NAMESPACE__);
    }

    /**
     * To generate the JavaScript, jQueryMobile needs to know the page id in addition to the regular parameters for this method
     *
     * @see AbstractAjaxTemplate::buildJs()
     */
    public function buildJs(\exface\Core\Widgets\AbstractWidget $widget, $jqm_page_id = null)
    {
        $instance = $this->getElement($widget);
        return $instance->buildJs($jqm_page_id);
    }

    /**
     * In jQuery mobile we need to do some custom handling for the output of ShowDialog-actions: it must be wrapped in a
     * JQM page.
     * 
     * FIXME make this work with API v4
     *
     * @see \exface\Core\Templates\AbstractAjaxTemplate\AbstractAjaxTemplate::setResponseFromAction()
     */
    public function setResponseFromAction(ActionInterface $action)
    {
        if ($action->implementsInterface('iShowDialog')) {
            // Perform the action and draw the result
            $action->getResult();
            return parent::setResponse($this->getElement($action->getDialogWidget())->generateJqmPage());
        } else {
            return parent::setResponseFromAction($action);
        }
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \exface\Core\Interfaces\Templates\HttpTemplateInterface::getUrlRoutePatterns()
     */
    public function getUrlRoutePatterns() : array
    {
        return [
            "/[\?&]tpl=nd2/",
            "/\/api\/nd2[\/?]/"
        ];
    }
    
    /**
     *
     * {@inheritDoc}
     * @see \exface\Core\Templates\AbstractAjaxTemplate\AbstractAjaxTemplate::getMiddleware()
     */
    protected function getMiddleware() : array
    {
        $middleware = parent::getMiddleware();
        $middleware[] = new JqueryDataTablesUrlParamsReader($this, 'getInputData', 'setInputData');
        return $middleware;
    }
}
?>