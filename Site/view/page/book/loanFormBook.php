<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Emprunter <q> <?= $bookTitle[0]['title']?> </q></h4>
        </div>
        <div class="card-body">
            <form id="formLoan" method="post" action="?controller=loan&action=newLoan&id=<?= $bookTitle[0]['id_book'] ?>">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Élève</label>
                    <select class="form-control" name="studentId" id="studentId">
                        <option value="">-- Sélectionner un élève --</option>
                        <?php foreach ($students as $student): ?>
                            <option value="<?= $student['id_student'] ?>">
                                <?= $student['id_student'].'. '. ' ' . $student['firstname'] . ' ' . $student['lastname'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <span id="errorStudentId" class="invalid-feedback" style="display: none;">Veuillez sélectionner un élève</span>
                </div>
                <div class="mb-3">
                    <label for="startDate" class="form-label">Date d'emprunt</label>
                    <input type="date" class="form-control" name="startDate" id="startDate" value="<?php echo date('Y-m-d'); ?>">
                    <span id="errorStartDate" class="invalid-feedback" style="display: none;">Veuillez indiquer une date d'emprunt</span>
                </div>
                <div class="mb-3">
                    <label for="expectedReturnDate" class="form-label">Date prévue de retour</label>
                    <input type="date" class="form-control" name="expectedReturnDate" id="expectedReturnDate" value ="<?php echo date('Y-m-d', strtotime('+1 month'));?>">
                    <span id="errorExpectedReturnDate" class="invalid-feedback" style="display: none;">Veuillez indiquer une date de retour</span>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer l'emprunt</button>
                </div>
            </form>
        </div>
    </div>
</div>
