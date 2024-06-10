import { getQueryParams, formatDateToSpanish } from '../app.js'

const tailwindConfig = require('../../tailwind.config.js');

const tailwindColors = tailwindConfig.theme.colors

const colors = Object.entries(tailwindColors)
    .filter(([key, value]) => typeof value === 'object')
    .map(([key, value]) => value['400'])

const EPOCHNEXTDAY = 86400

const months = {
    0: 'Enero',
    1: 'Febrero',
    2: 'Marzo',
    3: 'Abril',
    4: 'Mayo',
    5: 'Junio',
    6: 'Julio',
    7: 'Agosto',
    8: 'Septiembre',
    9: 'Octubre',
    10: 'Noviembre',
    11: 'Diciembre'
}

const reversedMonths = {
    'Enero': 0,
    'Febrero': 1,
    'Marzo': 2,
    'Abril': 3,
    'Mayo': 4,
    'Junio': 5,
    'Julio': 6,
    'Agosto': 7,
    'Septiembre': 8,
    'Octubre': 9,
    'Noviembre': 10,
    'Diciembre': 11
};

let userColors = {}

let arrowEvents = []

const saveHandlers = (number) => () => getRenderBookings(number)

const dayEventListeners = new Map()

function handleDayClick(dayCopy) {
    return () => {
        makeModal(dayCopy);
    };
}

$(document).ready(() => {
    const todayButton = document.querySelector('#today-button')
    todayButton.addEventListener('click', () => getRenderBookings(0))

    getDatesOfMonth()

    const successButton = document.querySelector('.btn-success')
    successButton.addEventListener('click', () => makeBooking())
})

const getDatesOfMonth = (id) => {
    const actualDate = new Date()

    if (id) {
        actualDate.setMonth(actualDate.getMonth() + id)
    } else {
        id = 0
    }

    const headArrows = document.querySelectorAll('div.buttons button.p-1')
    headArrows.forEach((item, index) => {
        const event = arrowEvents[index]

        if (event) item.removeEventListener('click', event)

        const number = index === 0 ? id - 1 : id + 1
        const handler = saveHandlers(number)

        item.addEventListener('click', handler)

        arrowEvents[index] = handler
    })

    const date = actualDate
    const year = date.getFullYear()
    const monthIndex = date.getMonth()
    const month = months[monthIndex]

    const firstOfTheMonth = new Date(year, monthIndex, 1)
    const firstDay = firstOfTheMonth.getDay()
    const firstEpoch = firstOfTheMonth.getTime() / 1000

    const epochMultiply = firstDay !== 0 ? firstDay - 1 : 6
    const epochMinus = EPOCHNEXTDAY * epochMultiply

    let newDate = new Date((firstEpoch - epochMinus) * 1000)
    let newDateDay = newDate.getDate()

    const yearMonth = document.querySelector('#year-month')
    yearMonth.innerHTML = `${year} ${month}`

    printCalendary(newDate, newDateDay, monthIndex)
}

const printCalendary = (newDate, newDateDay, monthIndex) => {
    const actualDate = new Date()

    for (let weekIndex = 1; weekIndex <= 6; weekIndex++) {
        for (let dayIndex = 1; dayIndex <= 7; dayIndex++) {
            const newDateDayOfWeek = newDate.getDay()

            const isWeekEnd = newDateDayOfWeek === 0 || newDateDayOfWeek === 6

            const dayCopy = newDate
            const day = document.querySelector(`#day-${weekIndex}-${dayIndex}`)

            if (dayEventListeners.has(day)) day.removeEventListener('click', dayEventListeners.get(day))

            if (!isWeekEnd) {
                day.setAttribute('data-bs-toggle', 'modal')
                day.setAttribute('data-bs-target', '#booking-modal')
                const event = handleDayClick(dayCopy)
                dayEventListeners.set(day, event)

                day.addEventListener('click', event)
            }

            const calendaryDay = day.querySelector('.calendary-day')
            calendaryDay.classList.add(isWeekEnd ? 'cursor-default' : 'cursor-pointer')

            const cell = day.querySelector(`.day-number`)
            cell.textContent = newDateDay

            day.classList.remove('hover:bg-gray-300')
            day.classList.remove('bg-gray-300')
            day.classList.remove('bg-blue-300')

            let dayBg
            let dayHoverBg

            if (newDate.getMonth() === monthIndex) {
                dayBg = newDate.getDate() === actualDate.getDate()
                    && newDate.getMonth() === actualDate.getMonth() ? 'bg-blue-300' : 'bg-white-300'

                dayHoverBg = 'hover:bg-gray-300'
            } else {
                dayBg = 'bg-gray-300'

                dayHoverBg = 'hover:bg-gray-100'
            }

            day.classList.add(dayBg)
            day.classList.add(dayHoverBg)

            const bookingsOfTheDay = searchDay(newDate)

            const bookingsContainer = day.querySelector('.bookings-container')
            bookingsContainer.innerHTML = ''

            if (bookingsOfTheDay) {
                bookingsOfTheDay.forEach((item) => {
                    const remitent = item.user_from

                    const bookingColor = userColors[remitent] ?? (userColors[remitent] = generateUserColor(), userColors[remitent])

                    const div = document.createElement('div')
                    div.classList.add('event', 'text-white', 'rounded', 'p-1', 'text-sm', 'mb-1', 'text-start')
                    div.style.backgroundColor = bookingColor

                    const bookingName = document.createElement('span')
                    bookingName.classList.add('name', 'font-bold', 'text-dark')
                    bookingName.innerHTML = `Reserva ${item.resource_type}`

                    const bookingResourceName = document.createElement('span')
                    bookingResourceName.classList.add('resource')
                    bookingResourceName.innerHTML = `<b>Nombre: </b> ${item.resource_name}`

                    const bookingTime = document.createElement('span')
                    bookingTime.classList.add('time')
                    bookingTime.innerHTML = `<b>Hora: </b> ${item.horary}`

                    const bookingRemitent = document.createElement('span')
                    bookingRemitent.classList.add('remitent', 'text-muted')
                    bookingRemitent.innerHTML = `<b>Reservado Por: </b> ${remitent}`

                    const br = document.createElement('br')
                    const br2 = document.createElement('br')
                    const br3 = document.createElement('br')

                    div.appendChild(bookingName)
                    div.appendChild(br)
                    div.appendChild(bookingResourceName)
                    div.appendChild(br2)
                    div.appendChild(bookingTime)
                    div.appendChild(br3)
                    div.appendChild(bookingRemitent)

                    bookingsContainer.appendChild(div)
                })
            }

            newDate = new Date(newDate.getTime() + (EPOCHNEXTDAY * 1000))
            newDateDay = newDate.getDate()
        }
    }
}

const searchDay = (date) => {
    const bookingsOfTheDay = bookings.filter((item) => {
        const bookingDate = item.booking_date.split(' ')

        const day = date.getDate()
        const month = date.getMonth() + 1
        const year = date.getFullYear()

        const formatedDay = day < 10 ? '0' + day : day
        const formatedMonth = month < 10 ? '0' + month : month

        const fullDate = `${formatedDay}-${formatedMonth}-${year}`

        return fullDate === bookingDate[0]
    })

    bookingsOfTheDay.sort((a, b) => {
        const dateA = formatDateToSpanish(a.booking_date)
        const dateB = formatDateToSpanish(b.booking_date)

        return dateA - dateB
    })

    return bookingsOfTheDay
}

const generateUserColor = () => {
    const { length } = colors

    const rnd = Math.floor(Math.random() * length)

    const color = colors[rnd]

    colors.splice(rnd, 1)

    return color
}

const makeModal = async (bookingDate) => {
    const modal = document.querySelector('.modal')

    const resourceTypeContainer = document.querySelector('#resource-type-container > div')
    const resourceContainer = document.querySelector('#resource-container > div')
    const bookingDateContainer = document.querySelector('#booking-date > div')

    resourceTypeContainer.innerHTML = ''
    resourceContainer.innerHTML = ''
    bookingDateContainer.innerHTML = ''

    const modalLabel = document.querySelector('#booking-modal-label')
    modalLabel.innerHTML = `Reservar Recurso - ${bookingDate.getDate()} De ${months[bookingDate.getMonth()]} De ${bookingDate.getFullYear()}`

    const resourceTypes = await getResourceTypes()

    const selectType = document.createElement('select')
    selectType.classList.add('form-select', 'cursor-pointer')
    selectType.addEventListener('change', async (event) => {
        const value = event.target.value

        const resourcesFromType = await getResourceFromType(value)

        selectName.innerHTML = ''

        makeSelect(resourcesFromType, selectName)
    })

    makeSelect(resourceTypes, selectType)

    const resources = await getResourceFromType(selectType.value)

    const selectName = document.createElement('select')
    selectName.classList.add('form-select', 'cursor-pointer')
    selectName.addEventListener('change', async (event) => {
        const dateSchedule = getDateFromModal()

        const value = event.target.value

        const scheduleFromResource = await getScheduleFromResource(dateSchedule, value)

        selectTime.innerHTML = ''

        makeSelect(scheduleFromResource, selectTime)
    })

    makeSelect(resources, selectName)

    const schedule = await getScheduleFromResource(bookingDate, selectName.value)

    const selectTime = document.createElement('select')
    selectTime.classList.add('form-select', 'cursor-pointer')

    makeSelect(schedule, selectTime)

    resourceTypeContainer.appendChild(selectType)
    resourceContainer.appendChild(selectName)
    bookingDateContainer.appendChild(selectTime)
}

const getDateFromModal = () => {
    const modalLabel = document.querySelector('#booking-modal-label')

    const contentDate = modalLabel.innerHTML.split(' ')

    const year = contentDate[7]
    const month = reversedMonths[contentDate[5]]
    const day = contentDate[3]

    return new Date(year, month, day)
}

const makeSelect = (elements, select) => {
    elements.forEach((item) => {
        const option = document.createElement('option')
        option.value = item.id
        option.innerHTML = item.name

        select.appendChild(option)
    })
}

const getRenderBookings = async (id) => {
    await $.ajax({
        url: `/booking/${id}`,
        type: 'POST',
        success: (response) => {
            bookings = response.content

            getDatesOfMonth(response.month)
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}

const getResourceTypes = async () => {
    let result = []

    await $.ajax({
        url: `/booking/getResourceTypes`,
        type: 'GET',
        success: (response) => {
            result = response.resourceTypes
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })

    return result
}

const getResourceFromType = async (id) => {
    let result = []

    await $.ajax({
        url: `/booking/getResourceFromType/${id}`,
        type: 'GET',
        success: (response) => {
            console.log(response.resources)
            result = response.resources
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })

    return result
}

const getScheduleFromResource = async (bookingDate, id) => {
    let result = []
    const month = bookingDate.getMonth() + 1
    const day = bookingDate.getDate()

    const dateFormat = `${bookingDate.getFullYear()}-${month < 10 ? `0${month}` : month}-${day < 10 ? `0${day}` : day}`
    console.log(bookingDate)
    console.log(dateFormat)

    await $.ajax({
        url: `/booking/getScheduleFromResource`,
        type: 'POST',
        headers: 'Content-Type: application/json',
        data: {
            'resourceID': parseInt(id),
            'date': dateFormat
        },
        success: (response) => {
            console.log(response)

            result = response.schedule
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })

    return result
}

const makeBooking = async () => {
    const dateFromModal = getDateFromModal()
    const date = dateFromModal.toLocaleDateString('sv-SE')
    const resourceID = document.querySelector('#resource-container select').value
    const bookingDateID = document.querySelector('#booking-date select').value

    console.log(date)

    await $.ajax({
        url: `/booking/makeBooking`,
        type: 'POST',
        headers: 'Content-Type: application/json',
        data: {
            'resourceID': parseInt(resourceID),
            'date': date,
            'bookingDateID': parseInt(bookingDateID)
        },
        success: (response) => {
            const actualDate = new Date()
            const actualMonth = actualDate.getMonth() + 1
            const month = dateFromModal.getMonth() + 1

            getRenderBookings((month - actualMonth))
            makeModal(dateFromModal)
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}