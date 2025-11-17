SELECT id,
       number,
       name,
       rarity,
       description,
       seen,
       deleted,
       created,
       updated
FROM stones
WHERE deleted = :deleted;