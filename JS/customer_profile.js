function saveProfile() {
    const email = document.getElementById("email").value;
    const phone = document.getElementById("phone").value;
    const address = document.getElementById("address").value;

    fetch("update_profile.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            email: email,
            phone: phone,
            address: address,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            alert("Profile updated successfully!");
        } else {
            alert("Failed to update profile.");
        }
    })
    .catch(error => console.error("Error:", error));
}
