UPDATE dog_annotations
SET text                   = :text,
    dog_id                 = :dog_id,
    dog_annotation_type_id = :dog_annotation_type_id,
    deleted                = :deleted
WHERE id = :id;
