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

$(document).ready(() => getNotifications())

const getNotifications = async () => {
    await $.ajax({
        url: '/notification',
        type: 'GET',
        success: (response) => {
            const data = JSON.parse(response)

            console.log(data)

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
            console.log(data)
            getNotifications()
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}

const createNotifications = (data) => {
    const notifyContainer = document.querySelector('#notify-container')

    const notifications = notifyContainer.querySelectorAll('.notify-element')

    const { length } = notifications

    for (let i = 0; i < length; i++) notifications[i].remove()

    data.forEach((item) => {
        const {
            id,
            type,
            title,
            user_from,
            user_to
        } = item

        const isMail = type === 'email'

        const headerNotify = isMail ? 'Nuevo Mensaje' : 'Nueva Publicación'

        const iconClassName = isMail ? 'fa-envelope-open-text' : 'fa-newspaper'

        const li = document.createElement('li')
        li.classList.add('notify-element')

        const container = document.createElement('div')
        container.classList.add('d-flex', 'align-items-center', 'dropdown-item')

        const iconType = document.createElement('i')
        iconType.classList.add('fa-solid', iconClassName)

        const messageContainer = document.createElement('div')
        messageContainer.classList.add('d-flex', 'flex-column', 'content-notify')

        const typeMessage = document.createElement('span')
        typeMessage.innerHTML = `<b>${headerNotify}</b>`

        const titleMessage = document.createElement('span')
        titleMessage.innerHTML = `<b>${title}</b>`

        const fromMessage = document.createElement('span')
        fromMessage.innerHTML = `<b>${user_from}</b>`

        const deleteContainer = document.createElement('div')
        deleteContainer.classList.add('delete-notify')
        deleteContainer.addEventListener('click', (event) => {
            event.stopPropagation()

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

        notifyContainer.appendChild(li)
    })

    if(notifyContainer.childNodes.length === 1){
        const empty = document.createElement('li')
        empty.innerHTML = 'Sin Notificaciones'

        notifyContainer.appendChild(empty)
    }
}