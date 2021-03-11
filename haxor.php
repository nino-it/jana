



function {}


SELECT author, count(author) AS CountOf
FROM books
GROUP BY author



SELECT author, COUNT(author) AS CountOf FROM books GROUP BY author ORDER BY 'CountOf' DESC