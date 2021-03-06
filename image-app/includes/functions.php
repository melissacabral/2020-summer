<?php 
//Convert DATETIME to a human-friendly format
function nice_date( $ugly_date ){
	$date = new DateTime( $ugly_date );
	//desired format: Tuesday, July 21
	echo $date->format( 'l, F j' );
}

//Convert a DATETIME to "time ago" as in "2 weeks ago"
//https://stackoverflow.com/a/18602474
function time_ago($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    echo $string ? implode(', ', $string) . ' ago' : 'just now';
}

//Sanitize any text field for the DB
function clean_string( $dirty ){
    global $db;
    $clean = mysqli_real_escape_string( $db, filter_var( $dirty, FILTER_SANITIZE_STRING ) );
    return $clean;
}

function clean_email( $dirty ){
    global $db;
    $clean = mysqli_real_escape_string( $db, filter_var( $dirty, FILTER_SANITIZE_EMAIL ) );
    return $clean;
}

function clean_int( $dirty ){
    global $db;
    $clean = mysqli_real_escape_string( $db, filter_var( $dirty, FILTER_SANITIZE_NUMBER_INT ) );
    return $clean;
}

function clean_boolean( $dirty ){
    if( $dirty == 1 ){
        return 1;
    }else{
        return 0;
    }   
}


//check to see if the viewer is logged in
//returns false if not logged in
//return an array of all user info if they are logged in
function check_login(){
    global $db;
    //if the cookie is valid, turn it into session data
    if(isset($_COOKIE['salt']) AND isset($_COOKIE['user_id'])){
        $_SESSION['salt'] = $_COOKIE['salt'];
        $_SESSION['user_id'] = $_COOKIE['user_id'];
    }

   //if the session is valid, check their credentials
   if( isset($_SESSION['salt']) AND isset($_SESSION['user_id']) ){
        //check to see if these keys match the DB
        $salt = $_SESSION['salt'];
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT * FROM users
                WHERE user_id = $user_id
                AND sha1(salt) = '$salt'
                LIMIT 1";

        $result = $db->query($sql);
        if(! $result){
            return false;
        }
        if($result->num_rows == 1){
            //success! return all the info about the logged in user
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }else{
        //not logged in
        return false;
    }
}

//Display the image for any post at "any" size (small, medium or large)
function display_post_image( $post_id, $size = 'medium' ){
    global $db;
    $sql = "SELECT image, title
            FROM posts 
            WHERE post_id = $post_id
            LIMIT 1";
    $result = $db->query( $sql );
    if( ! $result ){
        echo $db->error;
    }
    if( $result->num_rows >= 1 ){
        $row = $result->fetch_assoc();
        //display the image
        $url = 'uploads/' . $row['image'] . '_' . $size . '.jpg';
        $alt = $row['title'];
        echo "<img src='$url' alt='$alt' class='$size'>";
    }
}

//form input helpers - checkboxes and dropdowns
function checked( $a, $b ){
    if( $a == $b ){
        echo 'checked';
    }
}

function selected( $a, $b ){
    if( $a == $b ){
        echo 'selected';
    }
}


//Count the number of approved comments on any post
function count_comments( $post_id = 0 ){
    //get the DB connection from outside the function
    global $db;
    //sql
    $sql = "SELECT post_id, COUNT(*) AS total
            FROM comments
            WHERE post_id = $post_id
            AND is_approved = 1";
    //run it
    $result = $db->query($sql);
    //check it
    if( $result->num_rows >= 1 ){
        //loop it (output)
        while( $row = $result->fetch_assoc() ){
            $total = $row['total'];

            if( $total == 1 ){
                echo '1 Comment';
            }else{
                echo $total . ' Comments';
            }
            
        }
        //free it
        $result->free();
    }
    
}

//Count all the likes on any post
function count_likes( $post_id ){
    global $db;
    $sql = "SELECT COUNT(*) AS total_likes
            FROM likes
            WHERE post_id = $post_id";
    $result = $db->query( $sql );
    if( ! $result ){
        echo $db->error;
    }elseif( $result->num_rows >= 1 ){
        $row = $result->fetch_assoc();
        $total  = $row['total_likes'];

        //example of the ternary operator
        return $total == 1 ? '1 Like' : "$total Likes" ;
    }
}

//Like button interface
function like_interface( $post_id = 0, $user_id = 0 ){
    global $db;
    //is the user_id valid (logged in?)
    if( $user_id ){
        //does this user like this post?
        $sql = "SELECT * FROM likes
                WHERE user_id = $user_id
                AND post_id = $post_id
                LIMIT 1";
        $result = $db->query($sql);
        if( ! $result ){
            $class = 'not-liked';
        }elseif( $result->num_rows >= 1 ){
            $class = 'you-like';
        }else{
            $class = 'not-liked';
        }

    }//end if user_id
    ?>
    <span class="like-interface">
        <span class="<?php echo $class; ?>">
           
            <?php if( $user_id ){ ?>
            <span class="heart-button" data-postid="<?php echo $post_id; ?>" >❤</span>
            <?php } ?>

            <?php echo count_likes( $post_id ); ?>
        </span>
    </span>
    <?php
}