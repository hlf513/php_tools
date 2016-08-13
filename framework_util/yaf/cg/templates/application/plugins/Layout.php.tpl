<?php

/**
 * Class LayoutPlugin
 *
 * 视图布局插件
 */
class LayoutPlugin extends \Yaf\Plugin_Abstract
{

	/**
	 * 自动添加header和footer
	 *
	 * 注意:在 controller 中使用 return false 不再会关闭视图渲染
	 * 需要调用 Yaf\Dispatcher::getInstance()->autoRender(false) 手动关闭
	 *
	 * @param \Yaf\Request_Abstract  $request
	 * @param \Yaf\Response_Abstract $response
	 */
	public function postDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
	{
		if (Yaf\Dispatcher::getInstance()->autoRender() === true) {
			$body = $response->getBody();
			$response->clearBody();
			$layoutDir = Yaf\Registry::get('config')['layout']['directory'];
			$layout = new Yaf\View\Simple($layoutDir);
			$header = $layout->render($layoutDir . '/header.phtml');
			$footer = $layout->render($layoutDir . '/footer.phtml');
			$body = $header . $body . $footer;
			$response->setBody($body);
		}
	}

}
