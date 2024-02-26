<div class="usernav" style="background-color: #013220e0;"> 

    <?php
        $sql2 = "SELECT COUNT(*) AS count FROM friendship 
                 WHERE friendship.user2_id = {$_SESSION['user_id']} AND friendship.friendship_status = 0";
        $query2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($query2);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>  
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

    *{
        margin: 0;
        padding: 0;
        scroll-behavior: smooth;
        list-style-type: none;
        font-family: 'Arial', sans-serif;
    } 
    html{
        overflow-x: hidden;
    }
    div .usernav {
        width: 100%;
        height: 5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: green;
        z-index: 1000;
        padding: 0;
    }
    .usernav ul li a:hover{
        color: #49d9e1;
        background-color:#112920d1;
        transition: .5s ease;
    }

    .usernav ul {
        padding: 5px;
        list-style-type: none;
        padding: 0;
    }

    .usernav ul li {
        display: inline-flex;
    }

    .usernav ul li a {
        color: white;
        text-decoration: none;
        padding: 5px 23px;
        border-radius: 5px;
        transition: 0.3s ease; 
        box-shadow: 0.1rem 0.3rem 0.2rem rgb(29 93 45 / 59%);
    }

    .globalsearch {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: green;
    }
    .fLinks{
        width: 100%;
        display: flex;
        justify-content: center;
        
        padding-top: 2rem;
    }
   #querybutton{
    background-color: #0e4906e3;
    border-radius: 10px;
    color: #2ee771;
   }
   #querybutton:hover{
    background-color: #08331b;
    color: #2ee7c6;
    transition: .5s ease;
   }

   @media(max-width:600px){
    .globalsearch{
        height: 5rem;
    }
    .globalsearch .form {
        margin: auto;
        display: block;
        
    }
    .fLinks{
        display: none;
    }
   }
   @media(max-width:400px){
    .globalsearch .form {
        margin: auto;
        display: flex;
        flex-direction: column-reverse;
    }
    .fLinks{
        display: none;
    }
    .globalsearch{
        height: 6.5rem;
    }
   }
/*Responsive Menu*/
.icon-bar{
    display: none;
}

@media(max-width:600px){
.icon-bar {
    display:flex;
    position: -webkit-sticky;
    position: sticky;
    top:0;
    left: 0;
    display: flex;
    justify-content:space-around;
    align-items:center;
    width: 100%; 
   
}

.icon-bar a {
  float: left;
  width: 10%;
  text-align: center;
  padding: 10px 0;
  transition: all 0.5s ease;
  color: #00f5fdf7;
  font-size: 24px;
}

.icon-bar a:hover {
  background-color:#007349e3;
  border-radius: 10px;
  
}

.icon-bar {
  background-color: #013220c4;

}
}


</style>
    <ul class="fLinks"> <!-- Ensure there are no enter escape characters.-->
       
        <li>
            <a href="home.php">Home</a>
        </li>
        <li>
            <a href="friends.php">Friends</a>
        </li>
        <li>
            <a href="requests.php">Friend Requests (<?php echo $row['count'] ?>)</a>
        </li
        ><li>
            <a href="profile.php">Profile</a>
        </li>
        <li>
            <a href="logout.php">Log Out</a>
        </li>
    </ul>
    <div class="globalsearch "style="background-color: #013220;">
        <form class="form d-flex align-items-center" method="get" action="search.php" onsubmit="return validateField()"> 
            <select name="location" class="selection mb-2 text-center" style="background-color:#0c4609; color:#e9ecef; border:2px solid #2a7325; margin:0 10px 0 0;">
                <option value="emails">Emails</option>
                <option value="names">Names</option>
                <option value="hometowns">Hometowns</option>
                <option value="posts">Posts</option>
            </select>
            <input class="d-flex mb-2 text-center" type="text" placeholder="Search" name="query" id="query" style="background-color:#71c9a9c2; border-radius:20px;">
            <input type="submit" value="GO" id="querybutton" style="padding:0 10px 0 10px; margin-left:10px; font-weight:bold;" class="mb-2">
        </form>
    </div>
</div>

<!--responsive Navbar-->
<div class="icon-bar">
  <a href="home.php"><i class='bx bx-home' ></i></a> 
  <a href="friends.php"><i class='bx bx-user-pin'></i></a> 
  <a href="requests.php"><i class='bx bx-comment-dots' ></i></a> 
  <a href="profile.php"><i class='bx bx-user'></i></a>
  <a href="logout.php"><i class='bx bx-log-out' ></i></a> 
</div>

<script>
function validateField(){
    var query = document.getElementById("query");
    var button = document.getElementById("querybutton");
    if(query.value == "") {
        query.placeholder = 'Type something!';
        return false;
    }
    return true;
}
</script>

