
let phoneNumber = ""
let lastLength = 0

function checkRegistrationForm(){
    let form = document.forms["form-register"]
    if (checkNames() && checkPhoneNumber() && checkEmail()){
        form.submit()
    }
}

function checkNamesOnInput(inputFieldId){
    if(Number.isInteger(inputFieldId)){
        let inputField = document.forms["form-register"][inputFieldId]
        let text = inputField.value
        
        if(text.length > 0){
            let firstChar = text[0].toUpperCase()
            let substrText = text.substr(1).toLowerCase()
            inputField.value = firstChar + substrText
        }
        inputField.style["background-color"]= /\d/.test(inputField.value) ? "#ff9999" : "white"
        return !/\d/.test(inputField.value) && text.length > 0
    }
}

function checkPhoneNumberOnInput(){
    let onlyNumbers = /^[0-9]$/ 
    let phoneForm = document.forms["form-register"][2]
    let text = phoneForm.value

    if(text.length > 0){ //check if last character is a number
        let ch = text[text.length-1]
        if(onlyNumbers.test(ch)){
            phoneNumber = text
        }
    }
    phoneNumber = text.length > 0 ? phoneNumber : ""
    phoneForm.style["background-color"]= "white"
    phoneForm.value = phoneNumber
}

function checkNames(){
    let isCorrect = false
    isCorrect = checkNamesOnInput(0)
    
    document.forms["form-register"][0].style["background-color"] = isCorrect ? "white" : "#ff9999"
    isCorrect = checkNamesOnInput(1)
    document.forms["form-register"][1].style["background-color"] = isCorrect ? "white" : "#ff9999"

    isCorrect = document.forms["form-register"][4].value != ""
    document.forms["form-register"][4].style["background-color"] = isCorrect ? "white" : "#ff9999"
    isCorrect = document.forms["form-register"][5].value != ""
    document.forms["form-register"][5].style["background-color"] = isCorrect ? "white" : "#ff9999"

    return isCorrect

}

function checkPhoneNumber(){
    let phoneForm = document.forms["form-register"][2]
    let text = phoneForm.value

    if (text.length > 0){
        let pattern = /^[0-9]{9}$/
        if(pattern.test(text)){
            phoneForm.style["background-color"]= "white"
            return true
        }
    }
    phoneForm.style["background-color"]= "#ff9999"
    return false
}

function checkEmail(){
    let mailForm = document.forms["form-register"][3]
    let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let test = validRegex.test(mailForm.value)

    if(test){
        let atInx = mailForm.value.lastIndexOf('@')
        let dotidx = mailForm.value.lastIndexOf('.')
        if(atInx > dotidx || dotidx == mailForm.value.length){
            test = false
        }
    }

    mailForm.style["background-color"]= !test ? "#ff9999" : "white"
    return test
}