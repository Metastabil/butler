<?php
namespace App\Models;

/**
 * @author Julius Derigs
 * @version 1.0.0
 */

class FavoriteModel extends BaseModel {
    /**
     * @var string
     */
    private string $folder = 'favorites';

    /**
     * @param int $id
     * @param int $user_id
     * @param bool $deleted
     * @return array
     */
    public function select(int $id = 0, int $user_id = 0, bool $deleted = false) :array {
        // TODO

        return [];
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