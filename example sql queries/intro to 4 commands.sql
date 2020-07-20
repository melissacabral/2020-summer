#####
# SQL query examples
#####

#get the title and body of all posts
SELECT title, body 
FROM posts

#get the title and body of one post
SELECT title, body
FROM posts
LIMIT 1

#get the title and body of any posts written by user #1
SELECT title, body
FROM posts
WHERE user_id = 1

#get the title and body of any posts in a certain category (2)
SELECT title, body
FROM posts
WHERE category_id = 2

#get the title and body (example of searching by string value)
SELECT title, body
FROM posts
WHERE body = 'so cozy'

#get all fields for all the comments written about post #1
SELECT *
FROM comments
WHERE post_id = 1

#get all fields for the first 10 comments written about post #1
SELECT *
FROM comments
WHERE post_id = 1
LIMIT 10

# add a comment on post number 2  (user number 1 commenting on this date)
INSERT INTO comments
( body, user_id, date, post_id, is_approved )
VALUES
( 'Nice Post!', 1, NOW(), 2, 1 )

# edit the body of comment 3
UPDATE comments
SET body = 'Edited Body Content!'
WHERE comment_id = 3

# delete comment 3
DELETE FROM comments
WHERE comment_id = 3

# Get the id and usernames of all administrators
SELECT user_id, username
FROM users
WHERE is_admin = 1

# get all fields for up to 5 categories
SELECT * 
FROM categories
LIMIT 5

# Add another category called "pet photos"
INSERT INTO categories
( name )
VALUES
( 'pet photos' )

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