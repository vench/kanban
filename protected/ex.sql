SELECT t.new_category_id, SUM( t1.time_insert - t.time_insert ) AS s
FROM  `tbl_task_history` AS t
LEFT JOIN  `tbl_task_history` AS t1 ON ( t1.time_insert > t.time_insert ) 
GROUP BY t.new_category_id
ORDER BY t.time_insert
LIMIT 0 , 30
