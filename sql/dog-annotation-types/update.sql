UPDATE dog_annotation_types
SET name    = :name,
    deleted = :deleted
WHERE id = :id;
