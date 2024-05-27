/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css'
import 'bootstrap'
import './styles/global.scss'
import $ from 'jquery'

$(document).ready(() => {
    const deleteAllNotificationsButton = document.getElementById('delete-all-notify')
    deleteAllNotificationsButton.addEventListener('click', (event) => {
        event.stopPropagation()

        deleteAllNotifications()
    })

    getNotifications()
    getMessages()
})

export const getNotifications = async () => {
    await $.ajax({
        url: '/notification',
        type: 'GET',
        success: (response) => {
            const data = JSON.parse(response)

            createNotifications(data)
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const deleteNotification = async (id) => {
    await $.ajax({
        url: `/notification/${id}`,
        type: 'DELETE',
        success: (data) => {
            /* alert('Borrao Picha') */
            getNotifications()
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const deleteAllNotifications = async () => {
    await $.ajax({
        url: `/notification`,
        type: 'DELETE',
        success: () => {
            console.log('e')
            getNotifications()
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const createNotifications = (data) => {
    const MESSAGE_TYPE = 'message'

    const { length } = data

    const getNotificationsElements = () => notifyContainer.querySelectorAll('.notify-element')

    const notifyContainer = document.querySelector('#notify-container')

    const notificationCount = document.querySelector('#notification-count')
    notificationCount.innerHTML = length > 99 ? '99+' : length

    getNotificationsElements().forEach((item) => item.remove())

    data = data.slice(0, 3)

    data.forEach((item) => {
        const {
            id,
            type,
            title,
            user_from,
            user_to,
            associated_id
        } = item

        const isMail = type === MESSAGE_TYPE

        const headerNotify = isMail ? 'Nuevo Mensaje' : 'Nueva Publicación'
        const notifyType = isMail ? 'message' : 'news'

        const iconClassName = isMail ? 'fa-envelope-open-text' : 'fa-newspaper'

        const a = document.createElement('a')
        a.setAttribute('href', `/${notifyType}#${associated_id}`)

        const li = document.createElement('li')
        li.classList.add('notify-element')

        const container = document.createElement('div')
        container.classList.add('dropdown-item')

        const iconType = document.createElement('i')
        iconType.classList.add('fa-solid', iconClassName)

        const messageContainer = document.createElement('div')
        messageContainer.classList.add('d-flex', 'flex-column', 'content-notify')

        const typeMessage = document.createElement('span')
        typeMessage.classList.add()
        typeMessage.innerHTML = `<b>${headerNotify}</b>`

        const titleMessage = document.createElement('span')
        titleMessage.innerHTML = `<b>${title}</b>`

        const fromMessage = document.createElement('span')
        fromMessage.innerHTML = `<b>${user_from}</b>`

        const deleteContainer = document.createElement('div')
        deleteContainer.classList.add('delete-notify')
        deleteContainer.addEventListener('click', (event) => {
            event.stopPropagation()
            event.preventDefault()

            deleteNotification(id)
        })

        const iconDelete = document.createElement('i')
        iconDelete.classList.add('fa-solid', 'fa-recycle')

        deleteContainer.appendChild(iconDelete)

        messageContainer.appendChild(typeMessage)
        messageContainer.appendChild(titleMessage)
        messageContainer.appendChild(fromMessage)

        container.appendChild(iconType)
        container.appendChild(messageContainer)
        container.appendChild(deleteContainer)

        li.appendChild(container)
        
        a.appendChild(li)

        notifyContainer.appendChild(a)
    })

    if (getNotificationsElements().length === 0) {
        const li = document.createElement('li')
        li.classList.add('notify-element')

        const empty = document.createElement('div')
        empty.classList.add('p-3', 'dropdown-item')

        const emptyText = document.createElement('b')
        emptyText.innerHTML = 'Sin Notificaciones :('

        empty.appendChild(emptyText)
        li.appendChild(empty)
        notifyContainer.appendChild(li)
    }
}

export const getMessages = async () => {
    await $.ajax({
        url: `/message/count`,
        type: 'GET',
        success: (response) => {
            console.log(response)
            const data = JSON.parse(response)

            createMessages(data)
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const createMessages = (data) => {
    const allMessageCount = document.querySelector('#all_message_count')
    allMessageCount.innerHTML = data.all + data.send

    const inboxMessageCount = document.querySelector('#inbox_message_count')
    inboxMessageCount.innerHTML = data.all

    const removedMessageCount = document.querySelector('#removed_message_count')
    removedMessageCount.innerHTML = data.removed

    const importantMessageCount = document.querySelector('#important_message_count')
    importantMessageCount.innerHTML = data.important

    const sendMessageCount = document.querySelector('#send_message_count')
    sendMessageCount.innerHTML = data.send
}