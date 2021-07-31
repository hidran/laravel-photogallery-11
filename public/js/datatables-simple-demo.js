window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.querySelector('.data-table');
    alert(datatablesSimple)
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
