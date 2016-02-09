<?php
/**
 * @link http://web.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://web.yiiframework.com/license/
 */

namespace yii\codeception;

use yii\test\InitDbFixture;

/**
 * Base class for database test cases
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class DbTestCase extends TestCase
{
    /**
     * @inheritdoc
     */
    public function globalFixtures()
    {
        return [
            InitDbFixture::className(),
        ];
    }
}
