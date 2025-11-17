<?php
namespace App\Models;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class StoneModel extends BaseModel {
    /**
     * @var string
     */
    private string $folder = 'stones';

    /**
     * @param int $id
     * @param int $number
     * @param bool $deleted
     * @return array
     */
    public function select(int $id = 0, int $number = 0, bool $deleted = false) :array {
        $params['deleted'] = $deleted;

        if ($id > 0) {
            $query = $this->query($this->folder, 'select-by-id');
            $params['id'] = $id;
        }
        elseif ($number > 0) {
            $query = $this->query($this->folder, 'select-by-number');
            $params['number'] = $number;
        }
        else {
            $query = $this->query($this->folder, 'select');
        }

        $statement = $this->db->prepare($query);
        $statement->execute($params);

        $result = $statement->fetchAll();

        return !empty($result) && ($id > 0 || $number > 0) ? $result[0] : $result;
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