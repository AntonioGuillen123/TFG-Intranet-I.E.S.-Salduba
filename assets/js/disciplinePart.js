$(document).ready(() => {
    getDisciplineParts()
})

const getDisciplineParts = () => {
    const parts = document.querySelectorAll('.discipline-part')

    const modal = document.querySelector('.modal')
    const modalLabel = modal.querySelector('#part-modal-label')
    const modalButton = modal.querySelector('#submit-button')

    modalButton.addEventListener('click', () => {
        const partID = modal.getAttribute('partID')
        const measureID = modal.querySelector('select').value

        makeMeasure(partID, measureID)
    })

    parts.forEach((item) => {
        const measureButton = item.querySelector('button')

        if (measureButton) {
            measureButton.addEventListener('click', () => {
                const partID = item.getAttribute('id').split('-')[2]

                const crimeName = item.querySelector('.crime-name')

                modal.setAttribute('partID', partID)

                modalLabel.innerHTML = crimeName.innerHTML
            })
        }
    })
}

const makeMeasure = async (partID, measureID) => {
    await $.ajax({
        url: `/disciplinePart/makeMeasure`,
        type: 'PUT',
        headers: 'Content-Type: application/json',
        data: {
            'partID': parseInt(partID),
            'measureID': parseInt(measureID)
        },
        success: (response) => {
            $('.modal').modal('hide')
            /* const modalBackDrop = document.querySelector('.modal-backdrop')
            modalBackDrop.remove()
            const modal = document.querySelector('.modal')
            modal.classList.remove('show')
            modal.style.display = 'none'
            modal.removeAttribute('aria-modal')
            modal.removeAttribute('role')
            modal.setAttribute('aria-hidden', true) */

            /* const bootstrapModal = new Modal(modal)

            bootstrapModal.hide() */

            const content = response.content

            $('#main-content').html(content)

            getDisciplineParts()
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}