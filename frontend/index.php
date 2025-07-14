<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CI Project - Login & Signup</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            padding-top: 50px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .tabs {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .tabs button {
            flex: 1;
            padding: 10px;
            border: none;
            background: #e5e7eb;
            cursor: pointer;
            font-weight: bold;
            border-radius: 8px;
            margin: 0 5px;
            transition: background 0.3s;
        }

        .tabs button.active {
            background: #3b82f6;
            color: white;
        }

        form {
            display: none;
            flex-direction: column;
        }

        form.active {
            display: flex;
        }

        input, button[type="submit"] {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #3b82f6;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #2563eb;
        }

        pre {
            background: #fef3c7;
            color: #78350f;
            padding: 12px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>CI/CD Login Portal</h1>

        <div class="tabs">
            <button id="loginTab" class="active" onclick="showForm('login')">Login</button>
            <button id="signupTab" onclick="showForm('signup')">Signup</button>
        </div>

        <!-- Login Form -->
        <form id="loginForm" class="active" onsubmit="submitForm(event, 'login')">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>

        <!-- Signup Form -->
        <form id="signupForm" onsubmit="submitForm(event, 'signup')">
            <input type="text" name="username" placeholder="Username" required />
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Signup</button>
        </form>

        <pre id="output"></pre>
    </div>

    <script>
        function showForm(type) {
            const loginForm = document.getElementById('loginForm');
            const signupForm = document.getElementById('signupForm');
            const loginTab = document.getElementById('loginTab');
            const signupTab = document.getElementById('signupTab');

            if (type === 'login') {
                loginForm.classList.add('active');
                signupForm.classList.remove('active');
                loginTab.classList.add('active');
                signupTab.classList.remove('active');
            } else {
                signupForm.classList.add('active');
                loginForm.classList.remove('active');
                signupTab.classList.add('active');
                loginTab.classList.remove('active');
            }

            document.getElementById('output').textContent = '';
        }

        function submitForm(event, type) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            fetch(`http://backend.cicd.local/${type}.php`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) throw new Error("HTTP error " + response.status);
                return response.json();
            })
            .then(result => {
                const output = document.getElementById('output');
                output.textContent = JSON.stringify(result, null, 4);
                output.style.background = result.status === 'success' ? '#dcfce7' : '#fee2e2';
                output.style.color = result.status === 'success' ? '#065f46' : '#991b1b';
            })
            .catch(error => {
                document.getElementById('output').textContent = 'Error: ' + error;
            });
        }
    </script>
</body>
</html>
