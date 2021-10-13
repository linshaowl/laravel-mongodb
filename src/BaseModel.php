<?php

/**
 * (c) linshaowl <linshaowl@163.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lswl\Mongodb;

use Jenssegers\Mongodb\Eloquent\Model;
use Lswl\Database\Contracts\DatabaseInterface;
use Lswl\Database\Scopes\PrimaryKeyDescScope;
use Lswl\Database\Traits\DatabaseTrait;

/**
 * 基础模型
 * @method DatabaseTrait initialize()
 */
class BaseModel extends Model implements DatabaseInterface
{
    use DatabaseTrait;

    /**
     * 关闭属性保护
     * @var bool
     */
    protected static $unguarded = true;

    /**
     * 是否使用主键倒序作用域
     * @var bool
     */
    protected static $usePrimaryKeyDescScope = true;

    protected function initializeBefore()
    {
        // 设置链接名称
        if (empty($this->connection)) {
            $this->setConnection('mongodb');
        }

        // 设置表名称
        if (empty($this->table)) {
            $this->setTable(static::getSnakePluralName());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected static function boot()
    {
        parent::boot();

        if (static::$usePrimaryKeyDescScope) {
            static::addGlobalScope(PrimaryKeyDescScope::getInstance());
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getForeignKey()
    {
        return static::getSnakeSingularName() . '_' . ltrim($this->getKeyName(), '_');
    }
}
