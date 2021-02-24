const sortAsc = document.querySelector('#sort-asc')

if (sortAsc) {
    sortAsc.addEventListener('click', function () {
        const nav = document.querySelector('#nav')
        const arrayLength = nav.children[0].children.length
        const navChildren = nav.children[0].children

        for (let i = 1; i < arrayLength; i++) {
            for (let j = i; j < arrayLength; j++) {
                if (+navChildren[i].getAttribute('data-sort') > +navChildren[j].getAttribute('data-sort')) {
                    let replaceNode = nav.children[0].replaceChild(navChildren[j], navChildren[i])
                    insertAfter(replaceNode, navChildren[i])
                }
            }
        }
    })
}

const sortDesc = document.querySelector('#sort-desc')

if (sortDesc) {
    sortDesc.addEventListener('click', function () {
        const nav = document.querySelector('#nav')
        const arrayLength = nav.children[0].children.length
        const navChildren = nav.children[0].children

        for (let i = 1; i < arrayLength; i++) {
            for (let j = i; j < arrayLength; j++) {
                if (+navChildren[i].getAttribute('data-sort') < +navChildren[j].getAttribute('data-sort')) {
                    let replaceNode = nav.children[0].replaceChild(navChildren[j], navChildren[i])
                    insertAfter(replaceNode, navChildren[i])
                }
            }
        }
    })
}

function insertAfter(elem, refElem) {
    return refElem.parentNode.insertBefore(elem, refElem.nextSibling)
}