<?php
include './config.php';
   if(isset($_GET['u'])){
    $u = mysqli_real_escape_string($conn,$_GET['u']);

    $sql = mysqli_query($conn,"SELECT full_url FROM url WHERE shorten_url = '{$u}'");
    if(mysqli_num_rows($sql)>0){
        $full_url = mysqli_fetch_assoc($sql);
        header("Location:".$full_url['full_url']);
    }
   }
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>URL Shortener</title>
        <!--- CSS FILES GOES HERE-->
        <link rel="stylesheet" href="./style.css">
        <!--- ICON FILES GOES HERE-->
        <!--- FONT FILE GOES HERE-->
    </head>
    <body>
        <div class="wrapper">
            <form action="#">
                <input type="text" name="full-url" placeholder="Enter or paste you url" required/>
                <i class=""></i>
                <button>Shorten</button>
            </form>
            <?php
                  $sql2 = mysqli_query($conn,"SELECT * FROM url ORDER BY id DESC");
                  if(mysqli_num_rows($sql2)>0){
                    
                ?>
            <div class="count">
                <span>Total links<span>10</span> & total links.</span>
                <a href="#">Clear All</a>
            </div>

            <div class="urls-area">
               
                <div class="title">
                    <li>Shorten URL</li>
                    <li>Original URL</li>
                    <li>Clicks</li>
                    <li>Action</li>
                </div>
                <?php
            while($row = mysqli_fetch_assoc($sql2)){
                ?>
                 <div class="data">
                    <li>
                        <a href="#">
                            <?php 
                            if('localhost/url?u=' .$row['shorten_url'] >50){
                                echo 'localhost/url?u='.substr($row['shorten_url'],0,50,'...');
                            }else{
                                echo 'localhost/url?u='.$row['shorten_url'];
                            }
                            ?>
                        </a>
                    </li>
                    <li>
                    <?php 
                            if(strlen($row['shorten_url']) >65){
                                echo substr($row['full_url'],0,65,'...');
                            }else{
                                echo $row['full_url'];
                            }
                            ?>
                    </li>
                    <li><?php echo $row['clicks'] ?></li>
                    <li><a href="#">Delete</a></li>
                </div>
    
           
            <?php
            }
              }
            ?>
            </div>
        </div>

        <div class="blurr-effect"></div>
        <div class="popup-modal">
            <div class="info-box">
                Your shorted url is now ready. You can copt it and share everywhere across the internet more secure now.
                </div>
                <form action="#">
                    <label>Edit your shortened url</label>
                    <input type="text" spellcheck="false" value="example.com/data">
                    <i class="copy-icon"></i>
                    <button>Save</button>
                </form>
        </div>
        
        <script src="./index.js"></script>
    </body>
</html> 