UPDATE users
SET username      = :username,
    password      = :password,
    administrator = :administrator,
    deleted       = :deleted
WHERE id = :id;

