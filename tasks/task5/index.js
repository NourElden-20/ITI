let name = "";
let age = "";

while (!name || !age) {
    name = prompt("Enter your name:");
    age = prompt("Enter your age:");
    if (!name || !age) {
        alert("Please enter a valid name and age.");
    }
}

document.write(
    "Hello " + name + "<br>" + ", you are " + (2025 - parseInt(age, 10)) + " years old."
);
document.write("<hr>");

function showMessage() {
    for (let i = 1; i <= 6; i++) {
        document.write("<h"+ i+">"+"the header"+"</h"+i+">");
    }
}
showMessage();


document.write("<hr>");

var img=prompt("Enter the image name:");
if (img) {
    document.write("<img src='" + img + "' alt='Image' width='200' height='200'>");
}
else
{
    alert("No image provided.");
}

document.write("<hr>");

var studentInfo=[
    {
        name: "Rabea",
        age: 25,
        grade: "A",
        Image: "p1.jpg"
    },
    {
        name: "Ahmed",
        age: 22,
        grade: "B",
        Image: "p2.png"
    },
    {
        name: "Sara",
        age: 23,
        grade: "A+",
        Image: "p2.png"

    }
]

function displayStudentsInfo(students) {
    document.write("<table border='1'>");
    document.write("<tr><th>Name</th><th>Age</th><th>Grade</th></tr>");
    students.forEach(function(student) {
        document.write("<tr>");
        document.write("<td>" + student.name + "</td>");
        document.write("<td>" + student.age + "</td>");
        document.write("<td>" + student.grade + "</td>");
        document.write("<td><img src='" + student.Image + "' alt='Image' width='100' height='100'></td>");
        document.write("</tr>");
    });
    document.write("</table>");
}
displayStudentsInfo(studentInfo);

var tips=[
    "Stay positive and keep learning.",
    "Practice coding every day.",
    "Don't be afraid to ask for help.",
    "Break down problems into smaller parts.",
    "Use online resources to enhance your skills.",
    "Collaborate with others to gain new perspectives.",
    "Stay organized and manage your time effectively.",

]
function displayTips(tips) {
    document.write(tips[Math.floor(Math.random()* tips.length) ] );
}
displayTips(tips);
ch=prompt("Enter a character to remove from the list (a-z):");
var chr=[
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
]
function removechar(chr,ch){
    var index = chr.indexOf(ch);
    if (index !== -1) {
        chr.splice(index, 1);
        document.write("Character '" + ch + "' removed from the list.<br>");
    } else {
        document.write("Character '" + ch + "' not found in the list.<br>");
    }
    document.write("Updated list: " + chr.join(", ") + "<br>");
    
}
removechar(chr,ch);

document.write("<hr>");
var num=[1, 2,2, 3, 4, 5, 6, 7, 8, 9, 10];
function dispalyhowmanytimes(num,n) {
    var count = 0;
    num.forEach(function(item) {
        if (item === n) {
            count++;
        }
    });
    document.write("The number " + n + " appears " + count + " times in the array.<br>");
}
var n = parseInt(prompt("Enter a number to count its occurrences in the array (1-10):"));
dispalyhowmanytimes(num, n);
