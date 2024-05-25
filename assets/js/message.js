$(document).ready(() => {
    const messages = document.querySelectorAll('[class*="message-item-"]')

    messages.forEach((item) => {
        const className = item.classList[1]

        const id = className.split('-')[2]

        item.addEventListener('click', () => deleteMessage(id))
    })
})

const deleteMessage = async (id) => {
    await $.ajax({
        url: `/message/${id}`,
        type: 'DELETE',
        success: (response) => {
            if (response === '202') {
                $(`.message-item-${id}`).remove()
            } else {
                console.log('Error al borrar el mensaje :(')
            }
        },
        error: (err) => {
            console.log('Error :(')
        }
    })
}
