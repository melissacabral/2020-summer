/**
 * Example SELECT Statements
 */

# Basic template
SELECT field1, field2, field3
FROM table
WHERE condition
	AND condition 2
ORDER BY field ASC
LIMIT 10


# AGGREGATE FUNCTIONS - Count
# get a count of all posts written by user 1
SELECT COUNT(*) AS total
FROM posts
WHERE user_id = 1

#get a count of how many published posts in each category
SELECT COUNT(*) AS total, category_id
FROM posts
GROUP BY category_id

# JOIN EXAMPLE 
# get the titles of all posts, and the usernames of their authors
SELECT posts.title, users.username
FROM posts, users
WHERE posts.user_id = users.user_id