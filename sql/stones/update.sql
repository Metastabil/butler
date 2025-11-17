UPDATE stones
SET number      = :number,
    name        = :name,
    rarity      = :rarity,
    description = :description,
    seen        = :seen,
    deleted     = :deleted
WHERE id = :id;
