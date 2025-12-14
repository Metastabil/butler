UPDATE dogs
SET name    = :name,
    user_id = :user_id,
    deleted = :deleted
WHERE id = :id;
