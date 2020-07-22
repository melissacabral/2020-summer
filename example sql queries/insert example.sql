# add a new user account
INSERT INTO users
(username, profile_pic, email, password, bio, is_admin, join_date)
VALUES
('roberto', 'https://randomuser.me/api/portraits/men/35.jpg', 'roberto.schmidt@example.com', 'password', '', 0, now() )

# add multiple categories at once
INSERT INTO categories
( name )
VALUES
( 'Black and White' ),
( 'Wedding Photography' ),
( 'Macro Photos' ),
( 'Cars' )