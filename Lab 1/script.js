//Task-1

let r=5;
const pi=3.14;
var volume=(4/3)*pi*Math.pow(r,3);
console.log("Radius is",r);
console.log("Volume of sphere is",volume);

//Task-2

function Addition(a,b){
    return a+b;
}

const subtraction=(a,b)=>{
    return a-b;
}

console.log("Subtraction of 10 and 5 is",subtraction(10,5));
console.log("Addition of 5 and 10 is",Addition(5,10));

//Task-3 , Task-4

function addNumbers(event) {

    event.preventDefault();  
    let num = document.getElementById("num").value;

    let number2 = prompt("Enter another number:");

    if(num == 0 || number2 == 0){  
        alert("Number should be non-zero");
        return;
    } 

    let result = Addition(parseInt(num), parseInt(number2));
    console.log("Addition of the two numbers is", result);

    document.getElementById("result").textContent =
        "Sum = " + result;
}



//Task-5
document.getElementById("header").style.color="green";

function toggleStyle() {
    document.getElementById("ttext").classList.toggle("active");
}

//Task-6

function evenodd(){
    let num=prompt("Enter a number:");
    if(num%2===0){
        alert("The given number "+num+" is Even.");
    }else if(num==0){
        alert("Number is neither even nor odd");
    }
    else{
        alert("The given number "+num+" is Odd.");
    }
}

function changeColor() {
    document.getElementById("box").style.backgroundColor = "yellow";
}

function resetColor() {
    document.getElementById("box").style.backgroundColor = "lightgray";
}


//Task-7

function printPage() {
    window.print();
}



function askName() {
    let username = prompt("Enter your name:");

    if (username === null || username.trim() === "") {
        document.getElementById("greet").textContent = "No name entered!";
    } else {
        document.getElementById("greet").textContent = "Hello, " + username + "! Welcome 😊";
    }
}


function validateForm() {
    let name = document.getElementById("fname").value.trim();
    let age = document.getElementById("age").value;

    let result = document.getElementById("formResult");

    if (name === "") {
        result.textContent = "Name cannot be empty!";
        result.style.color = "red";
        return false;  
    }

    if (age === "" || age <= 0) {
        result.textContent = "Please enter a valid age!";
        result.style.color = "red";
        return false;
    }

    result.textContent = "Form submitted successfully!";
    result.style.color = "green";

    return false; 
}





