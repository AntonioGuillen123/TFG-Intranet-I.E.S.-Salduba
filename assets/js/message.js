import { getMessages } from "../app.js"

$(document).ready(() => {
    const messages = document.querySelectorAll('.message-item')

    messages.forEach((item) => {
        const id = parseInt(item.id)

        const card = item.querySelector('.card')
        const messageCheck = item.querySelector('.message-check-container i')
        const dateElement = item.querySelector('small')
        const trashElement = item.querySelector('.fa-recycle')
        const deleteAll = document.querySelector('#delete-all-messages')

        deleteAll.addEventListener('click', () => deleteSelectedMessages())

        const messagesSelected = JSON.parse(localStorage.getItem('selected-messages')) ?? []
        const isSelected = messagesSelected.find((item) => item.id === id)

        if (isSelected) changeSelected(card, messageCheck, dateElement, messagesSelected, deleteAll)

        messageCheck.addEventListener('click', () => {
            const localMessages = JSON.parse(localStorage.getItem('selected-messages')) ?? []

            let element = localMessages.find((item) => item.id === id)

            if (element === undefined) {
                localMessages.push({ id })
            } else {
                const indexOf = localMessages.findIndex((item) => item === element)

                localMessages.splice(indexOf, 1)
            }

            localMessages.length !== 0 ? localStorage.setItem('selected-messages', JSON.stringify(localMessages)) : localStorage.clear()

            changeSelected(card, messageCheck, dateElement, localMessages, deleteAll)
        })

        trashElement.addEventListener('click', async () => {
            await deleteMessage(id)

            getMessages()
        })
    })
})

const changeSelected = (card, messageCheck, dateElement, messages, deleteAll) => {
    card.classList.toggle('selected')

    messageCheck.classList.toggle('fa-square')
    messageCheck.classList.toggle('fa-square-check')

    messageCheck.classList.toggle('fa-regular')
    messageCheck.classList.toggle('fa-solid')

    dateElement.classList.toggle('text-muted')
    dateElement.classList.toggle('text-light')

    if (messages.length === 0) {
        deleteAll.classList.add('disabled')
    } else {
        if (deleteAll.classList.contains('disabled')) deleteAll.classList.remove('disabled')
    }
}

const deleteMessage = async (id) => {
    await $.ajax({
        url: `/message/${id}`,
        type: 'DELETE',
        success: (response) => {
            if (response === '202') {
                $(`#${id}`).remove()
            } else {
                console.log('Error al borrar el mensaje :(')
            }
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const deleteSelectedMessages = async () => {
    const selectedMessages = JSON.parse(localStorage.getItem('selected-messages'))

    console.log(1)

    await $.ajax({
        url: `/message/deleteSelectedMessages`,
        type: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify(selectedMessages),
        success: (response) => {
            console.log(response)
           /*  if (response === '202') {
                const deleteAll = document.querySelector('#delete-all-messages')

                $(`.card.selected`).each((item) => item.remove())

                localStorage.clear()

                deleteAll.classList.add('disabled')
            } else {
                console.log('Error al borrar los mensajes :(')
            } */
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}