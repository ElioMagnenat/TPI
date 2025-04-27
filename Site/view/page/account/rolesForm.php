<div class="card shadow mb-4 mt-4">
    <div class="card-header py-3 ">
        <h2 class="text-primary font-weight-bold">Gestion des droits</h2>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <?php foreach ($_SESSION["UsersRoles"] as $user) { ?>
                <div class="role-user-div border rounded p-3 mb-3">
                    <form id="rolesForm" class="w-75 mt-3" method="post" action="?controller=account&action=updateRoles">
                        <h5 class="text-secondary"><?php echo $user["username"]; ?></h5>
                        <?php foreach ($_SESSION["Roles"] as $roles) {
                            $value = "";
                            foreach ($user["roles"] as $userRole) {
                                if ($roles["role_id"] == $userRole["id"]) {
                                    $value = "checked";
                                }
                            }
                        ?>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input admin-switch" type="checkbox" id="<?= $roles["role_id"] . "," . $user["user_id"] ?>" name="<?= $roles["role_id"] . "," . $user["user_id"] ?>" <?= $value ?>>
                                <label class="form-check-label" for="<?= $roles["role_id"] . "," . $user["user_id"] ?>"><?php echo $roles["nom"]; ?></label>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer</button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".role-user-div").forEach(userBlock => {
                const checkboxes = userBlock.querySelectorAll(".form-check-input");

                let adminCheckbox = null;
                const otherCheckboxes = [];

                checkboxes.forEach(checkbox => {
                    const label = userBlock.querySelector(`label[for='${checkbox.id}']`);
                    if (label && label.textContent.trim().toLowerCase() === "administrateur") {
                        adminCheckbox = checkbox;
                    } else {
                        otherCheckboxes.push(checkbox);
                    }
                });

                if (adminCheckbox) {
                    const toggleOtherCheckboxes = () => {
                        const isChecked = adminCheckbox.checked;
                        otherCheckboxes.forEach(cb => {
                            if (isChecked) {
                                cb.checked = false;
                                cb.disabled = true;
                            } else {
                                cb.disabled = false;
                            }
                        });
                    };
                    toggleOtherCheckboxes();

                    adminCheckbox.addEventListener("change", toggleOtherCheckboxes);
                }
            });
        });
    </script>