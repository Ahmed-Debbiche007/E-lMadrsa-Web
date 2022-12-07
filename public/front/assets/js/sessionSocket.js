const socket = new WebSocket('ws://localhost:3001')

socket.addEventListener('open', function () {

})

function addMessage(id, message) {
    const justify = document.createElement('div')
    const msg = document.createElement('div')
    const p = document.createElement('p')
    var user = document.getElementById('receive').value;


    if (id == user) {
        justify.className = 'd-flex flex-row justify-content-end pt-1'
        msg.className = 'message message-sent'
        p.className = 'small p-2 me-3 mb-1 text-white rounded-3'
    } else {
        justify.className = 'd-flex flex-row justify-content-start'
        msg.className = 'message message-received'
        p.className = 'small p-2 ms-3 mb-1 rounded-3'
    }
    p.innerHTML = message
    msg.append(p)
    justify.append(msg)
    document.getElementById('messages-card').append(justify);

}

socket.addEventListener('message', function (e) {
    e.preventDefault();
    try {
        const message = JSON.parse(e.data)
        if (message.message != "") {
            url = "http://localhost:5000/front/assets/js/notification.mp3"
            $.get(url)
                .done(function () {
                    audio = new Audio(url);
                    audio.loop = false;
                    audio.play();
                }).fail(function () {
                    console.log("uuuuuuup")
                })

            var user = document.getElementById('receive').value;
            if (message.idSender != user) {
                addMessage(message.idSender, message.message)
            }
        }

    } catch (e) {
        // Catch any errors
    }
})

document.getElementById('sendbtn').addEventListener('click', function () {
    const message = {
        idSender: document.getElementById('send').value,
        message: document.getElementById('input-default').value,
        idSession: document.getElementById('idSession').value,
    }
    document.getElementById('input-default').value = ""
    socket.send(JSON.stringify(message))

    if (message.message != "") {
        addMessage(message.idSender, message.message)
        try {
            return axios.post("/dashboard/messages/api/post", {
                idSession: message.idSession,
                body: message.message
            });
        } catch (error) {
            console.log(error);
        }
    }

})

document.getElementById("input-default").addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        const message = {
            idSender: document.getElementById('send').value,
            message: document.getElementById('input-default').value,
            idSession: document.getElementById('idSession').value,
        }
        document.getElementById('input-default').value = ""
        socket.send(JSON.stringify(message))

        if (message.message != "") {
            addMessage(message.idSender, message.message)
            try {
                return axios.post("/dashboard/messages/api/post", {
                    idSession: message.idSession,
                    body: message.message
                });
            } catch (error) {
                console.log(error);
            }
        }

    }
});