UPDATE logs
SET action     = :action,
    table_name = :table_name,
    record_id  = :record_id,
    user_id    = :user_id,
    deleted    = :deleted
WHERE id = :id;
