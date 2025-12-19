SELECT da.id,
       da.text,
       da.dog_id,
       da.dog_annotation_type_id,
       da.deleted,
       da.created,
       da.updated,
       d.name   AS dog_name,
       dat.name AS dog_annotation_type_name
FROM dog_annotations AS da
         INNER JOIN dogs AS d ON da.dog_id = d.id
         INNER JOIN dog_annotation_types AS dat ON da.dog_annotation_type_id = dat.id
WHERE da.deleted = :deleted;
