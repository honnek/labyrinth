$(function () {
    $.ajax({
        method: 'get',
        url: '/getArray.php',
        dataType: 'json',
        success: async function (response) {
            for (let j = 0; j < response.length; j++) {
                for (let i = 0; i < response[j].length; i++) {
                    await sleep(200)
                    let point = response[j][i]
                    $(`#sqr-${point.y}-${point.x}`).css({backgroundColor: "green"})
                    if ((response[response.length-1]['x'] == point.x) && (response[response.length-1]['y'] == point.y )){
                        await sleep(900)
                        $(`body`).append($(`<div><h1>Вы нашли У в  (${point.x};${point.y}) !!!<h1></div>`));
                        break
                    }
                }

                await sleep(800)
                for (let i = 0; i < response[j].length;i++) {
                    let whitePoint = response[j][i]
                    $(`#sqr-${whitePoint.y}-${whitePoint.x}`).css({backgroundColor: "white"})
                }
            }
        }
    })
})



function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


// function saveWays(data) {
//     for (let i = 0; i < data.length; i++) {
//         localStorage.setItem(`way-${i}`, data[i])
//     }
// }

// async function viewMove(point) {
//     let promise = new Promise(() => {setTimeout(() => {console.log(point)}, )})
//     await promise
// }



