<div class="container mt-4 mb-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Rendre <q><?= $bookTitle[0]['title'] ?></q></h4>
        </div>
        <div class="card-body">
            <form id="formRestore" method="post" action="?controller=loan&action=closeLoan&id=<?= $id_loan[0]['id_loan'] ?>">
                <div class="mb-3">
                    <label for="returnDate" class="form-label">Date de rendu*</label>
                    <input type="date" class="form-control" name="returnDate" id="returnDate" value="<?= date('Y-m-d') ?>">
                    <span id="errorReturnDate" class="invalid-feedback" style="display: none;">Veuillez indiquer une date de rendu</span>
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Commentaire</label>
                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Ex: Manque une page">
                </div>
                <div>
                    <button type="submit" class="btn btn-outline-primary mt-3">Rendre</button>
                </div>
            </form>
        </div>
    </div>
</div>
