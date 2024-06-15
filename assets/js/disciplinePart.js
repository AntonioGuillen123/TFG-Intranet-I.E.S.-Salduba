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
        const pdf = modal.querySelector('#pdf').checked

        makeMeasure(partID, measureID, pdf)
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

const makeMeasure = async (partID, measureID, pdf) => {
    await $.ajax({
        url: `/disciplinePart/makeMeasure`,
        type: 'PUT',
        headers: 'Content-Type: application/json',
        data: {
            'partID': parseInt(partID),
            'measureID': parseInt(measureID),
            'pdf': pdf ? '1' : '0'
        },
        success: (response) => {
            document.querySelector('#pdf').checked = false

            const content = response.content

            $('.modal').modal('hide')

            $('#main-content').html(content)

            getDisciplineParts()
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}