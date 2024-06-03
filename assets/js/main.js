document.addEventListener("DOMContentLoaded", function () {
  const deleteModal = document.getElementById("deleteModal");
  const deleteClose = deleteModal.querySelector(".close");
  const confirmDelete = document.getElementById("confirmDelete");
  const cancelDelete = document.getElementById("cancelDelete");
  let userIdToDelete;

  const showModal = document.getElementById("showModal");
  const showClose = showModal.querySelector(".close");
  const closeShowModal = document.getElementById("closeShowModal");

  document.querySelectorAll(".delete-user").forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault();
      userIdToDelete = this.getAttribute("data-user-id");
      deleteModal.style.display = "block";
    });
  });

  document.querySelectorAll(".username-link").forEach(function (link) {
    link.addEventListener("click", async function (event) {
      event.preventDefault();
      const userId = this.getAttribute("data-user-id");
      const response = await fetch(`/api/users/${userId}`);
      const user = await response.json();

      document.getElementById("show_username").textContent = user.username;
      document.getElementById("show_email").textContent = user.email;
      document.getElementById("show_birthdate").textContent = user.birthdate;
      document.getElementById("show_website").textContent = user.url;
      document.getElementById("show_phonenumber").textContent =
        user.phone_number;

      showModal.style.display = "block";
    });
  });

  deleteClose.addEventListener("click", function () {
    deleteModal.style.display = "none";
  });

  cancelDelete.addEventListener("click", function () {
    deleteModal.style.display = "none";
  });

  confirmDelete.addEventListener("click", async () => {
    const response = await fetch(`/api/users/${userIdToDelete}`, {
      method: "DELETE",
    });

    if (response.status !== 200) {
      alert("Error deleting user");
      return;
    }

    // In order to reload data from the server
    window.location.href = "/";
  });

  showClose.addEventListener("click", function () {
    showModal.style.display = "none";
  });

  closeShowModal.addEventListener("click", function () {
    showModal.style.display = "none";
  });

  window.addEventListener("click", function (event) {
    if (event.target == deleteModal) {
      deleteModal.style.display = "none";
    } else if (event.target == showModal) {
      showModal.style.display = "none";
    }
  });
});
