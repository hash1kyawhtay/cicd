<!DOCTYPE html>
<html>
<head>
    <title>CI Project - Frontend</title>
</head>
<body>
    <h1>Welcome to the CI Project</h1>
    <button onclick="fetchData()">Get API Data</button>

    <pre id="output"></pre>

    <script>
        function fetchData() {
            fetch('http://backend/api.php')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('output').textContent = JSON.stringify(data, null, 4);
                })
                .catch(error => {
                    document.getElementById('output').textContent = 'Error: ' + error;
                });
        }
    </script>
</body>
</html>
