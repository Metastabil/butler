SELECT logs.id,
       logs.action,
       logs.table_name,
       logs.record_id,
       logs.user_id,
       logs.deleted,
       logs.created,
       logs.updated,
       users.username
FROM logs
         INNER JOIN users ON logs.user_id = users.id
WHERE logs.deleted = :deleted
  AND logs.table_name = :table_name
  AND logs.record_id = :record_id;

