SELECT id,
       name,
       ingredients,
       description,
       image,
       deleted,
       created,
       updated
FROM recipes
WHERE deleted = :deleted;