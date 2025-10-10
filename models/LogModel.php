<?php
namespace App\Models;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class LogModel extends BaseModel {
    /**
     * @var string
     */
    private string $folder = 'logs';

    /**
     * @param string $table
     * @param int $record_id
     * @return array
     */
    public function select(string $table, int $record_id) :array {
        $query = $this->query($this->folder, 'select-by-table-and-record-id');
        $params = [
            'table_name' => $table,
            'record_id' => $record_id,
            'deleted' => 0
        ];

        $statement = $this->db->prepare($query);
        $statement->execute($params);

        return $statement->fetchAll();
    }

    /**
     * @param array $data
     * @return bool|int
     */
    public function insert(array $data) :bool|int {
        $query = $this->query($this->folder, 'insert');

        if ($this->db->prepare($query)->execute($data)) {
            return $this->db->lastInsertId();
        }

        return false;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function update(array $data) :bool {
        $query = $this->query($this->folder, 'update');

        return $this->db->prepare($query)->execute($data);
    }
}