<?php

/**
 * Api.php
 *
 * @author longfei.he
 */
class Api
{
	/** @var  \Monolog\Logger */
	protected $log;

	/** @var string 接口名 */
	private $apiName = '';

	/** @var array 请求参数 */
	private $requestParams = [];

	/** @var int 接口调用时的时间戳 */
	private $runTime = 0;

	public function __construct()
	{
		$this->log = \Yaf\Registry::get('log');
	}

	/**
	 * 调用接口前
	 *
	 * @param array $params 请求参数
	 */
	private function logBefore(array $params)
	{
		$this->requestParams = $params;
//		$this->log->debug(sprintf('[%s api] request:', $this->apiName), $params);
		$this->runTime = microtime(true);
	}

	/**
	 * 调用发生异常
	 *
	 * 一般是接口为空,或者状态妈非200
	 *
	 * @param array $params 异常信息
	 *
	 * @throws \Exception
	 */
	private function logException(array $params)
	{
		$this->costTime();
		$params = array_merge($this->requestParams, $params);
		$this->log->error(sprintf('[%s api] exception:', $this->apiName), $params);
		throw new Exception(sprintf('[%s api] response exception', $this->apiName), API_RESPONSE_ERROR);
	}

	/**
	 * 调用结果出错
	 *
	 * 一般是捕获异常返回值
	 *
	 * @param string|array $params 错误数据
	 *
	 * @throws \Exception
	 */
	private function logError($params)
	{
		$this->costTime();
		is_string($params) && $params = ['errorMsg' => $params];
		$params = array_merge($this->requestParams, ['response' => $params]);
		$this->log->error(sprintf('[%s api] error:', $this->apiName), $params);
		throw new Exception(sprintf('[%s api] response error', $this->apiName), API_RESPONSE_ERROR);
	}

	/**
	 * 调用正常结束
	 *
	 * @param string|array $params 响应数据
	 */
	private function logEnd($params)
	{
		$this->costTime();
		is_array($params) && $params = var_export($params, true);
		if (mb_strlen($params) > 1024) {
			$params = mb_substr($params, 0, 1024) . '...';
		}
		$params = array_merge($this->requestParams, ['response' => $params]);
		$this->log->info(sprintf('[%s api] response:', $this->apiName), $params);
	}

	/**
	 * 计算接口耗时
	 */
	private function costTime()
	{
		$costTime = microtime(true) - $this->runTime;
		$this->requestParams['costTime'] = $costTime;
	}

	/**
	 * 检查参数
	 *
	 * @param $params
	 *
	 * @throws \Exception
	 */
	private function checkParams(&$params)
	{
		if (empty($params)) {
			throw new Exception(sprintf('[%s api] param is wrong', $this->apiName), API_PARAMS_ERROR);
		}
	}

	/**
	 * 示例
	 *
	 * @param array|string $ids
	 *
	 * @return array
	 * @throws \Exception
	 */
	public function sample($ids)
	{
		// step 1
		$this->apiName = 'tiku';

		// step 2
		$this->checkParams($ids);
		is_array($ids) && $ids = implode(',', $ids);

		$ret = [];
		$url = TIKU_API;
		$token = TIKU_PWD;
		$data = array(
			'ids'   => $ids,
			'user'  => 'longfei.he',
			'token' => $token,
			'task'  => 'superxue',
		);

		// step 3
		$this->logBefore([
			'url'    => sprintf('%s?user=longfei.he&token=%s&task=superxue', $url, $token),
			'method' => 'post',
			'data'   => ['ids' => $ids,],
		]);
		// step 4
		$response = Requests::post($url, array(), $data);
		if ($response->status_code != 200 or empty($response->body)) {
			// step 5
			$this->logException(['statusCode' => $response->status_code]);
		}

		$answers = json_decode($response->body, true);
		// step 6
		$this->logEnd($answers);

		if ($answers['type'] == 'ok') {
			$ret = $answers['questions'];
		} else {
			// step 7
			$this->logError($answers);
		}

		return $ret;
	}


}

