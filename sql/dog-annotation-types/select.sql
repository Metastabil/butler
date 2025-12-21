SELECT id,
       name,
       deleted,
       created,
       updated
FROM dog_annotation_types
WHERE deleted = :deleted
ORDER BY name;


