UPDATE recipes
SET name        = :name,
    ingredients = :ingredients,
    description = :description,
    image       = :image,
    deleted     = :deleted
WHERE id = :id;
