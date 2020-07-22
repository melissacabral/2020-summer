# add a new user account
INSERT INTO users
(username, profile_pic, email, password, bio, is_admin, join_date)
VALUES
('roberto', 'https://randomuser.me/api/portraits/men/35.jpg', 'roberto.schmidt@example.com', 'password', '', 0, now() )

# add 5 categories at once
INSERT INTO categories
( name )
VALUES
( 'Wedding' ),
( 'Macro' ),
( 'Cars' ),
( 'Vacation' ),
( 'Sunset' ) 

# add 3 posts at once
INSERT INTO posts
( title, body, date, image, user_id )
VALUES
( 'Hello there', 'This is the caption.', now(), 'images/45646.jpg', 2 ),
( 'Another post', 'Fake caption here', now(), 'images/54224.jpg', 6 ),
( 'Happy Friday', 'Have a good one!', now(), 'images/8435221.jpg', 1 )