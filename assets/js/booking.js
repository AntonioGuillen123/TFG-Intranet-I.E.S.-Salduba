$(document).ready(() => {
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

    const EPOCHNEXTDAY = 86400

    const date = new Date()
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

    for (let weekIndex = 1; weekIndex <= 6; weekIndex++) {
        for (let dayIndex = 1; dayIndex <= 7; dayIndex++) {
            const day = document.querySelector(`#day-${weekIndex}-${dayIndex}`)
            const cell = day.querySelector(`.day-number`)
            cell.textContent = newDateDay

            day.classList.add(newDate.getMonth() === monthIndex ? 'hover:bg-gray-300' : 'bg-gray-300')

            const bookingOfTheDay = searchDay(newDate)

            if (bookingOfTheDay) {

                const bookingsContainer = day.querySelector('.bookings-container')

                const div = document.createElement('div')
                div.classList.add('event', 'bg-purple-400', 'text-white', 'rounded', 'p-1', 'text-sm', 'mb-1')
            
                const bookingName = document.createElement('div')
                bookingName.classList.add('event-name')
                bookingName.innerHTML = bookingOfTheDay.resource_name

                const bookingTime = document.createElement('div')
                bookingTime.classList.add('time')
                bookingTime.innerHTML = bookingOfTheDay.booking_date.split(' ')[1]

                div.appendChild(bookingName)
                div.appendChild(bookingTime)
                bookingsContainer.appendChild(div)
            }

            newDate = new Date(newDate.getTime() + (EPOCHNEXTDAY * 1000))
            newDateDay = newDate.getDate()
        }
    }

    console.log(bookings)
})

const searchDay = (date) => {
    const bookingOfTheDay = bookings.find((item) => {
        const bookingDate = item.booking_date.split(' ')

        const day = date.getDate()
        const month = date.getMonth() + 1
        const year = date.getFullYear()

        const formatedDay = day < 10 ? '0' + day : day
        const formatedMonth = month < 10 ? '0' + month : month

        const fullDate = `${formatedDay}-${formatedMonth}-${year}`

        return fullDate === bookingDate[0]
    })

    return bookingOfTheDay
}