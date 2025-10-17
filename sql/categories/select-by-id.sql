SELECT id,
       name,
       deleted,
       created,
       updated
FROM categories
WHERE deleted = :deleted
  AND id = :id;
