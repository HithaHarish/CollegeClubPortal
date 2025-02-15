// Function to generate team member fields based on team size
document.getElementById('teamSize').addEventListener('input', function() {
    const teamSize = parseInt(this.value) || 0;
    const teamMembersFields = document.getElementById('teamMembersFields');
    teamMembersFields.innerHTML = ''; // Clear existing fields

    for (let i = 1; i <= teamSize; i++) {
        const memberHTML = `
            <div class="team-member">
                <h3>Team Member ${i}</h3>
                <label for="name${i}">Name:</label>
                <input type="text" id="name${i}" required>

                <label for="usn${i}">USN:</label>
                <input type="text" id="usn${i}" required>

                <label for="collegeEmail${i}">College Email:</label>
                <input type="email" id="collegeEmail${i}" required>

                <label for="contact${i}">Contact:</label>
                <input type="text" id="contact${i}" required>

                <label for="branch${i}">Branch:</label>
                <input type="text" id="branch${i}" required>

                <label for="semester${i}">Semester:</label>
                <input type="text" id="semester${i}" required>
            </div>
        `;
        teamMembersFields.innerHTML += memberHTML;
    }
});

// Handle the form submission
function handleFormSubmit(event) {
    event.preventDefault(); // Prevent actual form submission

    // Get team size and team member data
    const teamSize = document.getElementById('teamSize').value;
    const teamMembers = [];

    for (let i = 1; i <= teamSize; i++) {
        const member = {
            name: document.getElementById(`name${i}`).value,
            usn: document.getElementById(`usn${i}`).value,
            collegeEmail: document.getElementById(`collegeEmail${i}`).value,
            contact: document.getElementById(`contact${i}`).value,
            branch: document.getElementById(`branch${i}`).value,
            semester: document.getElementById(`semester${i}`).value
        };
        teamMembers.push(member);
    }

    // Send data to the backend
    fetch('http://localhost:3000/submit-registration', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ teamSize, teamMembers })
    })
    .then(response => response.json())
    .then(data => {
        alert('Registration successful!');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error in registration');
    });
}

// Ensure the DOM is loaded before attaching the event listener
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('registrationForm'); // Assuming you have an ID for your form
    form.addEventListener('submit', handleFormSubmit);
});
