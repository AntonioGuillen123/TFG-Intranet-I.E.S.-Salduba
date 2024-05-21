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

$(document).ready(async () => {
    const notifyContainer = document.querySelector('#notify-container')
    let data = ''

    await $.ajax({
        url: '/notification',
        type: 'GET',
        success: (response) => {
            const data = JSON.parse(response)
            createNotifications(data)
            console.log(data[0]) 

            data.forEach((item) => {
                console.log('hola')
                console.log(item)
            })
        },
        error: (err) => {
            console.log('Error :(')
        }
    })

    console.log(data)

    // alert('hola')
})

const createNotifications = (data) => {
    data.forEach((item) => {
        const li = document.createElement('li')

        const container = document.createElement('div')
        container.classList.add('d-flex', 'align-items-center', 'dropdown-item')
    })
}