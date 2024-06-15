import { debounce } from "../app.js"


$(document).ready(() => {
    const searchBar = document.querySelector('#search-bg input')
    searchBar.addEventListener('keyup', debounce((event) => getRenderNews(event.target.value), 500))

    const news = document.querySelectorAll('.new')
    news.forEach((newsItem) => {
        const id = newsItem.getAttribute('id')
        const eye = newsItem.querySelector('.eye')
        const value = eye?.getAttribute('value')

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach((item) => {
                if (
                    item.isIntersecting
                    && value === ''
                )
                    markViewNew(id)
            })
        })

        observer.observe(newsItem)
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

const markViewNew = async (id) => {
    await $.ajax({
        url: `/news/markViewNew/${id}`,
        type: 'PUT',
        success: (response) => {
        },
        error: (err) => {
            console.log(`Error :( ${err.responseText}`)
        }
    })
}