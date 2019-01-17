<?php

/**
 * 模式名称: 流式接口模式 (FluentInterface)
 * 模式类型: 结构型
 * 模式描述: 像说话一样，一气呵成
 * 解决的问题:
 * 优点: 有利于代码的可读性
 * 缺点: 暂无
 * 和它类似的模式: 暂无
 */

class SimpleQuery
{

    protected $fields = '';

    protected $table = '';

    protected $action = '';

    protected $conditions = [];

    public function select(array $fields)
    {
        $this->fields = empty($fields) ? '*' : implode(',', $fields);
        $this->action = 'SELECT';

        return $this;
    }

    public function from($table)
    {
        $this->table = $table;

        return $this;
    }

    public function where($field, $operator, $value)
    {
        $this->conditions[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value,
        ];

        return $this;
    }

    public function __toString()
    {
        $sql = $this->action . ' ' . $this->fields . ' FROM ' . $this->table;

        if (! empty($this->conditions)) {
            $sql .= ' WHERE ';
            foreach ($this->conditions as $condition)
            {
                $sql .= $condition['field'] . ' ' . $condition['operator'] . ' ' . $condition['value'];
            }
        }

        return $sql;
    }
}

$query = new SimpleQuery();
$query->where('id', '=', '1')
      ->from('user')
      ->select(['name', 'age']);

var_dump((string) $query);
