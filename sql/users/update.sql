UPDATE users
SET username = :username,
    password = :password,
    deleted  = :deleted
WHERE id = :id;
