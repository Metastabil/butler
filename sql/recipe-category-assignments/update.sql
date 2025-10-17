UPDATE recipe_category_assignments
SET recipe_id   = :recipe_id,
    category_id = :category_id,
    deleted     = :deleted
WHERE id = :id;