<?php
/**
 * @link http://web.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://web.yiiframework.com/license/
 */

namespace yii\web;

/**
 * ServerErrorHttpException represents an "Internal Server Error" HTTP exception with status code 500.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ServerErrorHttpException extends HttpException
{
    /**
     * Constructor.
     * @param string $message error message
     * @param integer $code error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(500, $message, $code, $previous);
    }
}
