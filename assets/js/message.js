import { getNotifications } from "../app.js"
import { getMessages } from "../app.js"

$(document).ready(() => {
    const messages = document.querySelectorAll('.message-item')

    const checkAll = document.querySelector('#check-all')
    checkAll.addEventListener('click', () => selectAll())

    const deleteAll = document.querySelector('#delete-all-messages')
    deleteAll.addEventListener('click', () => deleteSelectedMessages())

    const createNew = document.querySelector('#new-message-button')
    createNew.addEventListener('click', () => createNewMessage())

    messages.forEach((item) => {
        const id = parseInt(item.id)

        const card = item.querySelector('.card')
        const messageCheck = item.querySelector('.message-check-container i')
        const eyeElement = item.querySelector('#eyeElement')
        const dateElement = item.querySelector('small')
        const starElement = item.querySelector('.fa-star')
        const trashElement = item.querySelector('.fa-recycle')

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((item) => {
                if (item.isIntersecting && eyeElement.classList.contains('fa-eye-slash') && eyeElement.style.display === 'none') {
                    markReadedMessage(id)
                    console.log('hola')
                }
                /* TODO FUNCIONA LO DE MARCAR LEIDO, PERO FALTA INDICARLE CUANDO LO ENVÍA, SE PODRÍA HACER DETECTANDO LA CLASE DEL OJO, PERO 
            */
            })
        })

        observer.observe(card)

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

        starElement?.addEventListener('click', () => {
            starElement.classList.toggle('fa-regular')
            starElement.classList.toggle('fa-solid')

            markImportantMessage(id)
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
                    checkAll.classList.add('d-none')
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

                getNotifications()
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

    const isDelete = (item) => document.getElementById(item.id) !== null

    const deletedMessages = selectedMessages.filter((item) => isDelete(item))
    const unDeletedMessages = selectedMessages.filter((item) => !isDelete(item))

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
                getNotifications()
            } else {
                console.log('Error al borrar los mensajes :(')
            }
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}

const markImportantMessage = async (id) => {
    await $.ajax({
        url: `/message/markImportantMessage/${id}`,
        type: 'PUT',
        success: (response) => {
            const message = document.getElementById(id)

            const { isImportant } = response

            const parameters = window.location.search;

            const newUrl = new URLSearchParams(parameters);

            const mode = newUrl.get('mode');

            if (mode === 'important') if (!isImportant) message.remove()

            getMessages()
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}

const markReadedMessage = async (id) => {
    await $.ajax({
        url: `/message/markReadedMessage/${id}`,
        type: 'PUT',
        success: () => {
            const message = document.getElementById(id)

            const eye = message.querySelector('i.fa-eye-slash')

            eye.classList.remove('fa-eye-slash')
            eye.classList.add('fa-eye')
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}

const createNewMessage = () => {
    window.location.href = '/message/create'
}