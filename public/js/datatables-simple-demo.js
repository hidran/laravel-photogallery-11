window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.querySelector('.data-table');

    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }
});
