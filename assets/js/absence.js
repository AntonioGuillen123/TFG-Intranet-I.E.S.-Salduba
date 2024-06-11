import { Popover } from 'flowbite';

$(document).ready(() => {
    getPopOvers()
})

const getPopOvers = (ayax = false) => {
    const absences = document.querySelectorAll('.absence')

    absences.forEach((item) => {
        const id = item.getAttribute('id').split('-')[1]

        const isCovered = item.classList.contains('covered')

        const coveredBy = item.querySelector('.coveredBy')

        const popOver = document.getElementById(`popover-${id}`)

        const time = item.querySelector('time')

        time.addEventListener(isCovered ? 'mouseover' : 'click', () => {
            popOver.innerHTML = ''

            const header = document.createElement('div')
            header.classList.add('px-3', 'py-2', 'bg-gray-100', 'border-b', 'border-gray-200', 'rounded-t-lg', 'dark:border-gray-600', 'dark:bg-gray-700')

            const h5 = document.createElement('h5')
            h5.classList.add('font-semibold', 'text-gray-900', 'dark:text-white')
            h5.innerHTML = isCovered ? 'Cubierta por' : '¿Desea cubrir la ausencia?'

            const content = document.createElement('div')
            content.classList.add('px-3', 'py-2', 'text-center')

            let element

            if (isCovered) {
                element = document.createElement('p')
                element.innerHTML = coveredBy.innerHTML
            } else {
                element = document.createElement('button')
                element.classList.add('text-white', 'bg-gradient-to-r', 'from-cyan-400', 'via-cyan-500', 'to-cyan-600', 'hover:bg-gradient-to-br', 'focus:ring-4', 'focus:outline-none', 'focus:ring-cyan-300', 'dark:focus:ring-cyan-800', 'shadow-lg', 'shadow-cyan-500/50', 'dark:shadow-lg', 'dark:shadow-cyan-800/80', 'font-medium', 'rounded-lg', 'text-sm', 'px-5', 'py-2.5', 'text-center', 'me-2', 'mb-2')
                element.addEventListener('click', () => coverAbsence(id))
                element.innerHTML = 'Cubrir Ausencia'
            }

            const arrow = document.createElement('div')
            arrow.setAttribute('data-popper-arrow', '')

            header.appendChild(h5)

            content.appendChild(element)

            popOver.appendChild(header)
            popOver.appendChild(content)
            popOver.appendChild(arrow)

            if (ayax) {
                const newPop = new Popover(popOver, time, {
                    placement: 'right'
                })

                newPop.init()
            }
        })
    })
}

const coverAbsence = async (id) => {
    await $.ajax({
        url: `/absence/${id}`,
        type: 'PUT',
        success: (response) => {
            const content = response.content

            $('#absences-container').html(content)

            getPopOvers(true)
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}