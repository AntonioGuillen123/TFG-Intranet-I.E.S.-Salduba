import { debounce } from "../app.js"


$(document).ready(() => {
    const searchBar = document.querySelector('#search-bg input')
    searchBar.addEventListener('keyup', debounce((event) => getRenderNews(event.target.value), 500))

    const uploadFile = document.querySelector('#news_image')
    uploadFile?.addEventListener('change', (event) => {
        console.log('hola')

        console.log(event.target.files)
    })
})

const getRenderNews = async (input) => {
    await $.ajax({
        url: `/news/render`,
        type: 'POST',
        headers: 'Content-Type: application/json',
        data: {
            input: input
        },
        success: (response) => {
            $('#main-content').html(response.content)
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}