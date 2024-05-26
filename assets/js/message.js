import { getMessages } from "../app.js"

$(document).ready(() => {
    const messages = document.querySelectorAll('.message-item')

    const checkAll = document.querySelector('#check-all')
    checkAll.addEventListener('click', () => selectAll())

    const deleteAll = document.querySelector('#delete-all-messages')
    deleteAll.addEventListener('click', () => deleteSelectedMessages())

    messages.forEach((item) => {
        const id = parseInt(item.id)

        const card = item.querySelector('.card')
        const messageCheck = item.querySelector('.message-check-container i')
        const dateElement = item.querySelector('small')
        const trashElement = item.querySelector('.fa-recycle')

        const messagesSelected = JSON.parse(localStorage.getItem('selected-messages')) ?? []
        const isSelected = messagesSelected.find((item) => item.id === id)

        if (isSelected) changeSelected(card, messageCheck, dateElement, messagesSelected, deleteAll, checkAll)

        messageCheck.addEventListener('click', () => {
            const localMessages = JSON.parse(localStorage.getItem('selected-messages')) ?? []

            let element = localMessages.find((item) => item.id === id)
            let newLocalMessages = element === undefined
                ? (localMessages.push({ id }), localMessages)
                : deleteLocalSelected(localMessages, element)

            newLocalMessages.length !== 0 ? localStorage.setItem('selected-messages', JSON.stringify(newLocalMessages)) : localStorage.clear()

            changeSelected(card, messageCheck, dateElement, localMessages, deleteAll, checkAll)
        })

        trashElement.addEventListener('click', async () => {
            await deleteMessage(id)

            const localMessages = JSON.parse(localStorage.getItem('selected-messages')) ?? []

            let element = localMessages.find((item) => item.id === id)

            if (element !== undefined) {
                let newLocalMessages = deleteLocalSelected(localMessages, element)

                const { length } = newLocalMessages

                if (length !== 0) {
                    localStorage.setItem('selected-messages', JSON.stringify(newLocalMessages))

                } else {
                    localStorage.clear()
                    deleteAll.classList.add('disabled')
                }
            }

            getMessages()
        })
    })
})

const deleteLocalSelected = (localMessages, element) => {
    const indexOf = localMessages.findIndex((item) => item === element)

    localMessages.splice(indexOf, 1)

    return localMessages
}

const changeSelected = (card, messageCheck, dateElement, messages, deleteAll, checkAll) => {
    card.classList.toggle('selected')

    messageCheck.classList.toggle('fa-square')
    messageCheck.classList.toggle('fa-square-check')

    messageCheck.classList.toggle('fa-regular')
    messageCheck.classList.toggle('fa-solid')

    dateElement.classList.toggle('text-muted')
    dateElement.classList.toggle('text-light')

    if (messages.length === 0) {
        deleteAll.classList.add('disabled')

        checkAll.classList.add('d-none')
    } else {
        if (deleteAll.classList.contains('disabled')) {
            deleteAll.classList.remove('disabled')

            checkAll.classList.remove('d-none')
        }
    }
}

const selectAll = () => {
    const checkAll = document.querySelector('#check-all')
    const messages = document.querySelectorAll('.message-item')

    checkAll.classList.toggle('fa-square-check')
    checkAll.classList.toggle('fa-square')

    checkAll.classList.toggle('fa-regular')
    checkAll.classList.toggle('fa-solid')

    messages.forEach((item) => {
        const card = item.querySelector('.card')
        const messageCheck = item.querySelector('.message-check-container i')

        if (checkAll.classList.contains('fa-solid')) {
            if (!card.classList.contains('selected')) messageCheck.click()
        } else {
            messageCheck.click()
        }
    })
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

    /* const messages = selectedMessages.filter((item) => typeofdocument.getElementById(item.id) !== null) */

    const isDelete = (item) => document.getElementById(item.id) !== null

    const deletedMessages = selectedMessages.filter((item) => isDelete(item))
    const unDeletedMessages = selectedMessages.filter((item) => !isDelete(item))

    console.log(JSON.stringify(selectedMessages))

    await $.ajax({
        url: `/message/deleteSelectedMessages`,
        type: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify(deletedMessages),
        success: (response) => {
            if (response === '202') {
                const deleteAll = document.querySelector('#delete-all-messages')
                const checkAll = document.querySelector('#check-all')

                $(`.message-item:has(.card.selected)`).each((index, item) => item.remove())

                localStorage.setItem('selected-messages', JSON.stringify(unDeletedMessages))

                deleteAll.classList.add('disabled')
                checkAll.classList.add('d-none')

                getMessages()
            } else {
                console.log('Error al borrar los mensajes :(')
            }
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}