// DOM
const $ = document;
const root = $.querySelector(":root");

function select(query) {
  return $.querySelector(query);
}

function selectAll(query) {
  return $.querySelectorAll(query);
}

// select items
const items = {
  header: {
    togglerCheckbox: select("#header-toggler-checkbox"),
    title: {
      login: select(".header-title-login"),
      signup: select(".header-title-signup"),
    },
  },
  body: select(".body"),
  input: {
    inputs: selectAll(".input"),
    icons: selectAll(".input-icon"),
  },
};

let signStatus = "login";

const chnageSignStatus = {
  login: () => {
    signStatus = "login";
    root.style.setProperty("--body-rotate", "rotateY(0deg)");
    root.style.setProperty("--background-position", "0 0");
    root.style.setProperty("--body-height", "380px");
    root.style.setProperty("--login-display", "flex");
    root.style.setProperty("--signup-display", "none");
  },
  signup: () => {
    signStatus = "signup";
    root.style.setProperty("--body-rotate", "rotateY(0deg)");
    root.style.setProperty("--background-position", "200% 100%");
    root.style.setProperty("--body-height", "430px");
    root.style.setProperty("--login-display", "none");
    root.style.setProperty("--signup-display", "flex");
  },
};

function checkSignStatus() {
  switch (signStatus) {
    case "login":
      chnageSignStatus.signup();
      break;
    case "signup":
      chnageSignStatus.login();
      break;
  }
}

function setInputFocus(input, icon) {
  input.addEventListener("focus", () => {
    icon.classList.add("focused-icon");
    input.parentElement.classList.add("input-focused");
  });
  input.addEventListener("blur", () => {
    icon.classList.remove("focused-icon");
    input.parentElement.classList.remove("input-focused");
  });
}

for (let index in items.input.inputs) {
  if (typeof items.input.inputs[index] == "object") {
    setInputFocus(items.input.inputs[index], items.input.icons[index]);
  }
}

// events
items.header.togglerCheckbox.addEventListener("change", checkSignStatus);
items.header.title.login.addEventListener("click", () => {
  chnageSignStatus.login();
  items.header.togglerCheckbox.checked = false;
});
items.header.title.signup.addEventListener("click", () => {
  chnageSignStatus.signup();
  items.header.togglerCheckbox.checked = true;
});

// Add form submission logic here
const loginButton = document.querySelector(".login-button");
const signupButton = document.querySelector(".signup-button");

loginButton.addEventListener("click", async () => {
  const username = select(".login-input-input[placeholder='Username']").value;
  const password = select(".login-input-input[placeholder='Password']").value;

  try {
    const response = await fetch("http://localhost:5000/api/auth/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email: username, password }),
    });

    const data = await response.json();
    if (response.ok) {
      alert("Login successful!");
    } else {
      alert(`Error: ${data.message}`);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});

signupButton.addEventListener("click", async () => {
  const email = select(".signup-input-input[placeholder='Email']").value;
  const username = select(".signup-input-input[placeholder='Username']").value;
  const password = select(".signup-input-input[placeholder='Password']").value;

  try {
    const response = await fetch("http://localhost:5000/api/auth/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name: username, email, password }),
    });

    const data = await response.json();
    if (response.ok) {
      alert("Registration successful!");
    } else {
      alert(`Error: ${data.message}`);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred. Please try again.");
  }
});
