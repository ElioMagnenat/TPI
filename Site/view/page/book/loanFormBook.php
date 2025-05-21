<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                Emprunter 
                <?php if (count($bookTitle) === 1){ ?>
                    <q><?= $bookTitle[0]['title'] ?></q>
                <?php } ?>
            </h4>
        </div>
<?php if (!empty($bookTitle)): ?>
    <div class="card border-start border-primary border-3 mb-4 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0 text-primary">
                <i class="fas fa-book me-2"></i>
                <?= count($bookTitle) === 1 ? 'Livre sélectionné' : 'Livres sélectionnés' ?>
            </h5>
        </div>
        <ul class="list-group list-group-flush">
            <?php foreach ($bookTitle as $book): ?>
                <li class="list-group-item d-flex align-items-center">
                    <span class="text-dark"><?= htmlspecialchars($book['title']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
        <div class="card-body">
            <form id="formLoan" method="post" action="?controller=loan&action=newLoan&ids=<?= htmlspecialchars($_GET['ids'] ?? $bookTitle[0]['id_book']) ?>">
                <div class="mb-3">
                    <label for="studentId" class="form-label">Élève*</label>
                    <select class="form-control" name="studentId" id="studentId">
                        <option value="">-- Sélectionner un élève --</option>
                        <?php foreach ($students as $student){ 
                            if(new DateTime($student['validity_date']) >= new DateTime()) {?>
                                <option value="<?= $student['id_student'] ?>">
                                    <?= $student['id_student'].'. '. ' ' . $student['firstname'] . ' ' . $student['lastname'] ?>
                                </option>
                        <?php }} ?>
                    </select>
                    <span id="errorStudentId" class="invalid-feedback" style="display: none;">Veuillez sélectionner un élève</span>
                </div>
                <div class="mb-3">
                    <label for="startDate" class="form-label">Date d'emprunt*</label>
                    <input type="date" class="form-control" name="startDate" id="startDate" value="<?php echo date('Y-m-d'); ?>">
                    <span id="errorStartDate" class="invalid-feedback" style="display: none;">Veuillez indiquer une date d'emprunt</span>
                </div>
                <div class="mb-3">
                    <label for="expectedReturnDate" class="form-label">Date prévue de retour*</label>
                    <input type="date" class="form-control" name="expectedReturnDate" id="expectedReturnDate" value ="<?php echo date('Y-m-d', strtotime('+1 month'));?>">
                    <span id="errorExpectedReturnDate" class="invalid-feedback" style="display: none;"></span>
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Enregistrer l'emprunt</button>
                </div>
            </form>
        </div>
    </div>
</div>
