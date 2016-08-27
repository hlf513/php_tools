<?php

class ErrorController extends CommonController
{
	public function errorAction(Exception $exception)
	{
		if ($exception instanceof Yaf\Exception\LoadFailed\Action ||
			$exception instanceof \Yaf\Exception\LoadFailed\Controller
		) {
			error('request url is wrong', REQUEST_URL_ERROR);
		} else {
			$err_no = $exception->getCode();
            $err_no == 0 && $err_no = UNKNOW_ERROR;
            error($exception->getMessage(), $err_no);
        }

        // $this->getView()->assign("exception", $exception);
    }
}
