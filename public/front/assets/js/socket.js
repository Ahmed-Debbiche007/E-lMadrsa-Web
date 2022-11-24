const socket = new WebSocket('ws://localhost:3001')

socket.addEventListener('open', function () {
    console.log('CONNECTED')
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
    if (document.getElementsByClassName("chatbox")[0].style.display === "none") {
        document.getElementById('notification').style.display = 'block';
    }
}

socket.addEventListener('message', function (e) {
    try {
        const message = JSON.parse(e.data)
        addMessage(message.name, message.message)
    } catch (e) {
        // Catch any errors
    }
})

document.getElementById('sendbtn').addEventListener('click', function () {
    const message = {
        idSender: document.getElementById('send').value,
        message: document.getElementById('input-default').value
    }
    document.getElementById('input-default').value = ""
    socket.send(JSON.stringify(message))
    addMessage(message.idSender, message.message)
})