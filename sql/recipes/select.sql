SELECT recipes.id,
       recipes.name,
       recipes.ingredients,
       recipes.description,
       recipes.image,
       recipes.deleted,
       recipes.created,
       recipes.updated,
       GROUP_CONCAT(categories.name SEPARATOR ', ') AS categories
FROM recipes
         LEFT JOIN recipe_category_assignments ON recipes.id = recipe_category_assignments.recipe_id
         LEFT JOIN categories
                   ON recipe_category_assignments.category_id = categories.id AND recipe_category_assignments.deleted = :deleted
WHERE recipes.deleted = :deleted
GROUP BY recipes.id;

