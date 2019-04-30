SELECT *
FROM customers
WHERE name LIKE :term
AND isDR=:account