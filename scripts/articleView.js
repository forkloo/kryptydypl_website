let aData = {}
let aTitleDiv = document.getElementById("articleTitle")
let aImage = document.getElementById("articleImage")
let aTextDiv = document.getElementById("articleText")
let aDescDiv = document.getElementById("articleDesc")
let aEditData = document.getElementById("editData")
let aCommDiv = document.getElementById("articleComments")

window.onload = function(){
    aTitleDiv = document.getElementById("articleTitle")
    aImage = document.getElementById("articleImage")
    aTextDiv = document.getElementById("articleText")
    aDescDiv = document.getElementById("articleDesc")
    aEditData = document.getElementById("editData")
    aCommDiv = document.getElementById("articleComments")

    getArticleContent()
}

function getArticleContent(){
    var aFilename = window.location.search
    aFilename = aFilename.substring(4)
    let xhr = new XMLHttpRequest()
    xhr.open('GET', '../data/articles/'+aFilename, true)
    
    xhr.onload = function(){
        if(this.status == 200){
            aData = JSON.parse(this.responseText)
            loadContent()
        }
        else{
            aTitleDiv.innerHTML = "Artykuł"
            aEditData.innerHTML = ""
            aTextDiv.innerHTML = "<h1 class='error-message'>Błąd! "+this.status+": "+this.statusText+"</h1>"
            aCommDiv.innerHTML += "<h3>Brak komentarzy</h3>"
        }
    }
    xhr.send()
}

function loadContent(){
    //tytuł
    aTitleDiv.innerHTML = "<h1>"+aData.title+"</h1>"
    //informacje o edytorach
    aEditData.innerHTML = "Stworzone przez: "+aData.createdBy[0]+" | "+aData.createdBy[1]+" "+aData.createdBy[2]+"<br>"+
                            "Ostatnio edytowane przez: "+aData.lastEdited[0]+" | "+aData.lastEdited[1]+" "+aData.lastEdited[2]
    //treść
    aTextDiv.innerHTML += aData.text
    //komentarze

    if (aData.comments.length > 0){
        for(let c in aData.comments){
            let comment = aData.comments[c]
            aCommDiv.innerHTML += getCommentDiv(comment)
        }
    }
    else{
        aCommDiv.innerHTML += "<h3>Brak komentarzy</h3>"
    }

}

function getCommentDiv(cData){
    let div = "<div class='comment'>"

    div += "<h3 class='editor-data'>"+cData.lastEdited[1]+" "+cData.lastEdited[2]+"</h3>" //informacje o czasie publikacji komentarza
    div += "<h3>"+cData.lastEdited[0]+"</h3>" //nazwa użytkownika

    div += "<span> "+cData.text+"</span>"
    div += "</div>"
    return div
}