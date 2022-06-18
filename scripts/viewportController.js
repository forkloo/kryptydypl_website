
let visibleArticleBoxes = 0

window.onload = function(){
    let popDiv = document.getElementById("newest")
    popDiv.innerHTML = "<h2>Niedawno edytowane artykuły</h2>"
    loadArticleNames()
}

function addNewestArticles(articleNames, startingFrom = 0){
    let popDiv = document.getElementById("newest")
    if(startingFrom > articleNames.length){
        return
    }
    let howMany = 0
    for(let a = startingFrom; a < articleNames.length; a++){
        let aFilename = articleNames[a].filename
        let aData = null

        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'data/articles/'+aFilename, true)
        
        xhr.onload = function(){
            if(this.status == 200){
                aData = JSON.parse(this.responseText)

                let param = new URLSearchParams();
                param.append("KEY", articleNames[a].title)
                let aHref = "subsites/article.php?'"+articleNames[a].filename
                popDiv.innerHTML += "<div class='article'>"
                +"<a href="+aHref+">"+aData.title+"<i>[CZYTAJ ARTYKUŁ]</i></a><br><br>" 
                +"<span>"
                +aData.text.substr(0, 400)+"[...]"
                +"</span>"
                +"<p class='editor-data'>"
                +"użytkownik <i>"
                +aData.lastEdited[0]
                +"</i> edytował "
                +aData.lastEdited[1]+" "+aData.lastEdited[2]+"</p>"

                +"</div>"
                howMany++
            }
            if(this.status == 404){
                aData = null
            }
        }
        xhr.send()
        visibleArticleBoxes += howMany
        
    }
}


function loadArticleNames(){
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'data/articles/articleNames.json', true)
    
    xhr.onload = function(){
        if(this.status == 200){
            addNewestArticles(JSON.parse(this.responseText), 0)
        }
    }
    xhr.send()
}

function goToArticle(articleName){
    console.log(articleName)
    
}