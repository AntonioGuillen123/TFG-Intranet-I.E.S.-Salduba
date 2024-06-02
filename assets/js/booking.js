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
            const cell = document.querySelector(`#day-${weekIndex}-${dayIndex} .day-number`)
            cell.textContent = newDateDay

            document.querySelector(`#day-${weekIndex}-${dayIndex}`).classList.add(newDate.getMonth() === monthIndex ? 'hover:bg-gray-300' : 'bg-gray-300')

            newDate = new Date(newDate.getTime() + (EPOCHNEXTDAY * 1000))
            newDateDay = newDate.getDate()
        }
    }
})