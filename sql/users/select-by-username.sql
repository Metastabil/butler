SELECT id,
       username,
       password,
       deleted,
       created,
       updated
FROM users
WHERE deleted = :deleted
  AND username = :username;