<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Reset default margins and paddings */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 1rem;
        }

        /* Container styles */
        .register-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        .register-form {
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        .register-form h2 {
            margin-bottom: 1.5rem;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        .form-group input:focus {
            border-color: #2575fc;
            outline: none;
        }

        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #2575fc;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1a5bbf;
        }

        .message {
            margin-top: 1rem;
            font-size: 14px;
            color: #666;
        }

        .message a {
            color: #2575fc;
            text-decoration: none;
        }

        .message a:hover {
            text-decoration: underline;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            .register-form {
                padding: 1rem;
                margin: 1rem;
            }

            .register-form h2 {
                font-size: 20px;
            }

            .form-group input, button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-form">
        <?php if(isset($model['error'])){ ?>
         <div class="alert alert-primary" style="margin : 3px; padding-top:3px; padding-bottom:3px; background: linear-gradient(to right, #6a11cb, #2575fc);"><?= $model['error'] ?></div>
          <?php   } ?>
            <h2>Register</h2>
            <form action="/users/register" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required>
                </div>
                <div class="form-group">
                    <label for="email">nama</label>
                    <input type="text" id="name" name="name" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>
                <button type="submit">Register</button>
                <p class="message">Already have an account? <a href="/users/login">Login here</a></p>
            </form>
        </div>
    </div>
</body>
</html>
