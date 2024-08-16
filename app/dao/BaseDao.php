<?php

namespace app\dao;

use app\model\BaseModel;
use support\Container;

abstract class BaseDao
{
    /**
     * 设置当前模型
     * @return  string
     */
    abstract protected function setModel(): string;

    /**
     * 获取当前模型
     * @param array $params
     * @return BaseModel
     */
    protected function getModel(array $params = []): BaseModel
    {
        return empty($params) ? Container::get($this->setModel()) : Container::make($this->setModel(), $params);
    }
}
