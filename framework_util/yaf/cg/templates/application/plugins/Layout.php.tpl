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
	 * 注意:
	 * 1. 在 controller 中使用 return false 不再会关闭视图渲染
	 * 需要调用 \Yaf\Dispatcher::getInstance()->autoRender(false) 手动关闭
	 * 2. $body是已经渲染过的,不包含这里的$action等变量
	 *
	 * @param \Yaf\Request_Abstract  $request
	 * @param \Yaf\Response_Abstract $response
	 */
	public function postDispatch(\Yaf\Request_Abstract $request, \Yaf\Response_Abstract $response)
	{
		if (\Yaf\Dispatcher::getInstance()->autoRender() === true) {
			$body = $response->getBody();
			$response->clearBody();
			$layoutConfig = Yaf\Registry::get('config')['layout'];
			if (empty($layoutConfig['directory']) || empty($layoutConfig['file'])) {
				die('layout配置错误');
			}

			$layout = new Yaf\View\Simple($layoutConfig['directory']);
			$layout->assign('module', $request->getModuleName());
			$layout->assign('controller', $request->getControllerName());
			$layout->assign('action', $request->getActionName());
			// 已经渲染好的body
			$layout->assign('content', $body);
			$response->setBody($layout->render($layoutConfig['file']));
		}
	}

}
