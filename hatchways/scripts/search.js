const studentList = document.getElementById("students");

const searchInput = document.getElementById("search");
let arr = [];
let li = "";

searchInput.addEventListener('keyup', (e) =>{
    const word = e.target.value.toLowerCase();

    const filtered = arr.filter((student) => {
        return (
            student.firstName.toLowerCase().includes(word) || 
            student.lastName.toLowerCase().includes(word)
        );
    });

    document.getElementById("students").innerHTML = li;
});

const loadStudents = async () => {
    try {
        const res = await fetch('https://api.hatchways.io/assessment/students');
        students = await res.json();
        displayCharacters(students);
    } catch (err) {
        console.error(err);
    }
};

const displayStudents = (student) => {
    const htmlString = student
        .map((student) => {
            return `
            <li>
                <h2>${character.name}</h2>
                <p>House: ${character.house}</p>
                <img src="${character.image}"></img>
            </li>
        `;
        })
        .join('');
    charactersList.innerHTML = htmlString;
};

loadCharacters();
