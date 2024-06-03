<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/main.js"></script>
</head>
<body>
    <div class="container">
        <h1>Users List</h1>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td>
                            <a href="#" class="username-link" data-user-id="<?= htmlspecialchars($user->id) ?>">
                                <?= htmlspecialchars($user->username) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($user->email) ?></td>              
                        <td class="actions">
                            <a href="#" class="action-icon delete-user" data-user-id="<?= htmlspecialchars($user->id) ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="red">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="/users/create" class="btn">Create User</a>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Are you sure you want to delete this user?</p>
            <button id="confirmDelete" class="btn btn-danger">Delete</button>
            <button id="cancelDelete" class="btn">Cancel</button>
        </div>
    </div>

    <!-- Show Modal -->
    <div id="showModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User Details</h2>
            <p><strong>Username:</strong> <span id="show_username"></span></p>
            <p><strong>Email:</strong> <span id="show_email"></span></p>
            <p><strong>Birthdate:</strong> <span id="show_birthdate"></span></p>
            <p><strong>Website:</strong> <span id="show_website"></span></p>
            <p><strong>Phone Number:</strong> <span id="show_phonenumber"></span></p>
            <button id="closeShowModal" class="btn">Close</button>
        </div>
    </div>

</body>
</html>
