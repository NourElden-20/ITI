function showmess() {
    var message = "Hello, this is a message!";
    let i = 0;
    let msgWindow = window.open("message.html", "msgWindow");
    let id = setInterval(function () {
        if (i < message.length) {
            msgWindow.document.write(message[i]);
            i++;
        } else {
            clearInterval(id);
        }
    }, 200);
}

function scrolll() {
    let msgWindow = window.open("scroll.html", "", "width=100,height=100");
    let scrolldelay = setInterval(function () {
        msgWindow.scrollTo({
            top: msgWindow.document.body.scrollHeight,
            left: 0,
            behavior: "smooth"
            

        });

    }, 100);
    // clearInterval(scrolldelay);
    // Optionally, you can clearInterval when reaching the end if needed
    // clearInterval(scrolldelay);


}

