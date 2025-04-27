// Fonction pour exporter en PDF
function exportToPDF() {
    console.log('dans la fonction');
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const table = $('#dataTable').DataTable();
    const rows = [];
    const data = table.rows({ search: 'applied' }).data();

    // Itérer sur les données et exclure la colonne "Actions"
    data.each(function (value) {
        const rowData = [];
        rowData.push(value[0]); // Nom
        rowData.push(value[1]); // Type
        rowData.push(value[2]); // Cépage
        rowData.push(value[3]); // Âge
        rowData.push(value[4]); // Millésime
        rowData.push(value[5]); // Date d'achat
        rowData.push(value[6]); // Prix
        rowData.push(value[7]); // Quantité
        rows.push(rowData);
    });

    doc.autoTable({
        head: [['Nom', 'Type', 'Cépage', 'Âge', 'Millésime', 'Date d\'achat', 'Prix', 'Quantité']],
        body: rows,
        theme: 'grid',
        margin: { top: 20, left: 10, right: 10, bottom: 10 },
        pageBreak: 'auto',
    });

    doc.save('tableau_des_vins.pdf');
}

// Fonction pour exporter en CSV
function exportToCSV() {
    const table = $('#dataTable').DataTable();
    const rows = [];
    const data = table.rows({ search: 'applied' }).data();

    // Ajouter l'en-tête
    rows.push(['Nom', 'Type', 'Cépage', 'Âge', 'Millésime', 'Date d\'achat', 'Prix', 'Quantité']);

    data.each(function (value) {
        const rowData = [];
        rowData.push(value[0]); // Nom
        rowData.push(value[1]); // Type
        rowData.push(value[2]); // Cépage
        rowData.push(value[3]); // Âge
        rowData.push(value[4]); // Millésime
        rowData.push(value[5]); // Date d'achat
        rowData.push(value[6]); // Prix
        rowData.push(value[7]); // Quantité
        rows.push(rowData);
    });

    let csvContent = "";
    rows.forEach(function (rowArray) {
        let row = rowArray.join(";");
        csvContent += row + "\r\n";
    });

    const bom = "\uFEFF";
    const dataURL = 'data:text/csv;charset=UTF-8,' + encodeURIComponent(bom + csvContent);

    const link = document.createElement("a");
    link.setAttribute("href", dataURL);
    link.setAttribute("download", "tableau_des_vins.csv");
    link.click();
}

// Attacher les événements
document.getElementById("exportPDFBtn").addEventListener("click", function (e) {
    e.preventDefault(); // Évite de suivre le lien #
    exportToPDF();
});

document.getElementById("exportCSVBtn").addEventListener("click", function (e) {
    e.preventDefault();
    exportToCSV();
});