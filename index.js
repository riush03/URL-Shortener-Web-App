//selecting all the required elements
const form = document.querySelector(".wrapper form"),
      longUrl = form.querySelector("input"),
      shortenBtn = form.querySelector("button"),
      blurEffect = document.querySelector(".blurr-effect"),
      whatPoppin = document.querySelector(".popup-modal"),
      shortenUrl = whatPoppin.querySelector("input");

form.onsubmit = (e) => {
    e.preventDefault();
}

shortenBtn.onclick = () =>{
    //creating ajax object
    let xhr = new XMLHttpRequest();
    xhr.open("POST","./url-control.php",true);
    xhr.onload = () =>{
        if(xhr.readyState == 4 && xhr.status == 200){
            let data = xhr.response;
            if(data.length <= 5){
                blurEffect.style.display = "block";
                whatPoppin.classList.add("show");

                let domain = "localhost/url?u=";
                shortenUrl.value = domain + data;
            }else{
                alert(data)
            }
        }
    }
    //send form data to php file
    let formData = new FormData();
    xhr.send(formData);
}