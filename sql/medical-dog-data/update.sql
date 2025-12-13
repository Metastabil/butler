UPDATE medical_dog_data
SET name        = :name,
    description = :description,
    date        = :date,
    dog_id      = :dog_id,
    deleted     = :deleted
WHERE id = :id;
