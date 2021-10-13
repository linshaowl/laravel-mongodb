<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\Mongodb;

use Illuminate\Support\ServiceProvider;

class LswlServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 合并配置
        $this->mergeConfig();
    }

    /**
     * 合并配置
     */
    protected function mergeConfig()
    {
        // 合并 mongodb 配置
        $this->mergeConfigFrom(
            __DIR__ . '/../config/mongodb.php',
            'database.connections.mongodb'
        );
    }
}
