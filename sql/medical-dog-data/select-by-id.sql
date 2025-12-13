SELECT id,
       name,
       description,
       date,
       dog_id,
       deleted,
       created,
       updated
FROM medical_dog_data
WHERE deleted = :deleted
  AND id = :id;
