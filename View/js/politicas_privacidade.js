document.addEventListener("DOMContentLoaded", () => {
  const checkbox = document.getElementById("acceptPrivacy");
  const button = document.getElementById("btnAccept");
  const openLink = document.getElementById("openPrivacy");
  const modalElement = document.getElementById("privacyModal");
  const modal = new bootstrap.Modal(modalElement);
  
  if (!localStorage.getItem("privacyAccepted")) {
    modal.show();
  }
  
  checkbox.addEventListener("change", function () {
    button.disabled = !this.checked;
  });
  
  button.addEventListener("click", function () {
    localStorage.setItem("privacyAccepted", "true");
    modal.hide();
  });

  openLink.addEventListener("click", function (e) {
    e.preventDefault();

    checkbox.checked = false;
    button.disabled = true;

    modal.show();
  });
});
