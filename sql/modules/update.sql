UPDATE modules
SET name    = :name,
    deleted = :deleted
WHERE id = :id;
