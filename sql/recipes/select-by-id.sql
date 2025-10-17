SELECT recipes.id,
       recipes.name,
       recipes.ingredients,
       recipes.description,
       recipes.image,
       recipes.deleted,
       recipes.created,
       recipes.updated,
       GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories,
       GROUP_CONCAT(categories.id SEPARATOR ',')    AS category_ids
FROM recipes
         LEFT JOIN recipe_category_assignments ON recipes.id = recipe_category_assignments.recipe_id
         LEFT JOIN categories
                   ON recipe_category_assignments.category_id = categories.id AND recipe_category_assignments.deleted = :deleted
WHERE recipes.deleted = :deleted
  AND recipes.id = :id
GROUP BY recipes.id;
