<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketly - Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="events.php">Events</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <h1>Register</h1>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red; text-align: center;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
    <section>
        <form action="register_process.php" method="post" onsubmit="return validateForm()">
            <fieldset>
                <legend>Personal Details</legend>
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
                <label for="nrc">NRC:</label>
                <input type="text" id="nrc" name="nrc" required>
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="dob" required>
                <label for="phone_number">Phone Number:</label>
                <input type="tel" id="phone_number" name="phone_number" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="sex">Sex:</label>
                <select id="sex" name="sex" required>
                    <option value="">Select</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <label for="client_type">Client Type:</label>
                <select id="client_type" name="client_type" required>
                    <option value="">Select</option>
                    <option value="Student">Student</option>
                    <option value="Worker">Worker</option>
                    <option value="Business Person">Business Person</option>
                </select>
                <label for="hobbies">Hobbies:</label>
                <textarea id="hobbies" name="hobbies"></textarea>
            </fieldset>
            <fieldset>
                <legend>Address</legend>
                <label for="physical_address">Physical Address:</label>
                <input type="text" id="physical_address" name="physical_address" required>
                <label for="area">Area:</label>
                <input type="text" id="area" name="area" required>
                <label for="street">Street:</label>
                <input type="text" id="street" name="street" required>
                <label for="town">Town:</label>
                <input type="text" id="town" name="town" required>
                <label for="province">Province:</label>
                <input type="text" id="province" name="province" required>
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </fieldset>
            <fieldset>
                <legend>Bank Details</legend>
                <label for="bank_name">Bank Name:</label>
                <input type="text" id="bank_name" name="bank_name" required>
                <label for="bank_account_no">Bank Account No:</label>
                <input type="text" id="bank_account_no" name="bank_account_no" required>
                <label for="bank_branch">Bank Branch:</label>
                <input type="text" id="bank_branch" name="bank_branch" required>
                <label for="bank_address">Bank Address:</label>
                <input type="text" id="bank_address" name="bank_address" required>
                <label for="bank_phone">Bank Phone:</label>
                <input type="tel" id="bank_phone" name="bank_phone" required>
                <label for="bank_email">Bank Email:</label>
                <input type="email" id="bank_email" name="bank_email" required>
            </fieldset>
            <fieldset>
                <legend>Password</legend>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </fieldset>
            <button type="submit">Register</button>
        </form>
    </section>
</main>
    <footer>
        <p>&copy; 2025 Ticketly</p>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>