<?php

include './config.php';

$full_url = mysqli_real_escape_string($conn,$_POST['full-url']);

if(!empty($full_url) && filter_var($full_url,FILTER_VALIDATE_URL)){
    $ran_url = substr(md5(microtime()),rand(0,26),5);

    //check if the random generated url if is already exist in the database
    $sql = mysqli_query($conn,"SELECT shorten_url FROM url WHERE shorten_url = {$ran_url}");
    if(mysqli_num_rows($sql)>0){
        echo "Something went wrong please regenerate url again";
    }else{
        $sql_typed_url = mysqli_query($conn,"INSERT INTO url (shorten_url,full_url,clicks)
                                              VALUES ('{$ran_url}'),'{$full_url}','0'");
        if($sql_typed_url){
            $sql_3 = mysqli_query($conn,"SELECT shorten_url FROM url WHERE shorten_url = {$ran_url}");
            if(mysqli_num_rows($sql)>0){
                $shorten_url = mysqli_fetch_assoc($sql_3);
                echo $shorten_url['shorten_url'];
            }
        }else{
            echo "Something went wrong.Please try again!";
        }
    }
}else{
    echo "$full_url - This is not a valid url";
}
?>