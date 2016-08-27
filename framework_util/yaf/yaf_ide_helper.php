<?php
namespace Yaf {
	final class Application {
		/* properties */
		protected $config = NULL;
		protected $dispatcher = NULL;
		static protected $_app = NULL;
		protected $_modules = NULL;
		protected $_running = "";
		protected $_environ = "product";
		protected $_err_no = "0";
		protected $_err_msg = "";

		/* methods */
		public function __construct($config, $environ = NULL) {
		}
		public function run() {
		}
		/**
		 * @return mixed
		 */
		public function execute($entry, $_ = "...") {
		}
		/**
		 * @return \Yaf\Application | null
		 */
		public static function app() {
		}
		/**
		 * @return string
		 */
		public function environ() {
		}
		/**
		 * @return \Yaf\Application
		 */
		public function bootstrap($bootstrap = NULL) {
		}
		/**
		 * @return \Yaf\Config\Ini | \Yaf\Config\Simple
		 */
		public function getConfig() {
		}
		public function getModules() {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function getDispatcher() {
		}
		/**
		 * @return \Yaf\Application
		 */
		public function setAppDirectory($directory) {
		}
		/**
		 * @return string
		 */
		public function getAppDirectory() {
		}
		/**
		 * @return int
		 */
		public function getLastErrorNo() {
		}
		/**
		 * @return string
		 */
		public function getLastErrorMsg() {
		}
		public function clearLastError() {
		}
		public function __destruct() {
		}
		private function __clone() {
		}
		private function __sleep() {
		}
		private function __wakeup() {
		}
	}
}

namespace Yaf {
	abstract class Bootstrap_Abstract {
	}
}

namespace Yaf {
	final class Dispatcher {
		/* properties */
		protected $_router = NULL;
		protected $_view = NULL;
		protected $_request = NULL;
		protected $_plugins = NULL;
		static protected $_instance = NULL;
		protected $_auto_render = "1";
		protected $_return_response = "";
		protected $_instantly_flush = "";
		protected $_default_module = NULL;
		protected $_default_controller = NULL;
		protected $_default_action = NULL;

		/* methods */
		private function __construct() {
		}
		private function __clone() {
		}
		private function __sleep() {
		}
		private function __wakeup() {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function enableView() {
		}
		/**
		 * @return bool
		 */
		public function disableView() {
		}
		/**
		 * @return \Yaf\View\Simple
		 */
		public function initView($templates_dir, array $options = NULL) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setView($view) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setRequest($request) {
		}
		/**
		 * @return \Yaf\Application
		 */
		public function getApplication() {
		}
		/**
		 * @return \Yaf\Router
		 */
		public function getRouter() {
		}
		/**
		 * @return \Yaf\Request\Http | \Yaf\Request\Simple
		 */
		public function getRequest() {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setErrorHandler($callback, $error_types) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setDefaultModule($module) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setDefaultController($controller) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function setDefaultAction($action) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function returnResponse($flag) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function autoRender($flag = null) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function flushInstantly($flag) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public static function getInstance() {
		}
		/**
		 * @return \Yaf\Response\Http | \Yaf\Response\Cli
		 */
		public function dispatch($request) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function throwException($flag = NULL) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function catchException($flag = NULL) {
		}
		/**
		 * @return \Yaf\Dispatcher
		 */
		public function registerPlugin($plugin) {
		}
	}
}

namespace Yaf {
	final class Loader {
		/* properties */
		protected $_library = NULL;
		protected $_global_library = NULL;
		static protected $_instance = NULL;

		/* methods */
		private function __construct() {
		}
		private function __clone() {
		}
		private function __sleep() {
		}
		private function __wakeup() {
		}
		/**
		 * @return bool
		 */
		public function autoload($class_name) {
		}
		/**
		 * @return \Yaf\Loader
		 */
		public static function getInstance($local_library_path = NULL, $global_library_path = NULL) {
		}
		/**
		 * @return \Yaf\Loader
		 */
		public function registerLocalNamespace($name_prefix) {
		}
		/**
		 * @return array | null
		 */
		public function getLocalNamespace() {
		}
		/**
		 * @return bool
		 */
		public function clearLocalNamespace() {
		}
		/**
		 * @return bool
		 */
		public function isLocalName($class_name) {
		}
		/**
		 * @return bool
		 */
		public static function import($file) {
		}
		public function setLibraryPath($library_path, $is_global = NULL) {
		}
		/**
		 * @return string
		 */
		public function getLibraryPath($is_global = NULL) {
		}
	}
}

namespace Yaf {
	abstract class Request_Abstract {
		/* constants */
		const SCHEME_HTTP = "http";
		const SCHEME_HTTPS = "https";

		/* properties */
		public $module = NULL;
		public $controller = NULL;
		public $action = NULL;
		public $method = NULL;
		protected $params = NULL;
		protected $language = NULL;
		protected $_exception = NULL;
		protected $_base_uri = "";
		protected $uri = "";
		protected $dispatched = "";
		protected $routed = "";

		/* methods */
		/**
		 * @return bool
		 */
		public function isGet() {
		}
		/**
		 * @return bool
		 */
		public function isPost() {
		}
		/**
		 * @return bool
		 */
		public function isPut() {
		}
		/**
		 * @return bool
		 */
		public function isHead() {
		}
		/**
		 * @return bool
		 */
		public function isOptions() {
		}
		/**
		 * @return bool
		 */
		public function isCli() {
		}
		/**
		 * @return bool
		 */
		public function isXmlHttpRequest() {
		}
		/**
		 * @return string | null
		 */
		public function getServer($name, $default = NULL) {
		}
		/**
		 * @return string
		 */
		public function getEnv($name, $default = NULL) {
		}
		/**
		 * @return bool
		 */
		public function setParam($name, $value = NULL) {
		}
		/**
		 * @return string
		 */
		public function getParam($name, $default = NULL) {
		}
		/**
		 * @return array
		 */
		public function getParams() {
		}
		/**
		 * @return \Exception
		 */
		public function getException() {
		}
		/**
		 * @return string
		 */
		public function getModuleName() {
		}
		/**
		 * @return string
		 */
		public function getControllerName() {
		}

		/**
		 * @return string
		 */
		public function getActionName() {
		}
		/**
		 * @return bool
		 */
		public function setModuleName($module) {
		}
		/**
		 * @return bool
		 */
		public function setControllerName($controller) {
		}
		/**
		 * @return bool
		 */
		public function setActionName($action) {
		}
		/**
		 * @return string
		 */
		public function getMethod() {
		}
		/**
		 * @return string
		 */
		public function getLanguage() {
		}
		/**
		 * @return bool
		 */
		public function setBaseUri($uri) {
		}
		/**
		 * @return string
		 */
		public function getBaseUri() {
		}
		/**
		 * @return string
		 */
		public function getRequestUri() {
		}
		/**
		 * @return bool
		 */
		public function setRequestUri($uri) {
		}
		/**
		 * @return bool
		 */
		public function isDispatched() {
		}
		/**
		 * @return bool
		 */
		public function setDispatched() {
		}
		/**
		 * @return bool
		 */
		public function isRouted() {
		}
		/**
		 * @return bool
		 */
		public function setRouted($flag = NULL) {
		}
	}
}

namespace Yaf\Request {
	class Http extends \Yaf\Request_Abstract {
		/* properties */
		public $module = NULL;
		public $controller = NULL;
		public $action = NULL;
		public $method = NULL;
		protected $params = NULL;
		protected $language = NULL;
		protected $_exception = NULL;
		protected $_base_uri = "";
		protected $uri = "";
		protected $dispatched = "";
		protected $routed = "";

		/* methods */
		/**
		 * @return mixed
		 */
		public function getQuery() {
		}
		/**
		 * @return \Yaf\Request\Http | \Yaf\Request\Simple
		 */
		public function getRequest() {
		}
		/**
		 * @return mixed
		 */
		public function getPost() {
		}
		/**
		 * @return string
		 */
		public function getCookie() {
		}
		/**
		 * @return mixed
		 */
		public function getFiles() {
		}
		/**
		 * @return mixed
		 */
		public function get() {
		}
		/**
		 * @return bool
		 */
		public function isXmlHttpRequest() {
		}
		public function __construct() {
		}
		private function __clone() {
		}
		/**
		 * @return bool
		 */
		public function isGet() {
		}
		/**
		 * @return bool
		 */
		public function isPost() {
		}
		/**
		 * @return bool
		 */
		public function isPut() {
		}
		/**
		 * @return bool
		 */
		public function isHead() {
		}
		/**
		 * @return bool
		 */
		public function isOptions() {
		}
		/**
		 * @return bool
		 */
		public function isCli() {
		}
		/**
		 * @return string | null
		 */
		public function getServer($name, $default = NULL) {
		}
		/**
		 * @return string
		 */
		public function getEnv($name, $default = NULL) {
		}
		/**
		 * @return bool
		 */
		public function setParam($name, $value = NULL) {
		}
		/**
		 * @return string
		 */
		public function getParam($name, $default = NULL) {
		}
		/**
		 * @return array
		 */
		public function getParams() {
		}
		/**
		 * @return \Exception
		 */
		public function getException() {
		}
		/**
		 * @return string
		 */
		public function getModuleName() {
		}
		/**
		 * @return string
		 */
		public function getControllerName() {
		}
		public function getActionName() {
		}
		/**
		 * @return bool
		 */
		public function setModuleName($module) {
		}
		/**
		 * @return bool
		 */
		public function setControllerName($controller) {
		}
		/**
		 * @return bool
		 */
		public function setActionName($action) {
		}
		/**
		 * @return string
		 */
		public function getMethod() {
		}
		/**
		 * @return string
		 */
		public function getLanguage() {
		}
		/**
		 * @return bool
		 */
		public function setBaseUri($uri) {
		}
		/**
		 * @return string
		 */
		public function getBaseUri() {
		}
		/**
		 * @return string
		 */
		public function getRequestUri() {
		}
		/**
		 * @return bool
		 */
		public function setRequestUri($uri) {
		}
		/**
		 * @return bool
		 */
		public function isDispatched() {
		}
		/**
		 * @return bool
		 */
		public function setDispatched() {
		}
		/**
		 * @return bool
		 */
		public function isRouted() {
		}
		/**
		 * @return bool
		 */
		public function setRouted($flag = NULL) {
		}
	}
}

namespace Yaf\Request {
	final class Simple extends \Yaf\Request_Abstract {
		/* constants */
		const SCHEME_HTTP = "http";
		const SCHEME_HTTPS = "https";

		/* properties */
		public $module = NULL;
		public $controller = NULL;
		public $action = NULL;
		public $method = NULL;
		protected $params = NULL;
		protected $language = NULL;
		protected $_exception = NULL;
		protected $_base_uri = "";
		protected $uri = "";
		protected $dispatched = "";
		protected $routed = "";

		/* methods */
		public function __construct() {
		}
		private function __clone() {
		}
		/**
		 * @return mixed
		 */
		public function getQuery() {
		}
		/**
		 * @return \Yaf\Request\Http | \Yaf\Request\Simple
		 */
		public function getRequest() {
		}
		/**
		 * @return mixed
		 */
		public function getPost() {
		}
		/**
		 * @return string
		 */
		public function getCookie() {
		}
		/**
		 * @return mixed
		 */
		public function getFiles() {
		}
		/**
		 * @return mixed
		 */
		public function get() {
		}
		/**
		 * @return bool
		 */
		public function isXmlHttpRequest() {
		}
		/**
		 * @return bool
		 */
		public function isGet() {
		}
		/**
		 * @return bool
		 */
		public function isPost() {
		}
		/**
		 * @return bool
		 */
		public function isPut() {
		}
		/**
		 * @return bool
		 */
		public function isHead() {
		}
		/**
		 * @return bool
		 */
		public function isOptions() {
		}
		/**
		 * @return bool
		 */
		public function isCli() {
		}
		/**
		 * @return string | null
		 */
		public function getServer($name, $default = NULL) {
		}
		/**
		 * @return string
		 */
		public function getEnv($name, $default = NULL) {
		}
		/**
		 * @return bool
		 */
		public function setParam($name, $value = NULL) {
		}
		/**
		 * @return string
		 */
		public function getParam($name, $default = NULL) {
		}
		/**
		 * @return array
		 */
		public function getParams() {
		}
		/**
		 * @return \Exception
		 */
		public function getException() {
		}
		/**
		 * @return string
		 */
		public function getModuleName() {
		}
		/**
		 * @return string
		 */
		public function getControllerName() {
		}
		public function getActionName() {
		}
		/**
		 * @return bool
		 */
		public function setModuleName($module) {
		}
		/**
		 * @return bool
		 */
		public function setControllerName($controller) {
		}
		/**
		 * @return bool
		 */
		public function setActionName($action) {
		}
		/**
		 * @return string
		 */
		public function getMethod() {
		}
		/**
		 * @return string
		 */
		public function getLanguage() {
		}
		/**
		 * @return bool
		 */
		public function setBaseUri($uri) {
		}
		/**
		 * @return string
		 */
		public function getBaseUri() {
		}
		/**
		 * @return string
		 */
		public function getRequestUri() {
		}
		/**
		 * @return bool
		 */
		public function setRequestUri($uri) {
		}
		/**
		 * @return bool
		 */
		public function isDispatched() {
		}
		/**
		 * @return bool
		 */
		public function setDispatched() {
		}
		/**
		 * @return bool
		 */
		public function isRouted() {
		}
		/**
		 * @return bool
		 */
		public function setRouted($flag = NULL) {
		}
	}
}

namespace Yaf {
	abstract class Response_Abstract {
		/* constants */
		const DEFAULT_BODY = "content";

		/* properties */
		protected $_header = NULL;
		protected $_body = NULL;
		protected $_sendheader = "";

		/* methods */
		public function __construct() {
		}
		public function __destruct() {
		}
		private function __clone() {
		}
		public function __toString() {
		}
		/**
		 * @return bool
		 */
		public function setBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function appendBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function prependBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function clearBody($name = NULL) {
		}
		/**
		 * @return string
		 */
		public function getBody($name = NULL) {
		}
		public function response() {
		}
	}
}

namespace Yaf\Response {
	class Http extends \Yaf\Response_Abstract {
		/* constants */
		const DEFAULT_BODY = "content";

		/* properties */
		protected $_header = NULL;
		protected $_body = NULL;
		protected $_sendheader = "1";
		protected $_response_code = "0";

		/* methods */
		/**
		 * @return bool
		 */
		public function setHeader($name, $value, $rep = NULL, $response_code = NULL) {
		}
		public function setAllHeaders($headers) {
		}
		/**
		 * @return array
		 */
		public function getHeader($name = NULL) {
		}
		public function clearHeaders() {
		}
		public function setRedirect($url) {
		}
		public function response() {
		}
		public function __construct() {
		}
		public function __destruct() {
		}
		private function __clone() {
		}
		public function __toString() {
		}
		/**
		 * @return bool
		 */
		public function setBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function appendBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function prependBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function clearBody($name = NULL) {
		}
		/**
		 * @return string
		 */
		public function getBody($name = NULL) {
		}
	}
}

namespace Yaf\Response {
	class Cli extends \Yaf\Response_Abstract {
		/* constants */
		const DEFAULT_BODY = "content";

		/* properties */
		protected $_header = NULL;
		protected $_body = NULL;
		protected $_sendheader = "";

		/* methods */
		public function __construct() {
		}
		public function __destruct() {
		}
		private function __clone() {
		}
		public function __toString() {
		}
		/**
		 * @return bool
		 */
		public function setBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function appendBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function prependBody($body, $name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function clearBody($name = NULL) {
		}
		/**
		 * @return string
		 */
		public function getBody($name = NULL) {
		}
		public function response() {
		}
	}
}

namespace Yaf {
	abstract class Controller_Abstract {
		/* properties */
		public $actions = NULL;
		protected $_module = NULL;
		protected $_name = NULL;
		protected $_request = NULL;
		protected $_response = NULL;
		protected $_invoke_args = NULL;
		protected $_view = NULL;

		/* methods */
		/**
		 * @return string
		 */
		protected function render($tpl, array $parameters = NULL) {
		}
		/**
		 * @return bool
		 */
		protected function display($tpl, array $parameters = NULL) {
		}
		/**
		 * @return \Yaf\Request\Http | \Yaf\Request\Simple
		 */
		public function getRequest() {
		}
		/**
		 * @return \Yaf\Response\Http | \Yaf\Response\Cli
		 */
		public function getResponse() {
		}
		/**
		 * @return string
		 */
		public function getModuleName() {
		}
		/**
		 * @return \Yaf\View\Simple
		 */
		public function getView() {
		}
		/**
		 * @return \Yaf\View\Simple
		 */
		public function initView(array $options = NULL) {
		}
		public function setViewpath($view_directory) {
		}
		public function getViewpath() {
		}
		/**
		 * @return void
		 */
		public function forward($module, $controller = NULL, $action = NULL, array $parameters = NULL) {
		}
		public function redirect($url) {
		}
		public function getInvokeArgs() {
		}
		public function getInvokeArg($name) {
		}
		final public function __construct() {
		}
		final private function __clone() {
		}
	}
}

namespace Yaf {
	abstract class Action_Abstract extends \Yaf\Controller_Abstract {
		/* properties */
		public $actions = NULL;
		protected $_module = NULL;
		protected $_name = NULL;
		protected $_request = NULL;
		protected $_response = NULL;
		protected $_invoke_args = NULL;
		protected $_view = NULL;
		protected $_controller = NULL;

		/* methods */
		/**
		 * @return mixed
		 */
		abstract public function execute();
		/**
		 * @return \Yaf\Controller_Abstract
		 */
		public function getController() {
		}
		/**
		 * @return string
		 */
		protected function render($tpl, array $parameters = NULL) {
		}
		/**
		 * @return bool
		 */
		protected function display($tpl, array $parameters = NULL) {
		}
		/**
		 * @return \Yaf\Request\Http | \Yaf\Request\Simple
		 */
		public function getRequest() {
		}
		/**
		 * @return \Yaf\Response\Http | \Yaf\Response\Cli
		 */
		public function getResponse() {
		}
		/**
		 * @return string
		 */
		public function getModuleName() {
		}
		/**
		 * @return \Yaf\View\Simple
		 */
		public function getView() {
		}
		/**
		 * @return \Yaf\View\Simple
		 */
		public function initView(array $options = NULL) {
		}
		public function setViewpath($view_directory) {
		}
		public function getViewpath() {
		}
		/**
		 * @return void
		 */
		public function forward($module, $controller = NULL, $action = NULL, array $parameters = NULL) {
		}
		public function redirect($url) {
		}
		public function getInvokeArgs() {
		}
		public function getInvokeArg($name) {
		}
		final public function __construct() {
		}
		final private function __clone() {
		}
	}
}

namespace Yaf {
	abstract class Config_Abstract {
		/* properties */
		protected $_config = NULL;
		protected $_readonly = "1";

		/* methods */
		/**
		 * @return mixed
		 */
		abstract public function get();
		/**
		 * @return bool
		 */
		abstract public function set();
		/**
		 * @return bool
		 */
		abstract public function readonly();
		/**
		 * @return array
		 */
		abstract public function toArray();
	}
}

namespace Yaf\Config {
	final class Ini extends \Yaf\Config_Abstract implements Iterator, Traversable, ArrayAccess, Countable {
		/* properties */
		protected $_config = NULL;
		protected $_readonly = "1";

		/* methods */
		public function __construct($config_file, $section = NULL) {
		}
		public function __isset($name) {
		}
		/**
		 * @return mixed
		 */
		public function get($name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function set($name, $value) {
		}
		/**
		 * @return int
		 */
		public function count() {
		}
		public function rewind() {
		}
		/**
		 * @return object
		 */
		public function current() {
		}
		public function next() {
		}
		public function valid() {
		}
		public function key() {
		}
		/**
		 * @return array
		 */
		public function toArray() {
		}
		/**
		 * @return bool
		 */
		public function readonly() {
		}
		public function offsetUnset($name) {
		}
		public function offsetGet($name) {
		}
		public function offsetExists($name) {
		}
		public function offsetSet($name, $value) {
		}
		public function __get($name = NULL) {
		}
		public function __set($name, $value) {
		}
	}
}

namespace Yaf\Config {
	final class Simple extends \Yaf\Config_Abstract implements Iterator, Traversable, ArrayAccess, Countable {
		/* properties */
		protected $_config = NULL;
		protected $_readonly = "";

		/* methods */
		public function __construct($config_file, $section = NULL) {
		}
		public function __isset($name) {
		}
		/**
		 * @return mixed
		 */
		public function get($name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function set($name, $value) {
		}
		/**
		 * @return int
		 */
		public function count() {
		}
		public function offsetUnset($name) {
		}
		public function rewind() {
		}
		/**
		 * @return object
		 */
		public function current() {
		}
		public function next() {
		}
		public function valid() {
		}
		public function key() {
		}
		/**
		 * @return bool
		 */
		public function readonly() {
		}
		/**
		 * @return array
		 */
		public function toArray() {
		}
		public function __set($name, $value) {
		}
		public function __get($name = NULL) {
		}
		public function offsetGet($name) {
		}
		public function offsetExists($name) {
		}
		public function offsetSet($name, $value) {
		}
	}
}

namespace Yaf\View {
	class Simple implements Yaf\View_Interface {
		/* properties */
		protected $_tpl_vars = NULL;
		protected $_tpl_dir = NULL;
		protected $_options = NULL;

		/* methods */
		final public function __construct($template_dir, array $options = NULL) {
		}
		public function __isset($name) {
		}
		/**
		 * @return mixed
		 */
		public function get($name = NULL) {
		}
		/**
		 * @return bool
		 */
		public function assign($name, $value = NULL) {
		}
		/**
		 * @return string
		 */
		public function render($tpl, $tpl_vars = NULL) {
		}
		/**
		 * @return string
		 */
		public function eval($tpl_str, $vars = NULL) {
		}
		/**
		 * @return bool
		 */
		public function display($tpl, $tpl_vars = NULL) {
		}
		/**
		 * @return bool
		 */
		public function assignRef($name, &$value) {
		}
		/**
		 * @return bool
		 */
		public function clear($name = NULL) {
		}
		public function setScriptPath($template_dir) {
		}
		public function getScriptPath() {
		}
		public function __get($name = NULL) {
		}
		public function __set($name, $value = NULL) {
		}
	}
}

namespace Yaf {
	final class Router {
		/* properties */
		protected $_routes = NULL;
		protected $_current = NULL;

		/* methods */
		public function __construct() {
		}
		public function addRoute() {
		}
		public function addConfig() {
		}
		/**
		 * @return bool
		 */
		public function route() {
		}
		/**
		 * @return \Yaf\Route_Static | \Yaf\Route\Simple | \Yaf\Route\Supervar | \Yaf\Route\Rewrite | \Yaf\Route\Regex | \Yaf\Route\Map
		 */
		public function getRoute() {
		}
		/**
		 * @return array
		 */
		public function getRoutes() {
		}
		/**
		 * @return string
		 */
		public function getCurrentRoute() {
		}
	}
}

namespace Yaf {
	class Route_Static implements Yaf\Route_Interface {
		/* methods */
		public function match($uri) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf\Route {
	final class Simple implements Yaf\Route_Interface {
		/* properties */
		protected $controller = NULL;
		protected $module = NULL;
		protected $action = NULL;

		/* methods */
		public function __construct($module_name, $controller_name, $action_name) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf\Route {
	final class Supervar implements Yaf\Route_Interface {
		/* properties */
		protected $_var_name = NULL;

		/* methods */
		public function __construct($supervar_name) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf\Route {
	final class Rewrite implements Yaf\Route_Interface {
		/* properties */
		protected $_route = NULL;
		protected $_default = NULL;
		protected $_verify = NULL;

		/* methods */
		public function __construct($match, array $route, array $verify = NULL) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf\Route {
	final class Regex implements Yaf\Route_Interface {
		/* properties */
		protected $_route = NULL;
		protected $_default = NULL;
		protected $_maps = NULL;
		protected $_verify = NULL;
		protected $_reverse = NULL;

		/* methods */
		public function __construct($match, array $route, array $map = NULL, array $verify = NULL, $reverse = NULL) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf\Route {
	final class Map implements Yaf\Route_Interface {
		/* properties */
		protected $_ctl_router = "";
		protected $_delimiter = NULL;

		/* methods */
		public function __construct($controller_prefer = NULL, $delimiter = NULL) {
		}
		/**
		 * @return bool
		 */
		public function route($request) {
		}
		/**
		 * @return string
		 */
		public function assemble(array $info, array $query = NULL) {
		}
	}
}

namespace Yaf {
	abstract class Plugin_Abstract {
		/* methods */
		public function routerStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function routerShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function dispatchLoopStartup(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function dispatchLoopShutdown(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function preDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function postDispatch(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
		public function preResponse(Yaf\Request_Abstract $request, Yaf\Response_Abstract $response) {
		}
	}
}

namespace Yaf {
	final class Registry {
		/* properties */
		static protected $_instance = NULL;
		protected $_entries = NULL;

		/* methods */
		private function __construct() {
		}
		private function __clone() {
		}
		/**
		 * @return mixed
		 */
		public static function get($name) {
		}
		/**
		 * @return bool
		 */
		public static function has($name) {
		}
		/**
		 * @return bool
		 */
		public static function set($name, $value) {
		}
		/**
		 * @return bool
		 */
		public static function del($name) {
		}
	}
}

namespace Yaf {
	final class Session implements Iterator, Traversable, ArrayAccess, Countable {
		/* properties */
		static protected $_instance = NULL;
		protected $_session = NULL;
		protected $_started = "";

		/* methods */
		private function __construct() {
		}
		private function __clone() {
		}
		private function __sleep() {
		}
		private function __wakeup() {
		}
		/**
		 * @return \Yaf\Session
		 */
		public static function getInstance() {
		}
		public function start() {
		}
		/**
		 * @return mixed
		 */
		public function get($name) {
		}
		/**
		 * @return bool
		 */
		public function has($name) {
		}
		/**
		 * @return bool
		 */
		public function set($name, $value) {
		}
		/**
		 * @return bool
		 */
		public function del($name) {
		}
		/**
		 * @return int
		 */
		public function count() {
		}
		public function rewind() {
		}
		public function next() {
		}
		/**
		 * @return object
		 */
		public function current() {
		}
		public function key() {
		}
		public function valid() {
		}
		/**
		 * @return bool
		 */
		public function clear() {
		}
		public function offsetGet($name) {
		}
		public function offsetSet($name, $value) {
		}
		public function offsetExists($name) {
		}
		public function offsetUnset($name) {
		}
		public function __get($name) {
		}
		public function __isset($name) {
		}
		public function __set($name, $value) {
		}
		public function __unset($name) {
		}
	}
}

namespace Yaf {
	class Exception extends \Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception {
	class StartupError extends \Yaf\Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception {
	class RouterFailed extends \Yaf\Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception {
	class DispatchFailed extends \Yaf\Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception {
	class LoadFailed extends \Yaf\Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception\LoadFailed {
	class Module extends \Yaf\Exception\LoadFailed {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception\LoadFailed {
	class Controller extends \Yaf\Exception\LoadFailed {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception\LoadFailed {
	class Action extends \Yaf\Exception\LoadFailed {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception\LoadFailed {
	class View extends \Yaf\Exception\LoadFailed {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf\Exception {
	class TypeError extends \Yaf\Exception {
		/* properties */
		protected $file = NULL;
		protected $line = NULL;
		protected $message = NULL;
		protected $code = "0";
		protected $previous = NULL;

		/* methods */
		final private function __clone() {
		}
		public function __construct($message = NULL, $code = NULL, $previous = NULL) {
		}
		public function __wakeup() {
		}
		final public function getMessage() {
		}
		final public function getCode() {
		}
		final public function getFile() {
		}
		final public function getLine() {
		}
		final public function getTrace() {
		}
		final public function getPrevious() {
		}
		final public function getTraceAsString() {
		}
		public function __toString() {
		}
	}
}

namespace Yaf {
	interface View_Interface {
		/* methods */
		/**
		 * @return bool
		 */
		public function assign();
		/**
		 * @return bool
		 */
		public function display();
		/**
		 * @return string
		 */
		public function render();
		public function setScriptPath();
		public function getScriptPath();
	}
}

namespace Yaf {
	interface Route_Interface {
		/* methods */
		/**
		 * @return bool
		 */
		public function route();
		/**
		 * @return string
		 */
		public function assemble();
	}
}

