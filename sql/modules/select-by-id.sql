SELECT id,
       name,
       deleted,
       created,
       updated
FROM modules
WHERE deleted = :deleted
  AND id = :id;

