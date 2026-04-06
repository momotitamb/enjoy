<?php

class QueryBuilder {
    private $table;
    private $wheres = [];
    private $orderBys = [];

    public function select($table) {
        $this->table = $table;
        return $this;
    }

    public function where($column, $operator, $value) {
        $this->wheres[] = ['column' => $column, 'operator' => $operator, 'value' => $value];
        return $this;
    }

    public function orderBy($column, $direction) {
        $this->orderBys[] = ['column' =>  $column, 'direction' => $direction];
        return $this;
    }

    public function get() {
        $sql = "SELECT * FROM " . $this->table;
        if (!empty($this->wheres)) {
            $sql .= " WHERE ";
            foreach ($this->wheres as $index => $item) {
                if ($index > 0) {
                    $sql .= ' AND ';
                }                
                $sql .= $item['column'] . ' ' . $item['operator'] . ' ' . $item['value'];
            }
        }

        if (!empty($this->orderBys)) {
            $sql .= " ORDER BY ";
            foreach ($this->orderBys as $item) {
                $sql .= $item['column'] . ' ' . $item['direction'];
            }
        }
        echo $sql;
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}