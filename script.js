// =================== SIGNUP ===================
document.getElementById('signup-form').addEventListener('submit', async function(event) {
  event.preventDefault();

  const name = document.getElementById('new-name').value;
  const email = document.getElementById('new-email').value;
  const password = document.getElementById('new-password').value;

  const formData = new FormData();
  formData.append('name', name);
  formData.append('email', email);
  formData.append('password', password);

  try {
    const response = await fetch('signup.php', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();

    if (result.status === 'success') {
      alert("Account created successfully!");
      document.querySelector('.login-container').style.display = 'block';
      document.querySelector('.signup-container').style.display = 'none';
    } else {
      document.getElementById('signup-error-msg').innerText = result.message;
    }
  } catch (error) {
    document.getElementById('signup-error-msg').innerText = "Signup failed. Try again.";
  }
});

// =================== LOGIN ===================
document.getElementById('login-form').addEventListener('submit', async function(event) {
  event.preventDefault();

  const email = document.getElementById('email').value;
  const password = document.getElementById('password').value;

  const formData = new FormData();
  formData.append('email', email);
  formData.append('password', password);

  try {
    const response = await fetch('login.php', {
      method: 'POST',
      body: formData
    });

    const result = await response.json();
    console.log("Login result:", result); // 👈 Check this in browser console

    if (result.status === 'success') {
      alert("Login successful!");
      window.location.href = `facebook.html?userID=${result.userID}`;
    } else {
      document.getElementById('login-error-msg').innerText = "Invalid email or password";
    }
  } catch (error) {
    console.error("Login error:", error);
    document.getElementById('login-error-msg').innerText = "Login failed. Try again.";
  }
});


// =================== TOGGLE FORM ===================
document.getElementById('signup-link').addEventListener('click', function(event) {
  event.preventDefault();
  document.querySelector('.login-container').style.display = 'none';
  document.querySelector('.signup-container').style.display = 'block';
});

// =================== FAKE FACEBOOK LOGIN PLACEHOLDER ===================
document.getElementById('login-fb-btn').addEventListener('click', function(event) {
  event.preventDefault();
  alert('Adding this feature soon!');
});

document.addEventListener("DOMContentLoaded", async () => {
  try {
    const res = await fetch("get_user.php");
    const data = await res.json();

    if (data.user_name) {
      document.getElementById("profileName").innerText = data.user_name;
    }
    if (data.email) {
      document.getElementById("profileEmail").innerText = data.email;
    }
    if (data.profile_img) {
      document.querySelectorAll(".profile-icon, .profile-img, .profile-img-large").forEach(img => {
        img.src = data.profile_img;
      });
    }
  } catch (e) {
    console.error("Failed to fetch user data from database.");
  }
});
document.getElementById('signup-link').addEventListener('click', function (e) {
  e.preventDefault();
  document.querySelector('.login-container').style.display = 'none';
  document.querySelector('.signup-container').style.display = 'block';
});

document.getElementById('back-to-login-link').addEventListener('click', function (e) {
  e.preventDefault();
  document.querySelector('.signup-container').style.display = 'none';
  document.querySelector('.login-container').style.display = 'block';
});
