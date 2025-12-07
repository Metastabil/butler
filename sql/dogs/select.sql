SELECT id, name, user_id, deleted, created, updated
FROM dogs
WHERE deleted = :deleted;
